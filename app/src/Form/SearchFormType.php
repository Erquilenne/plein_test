<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('count', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 20,
                ],
                'label' => 'Количество элементов'
            ])
            ->add('date_from', TextType::class, [
                'attr' => ['class' => 'js-datepicker'],
                'label' => 'От'
            ])
            ->add('date_to', TextType::class, [
                'attr' => ['class' => 'js-datepicker'],
                'label' => 'До'
            ])
            ->add('currency_code', ChoiceType::class, [
                'choices' => [
                    'EUR' => 'EUR',
                    'USD' => 'USD',
                    'RUR' => 'RUR',
                ],
                'label' => 'Код валюты'
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Получить заказы'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
