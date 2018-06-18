<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\Camera;
    use App\Entity\CameraComment;
    use App\Entity\ForumTheme;
    use App\Form\CameraCommentType;
    use App\Form\CameraType;
    use App\Form\CamFilterType;

    class CameraController extends Controller
    {
        public function camerasPage(Request $request, $id)
        {
            $camera = new Camera();
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Camera::class);
            $form = $this->createForm(CamFilterType::class, $camera);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $listCameras = $repository->filter($id, $camera->getManufacturer(), $camera->getCategory());

            } else {
                $listCameras = $repository->filter($id);
            }

            if ($id == 1) {
                $id = 2;
            }

            return $this->render('Camera/cameras.html.twig', array(
                'list' => $listCameras,
                'id' => $id,
                'form' => $form->createView()
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
                $request->getSession()->getFlashBag()->add('info', 'Le commentaire a été publié');

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
                $forum = new ForumTheme();
                $forum->setTheme($camera->getCameraName());
                $forum->setThemeParent($camera->getManufacturer()->getManufacturer());
                $em = $this->getDoctrine()->getManager();
                $em->persist($forum);
                $em->persist($camera);
                $em->flush();
                $request->getSession()->getFlashBag()->add('info', 'L\'appareil a été ajouté');

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
                $request->getSession()->getFlashBag()->add('info', 'L\'appareil a été modifié');

                return $this->redirectToRoute('app_camera', array(
                    'id' => $camera->getId()
                ));
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Ajout d\'un nouveau appareil',
                'form' => $form->createView()
            ));
        }

        public function deleteCamera(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();
            $camera = $em->getRepository(Camera::class)->find($id);
            $em->remove($camera);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'L\'appareil a été effacé');
            return $this->redirectToRoute('app_cameras_page', array(
                'id' => 1
            ));
        }
    }