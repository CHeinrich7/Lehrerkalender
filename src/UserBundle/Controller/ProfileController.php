<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use UserBundle\Entity\Profile;
use UserBundle\Form\ProfileType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Entity\Repository\ProfileRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

class ProfileController extends Controller
{
    const INDEX_TEMPLATE = 'UserBundle:Profile:index.html.php';
    const EDIT_TEMPLATE = 'UserBundle:Profile:edit.html.php';

    /**
     * @var ProfileRepository
     */
    private $profileRepo;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var FormBuilder
     */
    private $formBuilder;


    public function indexAction()
    {
        return $this->render( self::INDEX_TEMPLATE );
    }

    /**
     * @param Request $request
     *
     * @return Response|JsonResponse
     */
    public function editAction(Request $request, $id)
    {
        $this->em = $this->get('doctrine.orm.default_entity_manager');
        $this->profileRepo = $this->em->getRepository('UserBundle:Profile');
        $this->formBuilder = $this->createFormBuilder();

        $profile = new Profile();

        $form = $this->createForm(new ProfileType(), $profile, array(
            'method' => 'POST',
            'action' => $this->generateUrl('user_edit_profile')
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
                $profile->setUser($user);

                $this->em->persist($profile);
                $this->em->flush();
            }
        }

        $data = array(
            'profileForm' => $form,
            'error'     => $message
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