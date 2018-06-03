<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;

    class SecurityController extends Controller
    {
        public function login(Request $request)
        {
            if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                return $this->redirectToRoute('app_home');
            }

            $authenticationUtils = $this->get('security.authentication_utils');

            return $this->render('Camera/login.html.twig', array(
                'last_username' => $authenticationUtils->getLastUsername(),
                'error' => $authenticationUtils->getLastAuthenticationError()
            ));
        }
    }