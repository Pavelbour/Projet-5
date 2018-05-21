<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class CameraController extends Controller
    {
        public function home()
        {
            return $this->render('Camera/cameras.html.twig');
        }

        public function camera($id)
        {
            return $this->render('Camera/camera.html.twig');
        }
    }