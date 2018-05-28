<?php
    namespace App\Controller;
    
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use App\Entity\Users;

    class UserController extends Controller
    {
        public function home()
        {
            return $this->render('Camera/cameras.html.twig');
        }

        public function camera($id)
        {
            return $this->render('Camera/camera.html.twig');
        }

        public function addCamera()
        {
            $em = $this->getDoctrine()->getManager();
            $user = new User();
            

            $em->persist($user);
            $em->flush();
        }

        public function test()
        {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository(Users::class);

            $user=$repo->find(1);
            var_dump($user);
            return $this->render('Camera/cameras.html.twig');
        }
    }