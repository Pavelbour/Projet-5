<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\ForumMessage;
    use App\Entity\ForumTheme;
    use App\Form\ForumThemeType;
    use App\Service\Pagination;

    class ForumThemeController extends Controller
    {

        public function theme(Request $request, Pagination $pagination, $theme, $page, $mpage)
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
            $pList = $pagination->numberPages($nT, 2);
            $mList = $pagination->numberPages($nM, 2);

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

            $breadcrumb = $this->breadcrumb($theme);

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
                'mlist' => (integer)$mList,
                'breadcrumb' => $breadcrumb
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

        private function breadcrumb($theme)
        {
            $repository = $this->getDoctrine()->getManager()->getRepository(ForumTheme::class);
            $breadcrumb = array();
            $currentTheme = $repository->findByTheme($theme);
            $currentTheme = $currentTheme[0];
            for ($i=0; $currentTheme->getTheme() != 'Forum'; $i++)
            {
                $breadcrumb[$i] = $currentTheme->getTheme();
                $theme = $repository->findByTheme($currentTheme->getThemeParent());
                $currentTheme = $theme[0];
            }
            $breadcrumb[$i+1] = 'Forum';
            return array_reverse($breadcrumb);
        }
    }