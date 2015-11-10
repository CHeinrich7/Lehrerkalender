<?php

namespace UserBundle\Controller;

use UserBundle\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Entity\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

class UserController extends Controller
{
    const INDEX_TEMPLATE = 'UserBundle:User:index.html.php';
    const EDIT_TEMPLATE = 'UserBundle:User:edit.html.php';

    /**
     * @var UserRepository
     */
    private $userRepo;

    /**
     * @var EntityManager
     */
    private $em;


    public function indexAction()
    {
        return $this->render(self::INDEX_TEMPLATE, array(
            'currentUser' => $this->getUser()
        ));
    }

    public function newAction(Request $request)
    {
        $authChecker = $this->get('security.authorization_checker');

        if(!$authChecker->isGranted(Role::ROLE_CHARGER)) {
            throw new \Exception('Unerlaubtes Territorium');
        }

        $user = new User();

        $form = $this->createForm(new UserType(), $user, array(
            'method' => 'POST',
            'action' => $this->generateUrl('user_create_user')
        ));

        $submitted = $form->isSubmitted();

        $errors = $form->getErrors();

        $message = $errors->current()
            ? $errors->current()->getMessage()
            : null;

        if($submitted) {
            if($form->isValid()) {
                $user = new ControllerReference('UserBundle:Default:getUser');

                $this->em->persist($user);
                $this->em->flush();

                $this->redirectToRoute('user_edit_user',
                    array('id' => $user->getId())
                );
            }
        }

        $data = array(
            'userForm' => $form,
            'error'     => $message,
            'user'      => $user,
            'newUser'   => true,
        );

        return $this->returnResponse($request, self::EDIT_TEMPLATE, $data);
    }


    /**
     * @param Request $request
     * @param integer $id
     *
     * @return JsonResponse|Response
     * @throws \Exception
     */
    public function editAction(Request $request, $id)
    {
        $this->em = $this->get('doctrine.orm.default_entity_manager');
        $this->userRepo = $this->em->getRepository('UserBundle:User');

        $authChecker = $this->get('security.authorization_checker');

        $currentUser = $this->getUser();

        if($authChecker->isGranted(Role::ROLE_CHARGER)) {
            if($id > 0) {
                $user = $this->userRepo->find($id);
            } else {
                $user = $currentUser;
            }
        } else if($currentUser->getId() != $id) {
            throw new \Exception('Unerlaubtes Territorium');
        } else {
            $user = $currentUser;
        }

        $form = $this->createForm(new UserType(), $user, array(
            'method' => 'POST',
            'action' => $this->generateUrl('user_edit_user')
        ));

        $form->handleRequest($request);

        $submitted = $form->isSubmitted();

        $errors = $form->getErrors();

        $message = $errors->current()
            ? $errors->current()->getMessage()
            : null;

        if($submitted) {
            if($form->isValid()) {
                $user = new ControllerReference('UserBundle:Default:getUser');

                $this->em->persist($user);
                $this->em->flush();
            }
        }

        $data = array(
            'userForm' => $form,
            'error'     => $message,
            'user'      => $user,
            'currentUser' => $currentUser
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

    /**
     * @return bool|User
     * @throws \LogicException
     */
    public function getUser()
    {
        if (!$this->container->has('security.context')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.context')->getToken()) {
            return false;
        }

        if (!is_object($user = $token->getUser())) {
            return false;
        }

        return $user;
    }
}