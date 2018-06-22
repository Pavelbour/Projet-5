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
    }