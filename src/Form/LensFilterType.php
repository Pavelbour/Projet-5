<?php
    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Entity\Lens;

    class LensFilterType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('Manufacturer', EntityType::class, array(
                    'class' => 'App\Entity\LensManufacturer',
                    'choice_label' => 'manufacturer',
                    'label' => 'Fabricant',
                    'required' => 'false'
                ))
                ->add('Monture', EntityType::class, array(
                    'class' => 'App\Entity\Monture',
                    'choice_label' => 'monture',
                    'label' => 'Monture',
                    'required' => 'false'
                ))
                ->add('Appliquer', SubmitType::class);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => Lens::class
            ));
        }
    }