<?php

namespace App\Controller;

use App\Entity\CamManufacturer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\ForumTheme;

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

            $forum = new ForumTheme();
            $forum->setTheme($manufacturer->getManufacturer());
            $forum->setThemeParent('Appareils Photos');
            $em = $this->getDoctrine()->getManager();
            $em->persist($forum);
            $em->persist($manufacturer);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Le fabricant a été ajouté.');

            return $this->redirectToRoute('app_cameras_page', array(
                'id' => 1
            ));
        }

        return $this->render('Camera/add.html.twig', array(
            'title' => 'Ajout d\'un nouveau fabricant',
            'form' => $form->createView()
        ));
    }
}
