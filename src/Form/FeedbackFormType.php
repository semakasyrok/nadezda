<?php

namespace App\Form;

use App\Entity\Feedback;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeedbackFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', TextType::class, [
                'attr' => ['class' => 'mb-1 mt-1'],
                'label' => 'Отзыв'
            ])
            ->add('name', TextType::class, [
                'attr' => ['class' => 'mb-4 mt-1'],
                'label' => 'Ваше имя'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Отправить отзыв',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class,
        ]);
    }
}
