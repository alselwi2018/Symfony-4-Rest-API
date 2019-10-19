<?php

namespace App\Form;

use App\Entity\FlightTimes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class FlightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('flight_code')
            ->add('flight_from')
            ->add('flight_to')
            ->add('flight_date')
            ->add('flight_time')
            ->add('flight_arrival_time')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FlightTimes::class,

        ]);
    }
}
