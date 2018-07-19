<?php

namespace App\Controller;

use App\Entity\LensManufacturer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\ForumTheme;

class LensManufacturerController extends Controller
{

    public function addManufacturer(Request $request)
    {
        // adds a nem manufacturer of lenses
        $manufacturer = new LensManufacturer();

        $form = $this->createFormBuilder($manufacturer)
            ->add('Manufacturer', TextType::class)
            ->getForm();

            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $forum = new ForumTheme();
            $forum->setTheme($manufacturer->getManufacturer());
            $forum->setParentId(5);
            $manufacturer->setTheme($forum);
            $em = $this->getDoctrine()->getManager();
            $em->persist($forum);
            $em->persist($manufacturer);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Le fabricant a été ajouté.');

            return $this->redirectToRoute('app_lenses_page', array(
                'id' => 1
            ));
        }

        return $this->render('Camera/add.html.twig', array(
            'title' => 'Ajout d\'un nouveau fabricant d\'objectifs',
            'form' => $form->createView()
        ));
    }
}
