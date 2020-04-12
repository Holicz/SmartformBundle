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
                        'class' => 'smartform-whole-address',
                    ]
                ]
            )
            ->add(
                'code',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-CODE']
                ]
            )
            ->add(
                'latitude',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-GPS_LAT']
                ]
            )
            ->add(
                'longitude',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-GPS_LONG']
                ]
            )
            ->add(
                'street',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-STREET'],
                ]
            )
            ->add(
                'cityPart',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-PART'],
                ]
            )
            ->add(
                'houseNumber',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-NUMBER_POPISNE'],
                ]
            )
            ->add(
                'orientationNumber',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-NUMBER_ORIENTACNI'],
                ]
            )
            ->add(
                'city',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-CITY'],
                ]
            )
            ->add(
                'zipCode',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-ZIP'],
                ]
            )
            ->add(
                'district',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-DISTRICT']
                ]
            )
            ->add(
                'region',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-REGION']
                ]
            )
            ->add(
                'country',
                HiddenType::class,
                [
                    'attr' => ['class' => 'smartform-field-COUNTRY']
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => SmartformAddressModel::class,
                'error_bubbling' => false
            ]
        );
    }

    public function getBlockPrefix(): string
    {
        return 'dobry_programator_smartform_';
    }
}
