<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\ForumTheme;
    use App\Form\ForumThemeType;

    class ForumThemeController extends Controller
    {
        public function theme(Request $request, $theme, $page)
        {
            $newTheme = new ForumTheme();
            $repository = $this->getDoctrine()->getManager()->getRepository(ForumTheme::class);
            $form = $this->createForm(ForumThemeType::class, $newTheme);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $this->addTheme($newTheme->getTheme(), $theme);
                $request->getSession()->getFlashBag()->add('info', 'Le nouveau thème a été ajouté.');
            }

            $list = $repository->findBy(
                array('themeParent' => $theme),
                array('id' => 'DESC'),
                10,
                ($page-1) * 10
            );

            if ($page == 1) {
                $page = 2;
            }

            return $this->render('Camera/forum.html.twig', array(
                'theme' => $theme,
                'list' => $list,
                'page' => $page,
                'form' => $form->createView()
            ));
        }

        public function addTheme($theme, $parent)
        {
            $newTheme = new ForumTheme();
            $newTheme->setTheme($theme);
            $newTheme->setThemeParent($parent);
            $em = $this->getDoctrine()->getManager();
            $em->persist($newTheme);
            $em->flush();
        }
    }