<?php
    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Entity\Lens;

    class LensType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('Manufacturer', EntityType::class, array(
                    'class' => 'App\Entity\LensManufacturer',
                    'choice_label' => 'manufacturer',
                    'label' => 'Fabricant'
                ))
                ->add('Name', TextType::class, array(
                    'label' => 'Nom'
                ))
                ->add('Monture', EntityType::class, array(
                    'class' => 'App\Entity\Monture',
                    'choice_label' => 'monture'
                ))
                ->add('Length', TextType::class, array(
                    'label' => 'Longueur'
                ))
                ->add('Diameter', TextType::class, array(
                    'label' => 'Diamètre'
                ))
                ->add('Weight', TextType::class, array(
                    'label' => 'Poids'
                ))
                ->add('Focal_length_min', TextType::class, array(
                    'label' => 'Distance focale min'
                ))
                ->add('Focal_length_max', TextType::class, array(
                    'label' => 'Distance focale max'
                ))
                ->add('Focuse', TextType::class, array(
                    'label' => 'MAP min'
                ))
                ->add('Aperture', TextType::class, array(
                    'label' => 'Ouverture'
                ))
                ->add('Diameter_of_filter', TextType::class, array(
                    'label' => 'Diamètre de filtre'
                ))
                ->add('Description', TextareaType::class)
                ->add('ForManufacturer', EntityType::class, array(
                    'class' => 'App\Entity\CamManufacturer',
                    'choice_label' => 'manufacturer',
                    'multiple' => 'true',
                    'label' => 'Pour'
                ))
                ->add('Enrigistrer', SubmitType::class);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => Lens::class
            ));
        }
    }