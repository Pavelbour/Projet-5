<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\MessagePrivate;
    use App\Entity\User;
    use App\Form\MessagePrivateType;

    class MessagePrivateController extends Controller
    {
        public function addMessage(Request $request, $id)
        {
            // create a new message

            $message = new MessagePrivate();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(MessagePrivateType::class, $message);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $message->setAdded(new \DateTime());
                $message->setFromUser($this->getUser());
                $user = $em->getRepository(User::class)->find($id);
                $message->setToUser($user);
                $em->persist($message);
                $em->flush();
                $request->getSession()->getFlashBag()->add('info', 'Votre message a été envoyé.');

                return $this->redirectToRoute('app_home');
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Envoyer un message.',
                'form' => $form->createView()
            ));
        }

        public function displayMessages()
        {
            // displays a list of private messages
            $messages = $this->getDoctrine()->getManager()->getRepository(MessagePrivate::class)->findByToUser($this->getUser());

            return $this->render('Camera/privatemessages.html.twig', array(
                'messages' => $messages
            ));
        }
    }