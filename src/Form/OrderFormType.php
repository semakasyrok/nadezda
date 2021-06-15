<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('link', TextType::class, [
                'attr' => ['class' => 'mb-4 mt-1'],
                'label' => 'Ссылка на облако'
            ])
            ->add('name', TextType::class, [
                'attr' => ['class' => 'mb-4 mt-1'],
                'label' => 'Ваше имя'
            ])
            ->add('size', ChoiceType::class, [
                'attr' => ['class' => 'mb-4 mt-1'],
                'label' => 'Размер',
                'choices' => [
                    'A3' => 'A3',
                    'A4' => 'A4',
                    'A5' => 'A5',
                ]
            ])
            ->add('phone', TextType::class, [
                'attr' => ['class' => 'mb-4 mt-1'],
                'label' => 'Номер телефона'
            ])
            ->add('paper', ChoiceType::class, [
                'choices' => [
                    'Матовая' => 'Матовая',
                    'Полуматовая' => 'Полуматовая',
                    'Глянцевая' => 'Глянцевая',
                ],
                'attr' => ['class' => 'mb-4 mt-1'],
                'label' => 'Бумага'
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'mb-4 mt-1'],
                'label' => 'Почта'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Отправить отзыв',
                'attr' => [
                    'class' => 'btn w-100 order_btn'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
