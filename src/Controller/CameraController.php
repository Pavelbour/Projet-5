<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use App\Entity\Camera;

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

        public function camera($id)
        {
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Camera::class);

            $camera = $repository->find($id);

            return $this->render('Camera/camera.html.twig', array(
                'camera' => $camera
            ));
        }

        public function addCamera(Request $request)
        {

            $camera = new Camera();

            $form = $this->createFormBuilder($camera)
                ->add('Manufacturer', EntityType::class, array(
                    'class' => 'App\Entity\CamManufacturer',
                    'choice_label' => 'manufacturer'
                ))
                ->add('CameraName', TextType::class)
                ->add('Sensor', TextType::class)
                ->add('Monture', EntityType::class, array(
                    'class' => 'App\Entity\Monture',
                    'choice_label' => 'monture',
                    'multiple' => 'true'
                ))
                ->add('Length', TextType::class)
                ->add('Width', TextType::class)
                ->add('Height', TextType::class)
                ->add('Weight', TextType::class)
                ->add('Time', TextType::class)
                ->add('Description', TextareaType::class)
                ->add('Category', EntityType::class, array(
                    'class' => 'App\Entity\CamCategory',
                    'choice_label' => 'category'
                ))
                ->getForm();

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
            $em = $this
                ->getDoctrine()
                ->getManager();
            $camera = $em
                ->getRepository(Camera::class)
                ->find($id);

            $form = $this->createFormBuilder($camera)
                ->add('Manufacturer', EntityType::class, array(
                    'class' => 'App\Entity\CamManufacturer',
                    'choice_label' => 'manufacturer'
                ))
                ->add('CameraName', TextType::class)
                ->add('Sensor', TextType::class)
                ->add('Monture', EntityType::class, array(
                    'class' => 'App\Entity\Monture',
                    'choice_label' => 'monture',
                    'multiple' => 'true'
                ))
                ->add('Length', TextType::class)
                ->add('Width', TextType::class)
                ->add('Height', TextType::class)
                ->add('Weight', TextType::class)
                ->add('Time', TextType::class)
                ->add('Description', TextareaType::class)
                ->add('Category', EntityType::class, array(
                    'class' => 'App\Entity\CamCategory',
                    'choice_label' => 'category'
                ))
                ->getForm();

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
    }