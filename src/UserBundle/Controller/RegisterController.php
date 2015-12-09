<?php

namespace UserBundle\Controller;

use UserBundle\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use UserBundle\Entity\User;

class RegisterController extends Controller
{

    public function loginAction(Request $request)
    {
        /* @var $authenticationUtils AuthenticationUtils */
        $authenticationUtils = $this->get('security.authentication_utils');

        $user = $this->getUser(); /* @var $user User */

        $username = false;

        if($user instanceof User) {
            $username = $user->getUsername();
            $this->logout($request);
        }

        $loginForm = $this->createForm('logintype', null, array(
            'method' => 'POST',
            'action' => $this->generateUrl('user_check')
            // 'csrf_protection' => false
        ));

        return $this->render('UserBundle:Register:login.html.php', array(
            // last username entered by the user
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
            'username'      => $username,
            'loginForm'     => $loginForm
        ));
    }

    public function logout(Request $request)
    {
        $this->container->get('security.context')->setToken(null);

        $session = $request->getSession();
        $session->invalidate(0);
        $session->clear();
    }
}