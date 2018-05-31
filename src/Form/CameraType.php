<?php
    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use App\Entity\Camera;

    class CameraType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('Manufacturer', EntityType::class, array(
                    'class' => 'App\Entity\CamManufacturer',
                    'choice_label' => 'manufacturer',
                    'label' => 'Fabricant'
                ))
                ->add('CameraName', TextType::class, array(
                    'label' => 'Nom'
                ))
                ->add('Sensor', TextType::class, array(
                    'label' => 'Capteur'
                ))
                ->add('Monture', EntityType::class, array(
                    'class' => 'App\Entity\Monture',
                    'choice_label' => 'monture',
                    'multiple' => 'true'
                ))
                ->add('Length', TextType::class, array(
                    'label' => 'Longueur'
                ))
                ->add('Width', TextType::class, array(
                    'label' => 'Largeur'
                ))
                ->add('Height', TextType::class, array(
                    'label' => 'Hauteur'
                ))
                ->add('Weight', TextType::class, array(
                    'label' => 'Poids'
                ))
                ->add('Time', TextType::class, array(
                    'label' => 'Obturation'
                ))
                ->add('Description', TextareaType::class)
                ->add('Category', EntityType::class, array(
                    'class' => 'App\Entity\CamCategory',
                    'choice_label' => 'category',
                    'label' => 'Type'
                ))
                ->add('Enrigistrer', SubmitType::class);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => Camera::class
            ));
        }
    }