<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
    use App\Entity\User;
    use App\Form\UserType;

    class UserController extends Controller
    {

        public function addUser(Request $request, UserPasswordEncoderInterface $encoder)
        {

            $user = new User();
            $user->setSalt('');
            $user->setRoles(array('ROLE_USER'));

            $form = $this->createForm(UserType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid() && $form->get('password')->getData() == $form->get('confirmation')->getData()) {

                $encoded = $encoder->encodePassword($user, $form->get('password')->getData());
                $user->setPassword($encoded);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('app_home');
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Inscription',
                'form' => $form->createView()
            ));
        }

        public function users()
        {
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(User::class);

            $listUsers = $repository->findAll();


            return $this->render('Camera/users.html.twig', array(
                'list' => $listUsers
            ));
        }

        public function modifyUser(Request $request, $id)
        {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $form = $this->createForm(UserType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid() && $user->getPassword() == $form->get('confirmation')->getData()) {

                $em->flush();

                return $this->redirectToRoute('app_user');
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Modification du profil',
                'form' => $form->createView()
            ));
        }

        public function modifyCurrentUser(Request $request)
        {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            if ($user) {
                $form = $this->createForm(UserType::class, $user);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid() && $user->getPassword() == $form->get('confirmation')->getData()) {
                    $em->persist($user);
                    $em->flush();

                    return $this->redirectToRoute('app_user');
                }

                return $this->render('Camera/add.html.twig', array(
                    'title' => 'Modification du profil',
                    'form' => $form->createView()
                ));
            } else {
                return $this->redirectToRoute('login');
            }
        }

        public function setAdmin($id)
        {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $user->setRoles(array('ROLE_ADMIN'));
            $em->flush();

            return $this->redirectToRoute('app_list_of_users');
        }

        public function deleteUser($id)
        {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $em->remove($user);
            $em->flush();
            return $this->redirectToRoute('app_list_of_users');
        }
    }