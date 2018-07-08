<?php
    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Entity\MessageAdmin;

    class MessageAdminType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('theme', TextType::class, array(
                    'label' => 'Thème'
                ))
                ->add('message', TextareaType::class, array(
                    'label' => 'Message'
                ))
                ->add('Envoyer le message', SubmitType::class);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => MessageAdmin::class
            ));
        }
    }