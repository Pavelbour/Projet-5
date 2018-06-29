<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\File\File;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\ForumTheme;
    use App\Entity\Lens;
    use App\Entity\LensComment;
    use App\Form\LensCommentType;
    use App\Form\LensType;
    use App\Form\LensFilterType;
    use App\Service\FileUploader;

    class LensController extends Controller
    {
        public function lensesPage(Request $request, $id)
        {
            $lens = new Lens();
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Lens::class);

            $form = $this->createForm(LensFilterType::class, $lens);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $listLenses = $repository->filter($id, $lens->getManufacturer(), $lens->getMonture());

            } else {
                $listLenses = $repository->filter($id);
            }

            if ($id == 1) {
                $id = 2;
            }

            return $this->render('Camera/lenses.html.twig', array(
                'list' => $listLenses,
                'id' => $id,
                'form' => $form->createView()
            ));
        }

        public function lens(Request $request, $id)
        {
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Lens::class);

            $lens = $repository->find($id);
            $comment = new LensComment;
            $form = $this->createForm(LensCommentType::class, $comment);

            $form->handleRequest($request);

            $comments = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(LensComment::class)
            ->findByLensId($lens);

            if ($form->isSubmitted() && $form->isValid() && $this->getUser()) {

                $em = $this->getDoctrine()->getManager();
                $comment->setLensId($lens);
                $comment->setUserId($this->getUser());
                $date = new \DateTime();
                $comment->setAdded($date);
                $em->persist($comment);
                $em->flush();
                $request->getSession()->getFlashBag()->add('info', 'Le commentaire a été publié');

                return $this->redirectToRoute('app_lens', array(
                    'id' => $id
                ));
            }

            return $this->render('Camera/lens.html.twig', array(
                'lens' => $lens,
                'comments' => $comments,
                'form' => $form->createView()
            ));
        }

        public function addLens(Request $request, FileUploader $fileUploader)
        {

            $lens = new Lens();
            $form = $this->createForm(LensType::class, $lens);
                
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                if ($lens->getImage != null){
                    $file = $lens->getImage();

                    $fileName = $fileUploader->upload($file);
                    $lens->setImage($fileName);
                }
                $forum = new ForumTheme();
                $forum->setTheme($lens->getName());
                $forum->setThemeParent('Objectifs de '.$lens->getManufacturer()->getManufacturer());
                $em = $this->getDoctrine()->getManager();
                $em->persist($forum);
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

        public function modifyLens(Request $request, FileUploader $fileUploader, $id)
        {

            $em = $this->getDoctrine()->getManager();
            $lens = $em->getRepository(Lens::class)->find($id);
            if ($lens->getImage != null) {
                $lens->setImage(new File($this->getParameter('img').'/'.$lens->getImage()));
            }

            $form = $this->createForm(LensType::class, $lens);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                if ($lens->getImage != null) {
                    $file = $lens->getImage();

                    $fileName = $fileUploader->upload($file);
                    $lens->setImage($fileName);
                }

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
            $theme = $em->getRepository(ForumTheme::class)->findByTheme($lens->getName());
            $theme[0]->setThemeParent('Archives');
            $em->remove($lens);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'L\'objectif a été effacé');
            return $this->redirectToRoute('app_lenses_page', array(
                'id' => 1
            ));
        }
    }   