<?php

namespace App\Controller;

use App\Entity\LensManufacturer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LensManufacturerController extends Controller
{

    public function addManufacturer(Request $request)
    {
        $manufacturer = new LensManufacturer();

        $form = $this->createFormBuilder($manufacturer)
            ->add('Manufacturer', TextType::class)
            ->getForm();

            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($manufacturer);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La manufacturer a été ajoutée.');

            return $this->redirectToRoute('app_lenses');
        }

        return $this->render('Camera/add.html.twig', array(
            'title' => 'Ajout d\'un nouveau fabricant d\'objectifs',
            'form' => $form->createView()
        ));
    }
}
