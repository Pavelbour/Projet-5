<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\ForumMessage;
    use App\Entity\ForumTheme;
    use App\Form\ForumThemeType;

    class ForumThemeController extends Controller
    {
        public function theme(Request $request, $theme, $page, $mpage)
        {
            $newTheme = new ForumTheme();
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository(ForumTheme::class);

            $list = $repository->findBy(
                array('themeParent' => $theme),
                array('id' => 'DESC'),
                10,
                ($page-1) * 10
            );

            if ($page == 1) {
                $page = 2;
            }

            $currentTheme = $repository->findByTheme($theme);
            $repository = $em->getRepository(ForumMessage::class);
            $messages = $repository->findBy(
                array('theme' => $currentTheme),
                array('id' => 'DESC'),
                10,
                ($mpage-1) * 10
            );
            
            $number = array();
            $lastMessages = array();
            foreach ($list as $element) {
                $currentNumber = $repository->getNumber($element);
                $number[$element->getTheme()] = $currentNumber[0]['t'];
                $lastMessage = $repository->findBy(
                    array('theme' => $element->getTheme()),
                    array('id' => 'DESC'),
                    1,
                    0
                );
                if ( isset($lastMessage[0])) {
                    $lastMessages[$element->getTheme()] = $lastMessage[0];
                }
            }

            return $this->render('Camera/forum.html.twig', array(
                'theme' => $theme,
                'list' => $list,
                'messages' => $messages,
                'lastmessages' => $lastMessages,
                'number' => $number,
                'page' => $page
            ));
        }

        public function addTheme(Request $request, $theme)
        {
            $newTheme = new ForumTheme();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(ForumThemeType::class, $newTheme);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $newTheme->setThemeParent($theme);
                $em->persist($newTheme);
                $em->flush();
                $request->getSession()->getFlashBag()->add('info', 'Le nouveau thème a été ajouté.');

                return $this->redirectToRoute('app_forum', array(
                    'theme' => $theme,
                    'page' => 1,
                    'mpage' => 1
                ));
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Ajouter un nouveau thème',
                'form' => $form->createView()
            ));
        }
    }