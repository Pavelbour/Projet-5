<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class HomeController extends Controller
    {
        public function home()
        {
            return $this->render('Camera/home.html.twig');
        }

        public function admin()
        {
            return $this->render('Camera/admin.html.twig');
        }

        public function user()
        {
            return $this->render('Camera/user.html.twig');
        }

        public function forum()
        {
            return $this->render('Camera/forum.html.twig');
        }
    }