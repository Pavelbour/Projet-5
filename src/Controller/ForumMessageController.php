<?php

    namespace App\Controller;

    use App\Entity\ForumMessage;
    use App\Entity\ForumTheme;
    use App\Form\ForumMessageType;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;

    class ForumMessageController extends Controller
    {
        public function addMessage(Request $request, $theme)
        {
            $message = new ForumMessage();
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository(ForumTheme::class);
            $form = $this->createForm(ForumMessageType::class, $message);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $message->setAdded(new \DateTime());
                $message->setUser($this->getUser());
                $themes = $repository->findByTheme($theme);
                $message->setTheme($themes[0]);
                $em->persist($message);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Le message a été ajouté.');
                return $this->redirectToRoute('app_forum', array(
                    'theme' => $theme,
                    'page' => 1,
                    'mpage' => 1
                ));
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Publier un message',
                'form' => $form->createView()
            ));
        }

        public function modifyMessage(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository(ForumMessage::class);
            $message = $repository->find($id);
            $form = $this->createForm(ForumMessageType::class, $message);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Le message a été modifié.');
                return $this->redirectToRoute('app_admin');
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Modifier le message',
                'form' => $form->createView()
            ));
        }

        public function deleteMessage(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();
            $message = $em->getRepository(ForumMessage::class)->find($id);
            $em->remove($message);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Le message a été effacé.');
            return $this->redirectToRoute('app_admin');
        }
    }