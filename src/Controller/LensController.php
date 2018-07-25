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
    use App\Service\Pagination;

    class LensController extends Controller
    {
        public function lensesPage(Request $request, Pagination $pagination, $id)
        {
            // displays the list of the lenses
            $lens = new Lens();
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Lens::class);

            $form = $this->createForm(LensFilterType::class, $lens);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $listLenses = $repository->filter($id, $lens->getManufacturer(), $lens->getMonture());
                $numberLenses = $repository->filterNumber($lens->getManufacturer(), $lens->getMonture());
                $numberPages = $pagination->numberPages($numberLenses, 10);
            } else {
                $listLenses = $repository->filter($id);
                $numberLenses = $repository->filterNumber();
                $numberPages = $pagination->numberPages($numberLenses, 10);
            }

            return $this->render('Camera/lenses.html.twig', array(
                'list' => $listLenses,
                'id' => $id,
                'form' => $form->createView(),
                'numberPages' => (int)$numberPages
            ));
        }

        public function lens(Request $request, $id)
        {
            // display the page of a lens
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
            // adds a new lens

            $lens = new Lens();
            $form = $this->createForm(LensType::class, $lens);
                
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                if ($lens->getImage() != null){
                    $file = $lens->getImage();

                    $fileName = $fileUploader->upload($file);
                    $lens->setImage($fileName);
                }
                $forum = new ForumTheme();
                $forum->setTheme($lens->getName());
                $forum->setParentId($lens->getManufacturer()->getTheme()->getId());
                $lens->setTheme($forum);
                // persists the new lens into the database
                $em = $this->getDoctrine()->getManager();
                $em->persist($forum);
                $em->persist($lens);
                $em->flush();
                $this->addFlash('info', 'L\'objectif a été ajouté');

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
            // modify a lens
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
                $this->addFlash('info', 'L\'objectif a été modifié');

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
            // deletes a lens
            $em = $this->getDoctrine()->getManager();
            $lens = $em->getRepository(Lens::class)->find($id);
            $theme = $em->getRepository(ForumTheme::class)->find($lens->getTheme()->getId());
            $theme->setParentId(7);
            $em->remove($lens);
            $em->flush();
            $this->addFlash('info', 'L\'objectif a été effacé');
            return $this->redirectToRoute('app_lenses_page', array(
                'id' => 1
            ));
        }

        public function deleteComment($id, $lensId)
        {
            // deletes a comment
            $em = $this->getDoctrine()->getManager();
            $comment = $em->getRepository(LensComment::class)->find($id);
            $em->remove($comment);
            $em->flush();
            $this->addFlash('info', 'Le commentaire a été effacé.');
            return $this->redirectToRoute('app_lens', array(
                'id' => $lensId
            ));
        }
    }   