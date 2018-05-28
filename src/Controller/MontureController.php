<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use App\Entity\Monture;

    class MontureController extends Controller
    {
        public function addMonture(Request $request)
        {

            $monture = new Monture();

            $form = $this->createFormBuilder($monture)
                ->add('Manufacturer', EntityType::class, array(
                    'class' => 'App\Entity\CamManufacturer',
                    'choice_label' => 'manufacturer'
                ))
                ->add('Monture', TextType::class)
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($monture);
                $em->flush();

                return $this->redirectToRoute('app_home');
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Ajouter d\'une nouvelle monture',
                'form' => $form->createView()
            ));
        }
    }