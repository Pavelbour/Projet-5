<?php
    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Entity\User;

    class UserType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('username', TextType::class, array(
                    'label' => 'Pseudo'
                ))
                ->add('email', TextType::class, array(
                    'label' => 'Email'
                ))
                ->add('password', PasswordType::class, array(
                    'label' => 'Mot de passe'
                ))
                ->add('confirmation', PasswordType::class, array(
                    'label' => 'Confirmez votre mot de pass',
                    'mapped' => false
                ))
                ->add('avatar', FileType::class, array(
                    'required' => false
                ))
                ->add('privacy', CheckboxType::class, array(
                    'label' => 'J\'ai lu et j\'accèpte les règles de confidentialité'
                ))
                ->add('Enrigistrer', SubmitType::class);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => User::class
            ));
        }
    }