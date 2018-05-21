<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class ForumController extends Controller
    {
        public function home()
        {
            return $this->render('Camera/forum.html.twig');
        }
    }