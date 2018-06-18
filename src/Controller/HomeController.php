<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use App\Entity\Camera;
    use App\Entity\Lens;
    use App\Entity\User;

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
            $camerasNumber = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository(Camera::class)
                ->getNumber();
            $lensesNumber = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository(Lens::class)
                ->getNumber();
            $usersNumber = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository(User::class)
                ->getNumber();
            return $this->render('Camera/admin.html.twig', array(
                'camerasNumber' => $camerasNumber,
                'lensesNumber' => $lensesNumber,
                'usersNumber' => $usersNumber
            ));
        }

        public function user()
        {
            return $this->render('Camera/user.html.twig');
        }

    }