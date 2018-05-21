<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class LensController extends Controller
    {
        public function home()
        {
            return $this->render('Camera/lens.html.twig');
        }
    }