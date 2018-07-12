<?php

namespace App\Form;

use App\Entity\Idea;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class IdeaType
 */
class IdeaType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('title')
          ->add('save', SubmitType::class);

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
           /** @todo add the current user. */
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
          [
            'data_class' => Idea::class,
            'csrf_protection' => true,
          ]
        );
    }
}