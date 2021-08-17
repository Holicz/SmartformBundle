<?php

declare(strict_types=1);

namespace DobryProgramator\SmartformBundle\Form\Type;

use DobryProgramator\SmartformBundle\Form\Model\SmartformAddressModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SmartformWholeAddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface<FormBuilderInterface> $builder
     * @param array<string, string> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'address',
                TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' => 'smartform-whole-address smartform-instance-'. $options['class'],
                    ]
                ]
            )
            ->add(
                'code',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-CODE smartform-instance-'. $options['class']]
                ]
            )
            ->add(
                'latitude',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-GPS_LAT smartform-instance-'. $options['class']]
                ]
            )
            ->add(
                'longitude',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-GPS_LONG smartform-instance-'. $options['class']]
                ]
            )
            ->add(
                'street',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-STREET smartform-instance-'. $options['class']],
                ]
            )
            ->add(
                'cityPart',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-PART smartform-instance-'. $options['class']],
                ]
            )
            ->add(
                'houseNumber',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-NUMBER_POPISNE smartform-instance-'. $options['class']],
                ]
            )
            ->add(
                'orientationNumber',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-NUMBER_ORIENTACNI smartform-instance-'. $options['class']],
                ]
            )
            ->add(
                'evidenceNumber',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-NUMBER_EVIDENCNI smartform-instance-'. $options['class']],
                ]
            )
            ->add(
                'city',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-CITY smartform-instance-'. $options['class']],
                ]
            )
            ->add(
                'zipCode',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-ZIP smartform-instance-'. $options['class']],
                ]
            )
            ->add(
                'district',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-DISTRICT smartform-instance-'. $options['class']]
                ]
            )
            ->add(
                'region',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-REGION smartform-instance-'. $options['class']]
                ]
            )
            ->add(
                'country',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-COUNTRY smartform-instance-'. $options['class']]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => SmartformAddressModel::class,
                'error_bubbling' => false,
                'class' => 'default',
            ]
        );
    }

    public function getBlockPrefix(): string
    {
        return 'dobry_programator_smartform_';
    }
}
