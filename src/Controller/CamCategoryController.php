<?php

namespace App\Controller;

use App\Entity\CamCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CamCategoryController extends Controller
{

    public function addCategory(Request $request)
    {
        $category = new CamCategory();

        $form = $this->createFormBuilder($category)
            ->add('category', TextType::class)
            ->add('Ajouter', SubmitType::class)
            ->getForm();

            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La catégorie a été ajoutée.');

            return $this->redirectToRoute('app_cameras');
        }

        return $this->render('Camera/add.html.twig', array(
            'title' => 'Ajout d\'une nouvelle catégorie',
            'form' => $form->createView()
        ));
    }
}
