<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\ForumMessage;
    use App\Entity\ForumTheme;
    use App\Form\ForumThemeType;

    class ForumThemeController extends Controller
    {
        protected function numberPages($nombre, $epp)
        {
            if (($nombre % $epp) == 0) {
                return $nombre / $epp;
            } else {
                return ($nombre / $epp) + 1;
            }
        }

        public function theme(Request $request, $theme, $page, $mpage)
        {
            $em = $this->getDoctrine()->getManager();
            $tRepository = $em->getRepository(ForumTheme::class);
            $mRepository = $em->getRepository(ForumMessage::class);
            $currentTheme = $tRepository->findOneByTheme($theme);

            $list = $tRepository->findBy(
                array('themeParent' => $theme),
                array('id' => 'DESC'),
                2,
                ($page-1) * 2
            );

            $numberOfThemes = $tRepository->getNumber($theme);
            $numberOfMessages = $mRepository->getNumber($currentTheme);
            $nT = $numberOfThemes[0]['t'];
            $nM = $numberOfMessages[0]['t'];
            $pList = $this->numberPages($nT, 2);
            $mList = $this->numberPages($nM, 2);

            $messages = $mRepository->findBy(
                array('theme' => $currentTheme),
                array('id' => 'DESC'),
                2,
                ($mpage-1) * 2
            );

            $number = array();
            $themes = array();
            $lastMessages = array();

            foreach ($list as $element) {
                $mNumber = $mRepository->getNumber($element);
                $tNumber = $tRepository->getNumber($element->getTheme());

                $number[$element->getTheme()] = $mNumber[0]['t'];
                $themes[$element->getTheme()] = $tNumber[0]['t'];
                
                $lastMessage = $mRepository->findBy(
                    array('theme' => $element),
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
                'themes' => $themes,
                'page' => $page,
                'mpage' => $mpage,
                'plist' => (integer)$pList,
                'mlist' => (integer)$mList
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