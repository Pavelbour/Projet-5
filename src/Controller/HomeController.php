<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class HomeController extends Controller
    {
        public function home()
        {
            return $this->render('Camera/home.html.twig');
        }
    }