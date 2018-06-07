<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\Lens;
    use App\Form\LensType;

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
            $form = $this->createForm(LensType::class, $lens);
                
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($lens);
                $em->flush();
                $request->getSession()->getFlashBag()->add('info', 'L\'objectif a été ajouté');

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

            $em = $this->getDoctrine()->getManager();
            $lens = $em->getRepository(Lens::class)->find($id);

            $form = $this->createForm(LensType::class, $lens);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em->flush();
                $request->getSession()->getFlashBag()->add('info', 'L\'objectif a été modifié');

                return $this->redirectToRoute('app_lens', array(
                    'id' => $lens->getId()
                ));
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Ajout d\'un nouveau objectif',
                'form' => $form->createView()
            ));
        }
        
        public function deleteLens(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();
            $lens = $em->getRepository(Lens::class)->find($id);
            $em->remove($lens);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'L\'objectif a été effacé');
            return $this->redirectToRoute('app_lenses');
        }
    }   