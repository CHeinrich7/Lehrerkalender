<?php

namespace UserBundle\Controller;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use UserBundle\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManager;

class UserController extends Controller
{
    const INDEX_TEMPLATE = 'UserBundle:User:index.html.php';
    const EDIT_TEMPLATE = 'UserBundle:User:edit.html.php';

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @return Response
     */
    public function indexAction()
    {
        if(!$this->isGranted(Role::ROLE_ADMIN)) {
            return $this->redirectToRoute('user_edit', ['user' => $this->getUser()->getId()]);
        }

        $em = $this->get('doctrine.orm.default_entity_manager');

        $users = $em->getRepository('UserBundle:User')->findAllDistinct();

        return $this->render(self::INDEX_TEMPLATE, array(
            'currentUser'   => $this->getUser(),
            'users'         => $users
        ));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response
     *
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        $user = new User();

        return $this->editUser($request, $user, $this->getUser(), 'user_create', true);
    }


    /**
     * @param Request $request
     * @param User    $user
     *
     * @return JsonResponse|Response
     *
     * @throws \Exception
     */
    public function editAction(Request $request, User $user)
    {
        $currentUser = $this->getUser();


        return $this->editUser($request, $user, $currentUser, 'user_edit', false);
    }

    /**
     * @param Request   $request
     * @param User      $user
     * @param User      $currentUser
     * @param string    $action
     * @param boolean   $newUser
     *
     * @return JsonResponse|Response
     *
     * @throws \Exception
     */
    protected function editUser(Request $request, User $user, User $currentUser, $action, $newUser)
    {
        $entitySecurityService = $this->get('entity.security.service');
        if(!$entitySecurityService->isEntityGrantedWithAdminRights($user)) {
            throw new \Exception('Unerlaubtes Territorium');
        }

        $this->em = $this->get('doctrine.orm.default_entity_manager');

        $form = $this->createForm('usertype', $user, array(
            'method' => 'POST',
            'action' => $this->generateUrl($action, ['user' => $user->getId()]),
        ));

        $form->handleRequest($request);

        $submitted = $form->isSubmitted();

        $errors = $form->getErrors();

        $message = $errors->current()
            ? $errors->current()->getMessage()
            : null;

        if($submitted && $form->isValid()) {

            /** @var EncoderFactory $factory */
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);

            $user->setSalt(md5(time()));
            $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
            $user->setPlainPassword('');
            $user->setPassword($password);

            $this->em->persist($user);
            $this->em->flush();
        }

        $data = array(
            'userForm'  => $form,
            'error'     => $message,
            'user'      => $user,
            'currentUser' => $currentUser,
            'newUser'   => $newUser
        );

        return $this->returnResponse($request, self::EDIT_TEMPLATE, $data);
    }

    /**
     * @param Request $request
     * @param string  $template
     * @param array   $data
     *
     * @return JsonResponse|Response
     */
    private function returnResponse(Request $request, $template, $data = array())
    {
        $response = $this->render($template, $data);

        if($request->isXmlHttpRequest()) {
            return new JsonResponse(
                array(
                    'success'   => true,
                    'data'      => $response
                )
            );
        }

        return $response;
    }
}