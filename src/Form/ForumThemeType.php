<?php
    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Entity\ForumTheme;

    class ForumThemeType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('theme', TextType::class, array(
                    'label' => 'Nouveau thème'
                ))
                ->add('Ajouter', SubmitType::class);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => ForumTheme::class
            ));
        }
    }