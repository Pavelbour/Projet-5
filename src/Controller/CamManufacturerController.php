<?php

namespace App\Controller;

use App\Entity\CamManufacturer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CamManufacturerController extends Controller
{

    public function addManufacturer(Request $request)
    {
        $manufacturer = new CamManufacturer();

        $form = $this->createFormBuilder($manufacturer)
            ->add('Manufacturer', TextType::class)
            ->add('Ajouter', SubmitType::class)
            ->getForm();

            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($manufacturer);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La manufacturer a été ajoutée.');

            return $this->redirectToRoute('app_cameras');
        }

        return $this->render('Camera/add.html.twig', array(
            'title' => 'Ajout d\'un nouveau fabricant',
            'form' => $form->createView()
        ));
    }
}
