<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use App\Entity\Camera;
    use App\Entity\Lens;
    use App\Entity\User;
    use App\Entity\ForumTheme;
    use App\Entity\ForumMessage;

    class HomeController extends Controller
    {
        public function home()
        {
            $cameras = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository(Camera::class)
                ->findBy(
                    array(),
                    array('id' => 'desc'),
                    4,
                    0
                );

            $lenses = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Lens::class)
            ->findBy(
                array(),
                array('id' => 'desc'),
                4,
                0
                );

            return $this->render('Camera/home.html.twig', array(
                'cameras' => $cameras,
                'lenses' => $lenses
            ));
        }

        public function admin()
        {
            $em = $this->getDoctrine()->getManager();
            $camerasNumber = $em->getRepository(Camera::class)->getNumber();
            $lensesNumber = $em->getRepository(Lens::class)->getNumber();
            $usersNumber = $em->getRepository(User::class)->getNumber();
            $themeNumber = $em->getRepository(ForumTheme::class)->getTotalNumber();
            $messageNumber = $em->getRepository(ForumMessage::class)->getTotalNumber();
            return $this->render('Camera/admin.html.twig', array(
                'camerasNumber' => $camerasNumber,
                'lensesNumber' => $lensesNumber,
                'usersNumber' => $usersNumber,
                'themeNumber' => $themeNumber,
                'messageNumber' => $messageNumber
            ));
        }

        public function user()
        {
            return $this->render('Camera/user.html.twig');
        }

        public function mentions()
        {
            return $this->render('Camera/mentions.html.twig');
        }

        public function cookies(SessionInterface $session)
        {
            $session->set('cookiesannouncement', true);

            return $this->redirectToRoute('app_home');
        }

        public function refuseCookies()
        {
            return $this->render('Camera/refusecookies.html.twig');
        }

        public function privacy()
        {
            return $this->render('Camera/privacy.html.twig');
        }
    }