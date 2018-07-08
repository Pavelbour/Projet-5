<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\MessageAdmin;
    use App\Form\MessageAdminType;
    use App\Service\Pagination;

    class MessageAdminController extends Controller
    {
        public function addMessage(Request $request)
        {
            $message = new MessageAdmin();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(MessageAdminType::class, $message);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $message->setDate(new \DateTime());
                $message->setUser($this->getUser());
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

        public function displayMessages(Pagination $pagination, $page)
        {
            $repository = $this->getDoctrine()->getManager()->getRepository(MessageAdmin::class);
            $numberMessages = $repository->getNumber();
            $number = $numberMessages[0]['t'];
            $numberPages = $pagination->numberPages($number, 10);
            $list = $repository->findBy(
                array(),
                array('id' => 'DESC'),
                10,
                ($page-1) * 10
            );

            return $this->render('Camera/messagesadmin.html.twig', array(
                'numberpages' => (integer)$numberPages,
                'list' => $list,
                'page' => $page
            ));
        }

        public function deleteMessage(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();
            $message = $em->getRepository(MessageAdmin::class)->find($id);
            $em->remove($message);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Le message a été effacé.');
            return $this->redirectToRoute('app_admin');
        }
    }