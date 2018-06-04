<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\Camera;
    use App\Entity\CameraComment;
    use App\Form\CameraCommentType;
    use App\Form\CameraType;

    class CameraController extends Controller
    {
        public function home()
        {
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Camera::class);

            $listCameras = $repository->findAll();


            return $this->render('Camera/cameras.html.twig', array(
                'list' => $listCameras
            ));
        }

        public function camera(Request $request, $id)
        {
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Camera::class);

            $camera = $repository->find($id);
            $comment = new CameraComment;
            $form = $this->createForm(CameraCommentType::class, $comment);

            $form->handleRequest($request);

            $comments = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(CameraComment::class)
            ->findByCameraId($camera);

            if ($form->isSubmitted() && $form->isValid() && $this->getUser()) {

                $em = $this->getDoctrine()->getManager();
                $comment->setCameraId($camera);
                $comment->setUserId($this->getUser());
                $date = new \DateTime();
                $comment->setAdded($date);
                $em->persist($comment);
                $em->flush();

                return $this->redirectToRoute('app_camera', array(
                    'id' => $id
                ));
            }

            return $this->render('Camera/camera.html.twig', array(
                'camera' => $camera,
                'comments' => $comments,
                'form' => $form->createView()
            ));
        }

        public function addCamera(Request $request)
        {

            $camera = new Camera();
            $form = $this->createForm(CameraType::class, $camera);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($camera);
                $em->flush();

                return $this->redirectToRoute('app_camera', array(
                    'id' => $camera->getId()
                ));
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Ajout d\'un nouveau appareil',
                'form' => $form->createView()
            ));
        }

        public function modifyCamera(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();
            $camera = $em->getRepository(Camera::class)->find($id);
            $form = $this->createForm(CameraType::class, $camera);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em->flush();

                return $this->redirectToRoute('app_camera', array(
                    'id' => $camera->getId()
                ));
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Ajout d\'un nouveau appareil',
                'form' => $form->createView()
            ));
        }

        public function deleteCamera($id)
        {
            $em = $this->getDoctrine()->getManager();
            $camera = $em->getRepository(Camera::class)->find($id);
            $em->remove($camera);
            $em->flush();
            return $this->redirectToRoute('app_cameras');
        }
    }