<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
    use App\Entity\User;
    use App\Form\UserType;
    use App\Service\FileUploader;

    class UserController extends Controller
    {

        public function addUser(Request $request, FileUploader $fileUploader, UserPasswordEncoderInterface $encoder)
        {
            // sign up a new user
            $user = new User();
            $user->setSalt('');
            $user->setRoles(array('ROLE_USER'));

            $form = $this->createForm(UserType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid() && $form->get('password')->getData() == $form->get('confirmation')->getData()) {
                if ($user->getAvatar() != null) {
                    $file = $user->getAvatar();

                    $fileName = $fileUploader->upload($file);
                    $user->setAvatar($fileName);
                }

                $encoded = $encoder->encodePassword($user, $form->get('password')->getData());
                $user->setPassword($encoded);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $this->addFlash('info', 'Maintenant, vous êtes inscrit*e');

                return $this->redirectToRoute('app_home');
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Inscription',
                'form' => $form->createView()
            ));
        }

        public function users()
        {
            // display the list of users
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(User::class);

            $listUsers = $repository->findAll();


            return $this->render('Camera/users.html.twig', array(
                'list' => $listUsers
            ));
        }

        public function modifyUser(Request $request, FileUploader $fileUploader, $id, UserPasswordEncoderInterface $encoder)
        {
            // modify the profil of the user
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            if ($user->getAvatar() != null){
                $user->setAvatar(new File($this->getParameter('avatars').'/'.$user->getAvatar()));
            }
            $form = $this->createForm(UserType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid() && $user->getPassword() == $form->get('confirmation')->getData()) {
                
                $encoded = $encoder->encodePassword($user, $form->get('password')->getData());
                $user->setPassword($encoded);
                $em->flush();
                $this->addFlash('info', 'Le profil a été modifié');

                return $this->redirectToRoute('app_user');
            }

            return $this->render('Camera/add.html.twig', array(
                'title' => 'Modification du profil',
                'form' => $form->createView()
            ));
        }

        public function modifyCurrentUser(Request $request, FileUploader $fileUploader, UserPasswordEncoderInterface $encoder)
        {
            // modify the profil of the logged in user
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            if ($user) {
                if ($user->getAvatar() != null){
                    $user->setAvatar(new File($this->getParameter('avatars').'/'.$user->getAvatar()));
                }
                $form = $this->createForm(UserType::class, $user);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid() && $user->getPassword() == $form->get('confirmation')->getData()) {
                    
                    $encoded = $encoder->encodePassword($user, $form->get('password')->getData());
                    $user->setPassword($encoded);
                    $em->persist($user);
                    $em->flush();
                    $this->addFlash('info', 'Votre profil a été modifié');

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

        public function setAdmin(Request $request, $id)
        {
            // the user with id = $id became admin
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $user->setRoles(array('ROLE_ADMIN'));
            $em->flush();
            $this->addFlash('info', 'L\'utilisateur est devenu administrateur');

            return $this->redirectToRoute('app_list_of_users');
        }

        public function deleteUser(Request $request, $id)
        {
            // deletes the user with id = $id
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $em->remove($user);
            $em->flush();
            $this->addFlash('info', 'Le profil de l\'utilisateur a été effacé');
            return $this->redirectToRoute('app_list_of_users');
        }

        public function deleteCurrentUser(Request $request)
        {
            // deletes the logged in user
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            // force manual logout of logged in user
            $this->get('security.token_storage')->setToken(null);
            $em->remove($user);
            $em->flush();
            $this->addFlash('info', 'Votre profil a été effacé');
            return $this->redirectToRoute('login');
        }
    }