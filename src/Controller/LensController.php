<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use App\Entity\Lens;

    class LensController extends Controller
    {
        public function home()
        {
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Lens::class);

            $list = $repository->findAll();


            return $this->render('Camera/lenses.html.twig', array(
                'list' => $list
            ));
        }

        public function lens($id)
        {
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Lens::class);

            $lens = $repository->find($id);

            return $this->render('Camera/lens.html.twig', array(
                'lens' => $lens
            ));
        }

        public function addLens(Request $request)
        {

            $lens = new Lens();

            $form = $this->createFormBuilder($lens)
                ->add('Manufacturer', EntityType::class, array(
                    'class' => 'App\Entity\LensManufacturer',
                    'choice_label' => 'manufacturer'
                ))
                ->add('Name', TextType::class)
                ->add('Monture', EntityType::class, array(
                    'class' => 'App\Entity\Monture',
                    'choice_label' => 'monture'
                ))
                ->add('Length', TextType::class)
                ->add('Diameter', TextType::class)
                ->add('Weight', TextType::class)
                ->add('Focal_length_min', TextType::class)
                ->add('Focal_length_max', TextType::class)
                ->add('Focuse', TextType::class)
                ->add('Aperture', TextType::class)
                ->add('Diameter_of_filter', TextType::class)
                ->add('Description', TextareaType::class)
                ->add('ForManufacturer', EntityType::class, array(
                    'class' => 'App\Entity\CamManufacturer',
                    'choice_label' => 'manufacturer',
                    'multiple' => 'true'
                ))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($lens);
                $em->flush();

                return $this->redirectToRoute('app_lens', array(
                    'id' => $lens->getId()
                ));
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Ajout d\'un nouveau objectif',
                'form' => $form->createView()
            ));
        }

        public function modifyLens(Request $request, $id)
        {

            $em = $this
                ->getDoctrine()
                ->getManager();

            $lens = $em
            ->getRepository(Lens::class)
            ->find($id);

            $form = $this->createFormBuilder($lens)
                ->add('Manufacturer', EntityType::class, array(
                    'class' => 'App\Entity\LensManufacturer',
                    'choice_label' => 'manufacturer'
                ))
                ->add('Name', TextType::class)
                ->add('Monture', EntityType::class, array(
                    'class' => 'App\Entity\Monture',
                    'choice_label' => 'monture'
                ))
                ->add('Length', TextType::class)
                ->add('Diameter', TextType::class)
                ->add('Weight', TextType::class)
                ->add('Focal_length_min', TextType::class)
                ->add('Focal_length_max', TextType::class)
                ->add('Focuse', TextType::class)
                ->add('Aperture', TextType::class)
                ->add('Diameter_of_filter', TextType::class)
                ->add('Description', TextareaType::class)
                ->add('ForManufacturer', EntityType::class, array(
                    'class' => 'App\Entity\CamManufacturer',
                    'choice_label' => 'manufacturer',
                    'multiple' => 'true'
                ))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em->flush();

                return $this->redirectToRoute('app_lens', array(
                    'id' => $lens->getId()
                ));
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Ajout d\'un nouveau objectif',
                'form' => $form->createView()
            ));
        }
    }   