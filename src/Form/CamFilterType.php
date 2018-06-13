<?php
    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Entity\Camera;

    class CamFilterType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('Manufacturer', EntityType::class, array(
                    'class' => 'App\Entity\CamManufacturer',
                    'choice_label' => 'manufacturer',
                    'label' => 'Fabricant',
                    'required' => 'false'
                ))
                ->add('Category', EntityType::class, array(
                    'class' => 'App\Entity\CamCategory',
                    'choice_label' => 'category',
                    'label' => 'Type',
                    'required' => 'false'
                ))
                ->add('Appliquer', SubmitType::class);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => Camera::class
            ));
        }
    }