<?php

namespace App\Form;

use App\Entity\Idea;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Class IdeaType
 */
class IdeaType extends AbstractType
{
    /** @var \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage */
    private $st;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->st = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $st = $this->st;
        $builder->add('title', TextType::class,
            [
              "label" => "title",
            ]
          );

        $builder->addEventListener(FormEvents::POST_SUBMIT,
          function (FormEvent $event) use ($st) {
              /** @var Idea $idea */
              $idea = $event->getData();
              $idea->setUser($st->getToken()->getUser());
          }
        );

        $builder->addEventListener(FormEvents::PRE_SET_DATA,
          function (FormEvent $event) {
              $idea = $event->getData();
              $form = $event->getForm();

              if ($idea) {
                  $form->add('created_at', DateTimeType::class,
                    [
                      "label" => "created",
                      "disabled" => true,
                    ]
                  )
                    ->add('updated_at', DateTimeType::class,
                      [
                        "label" => "updated",
                        "disabled" => true,
                      ]
                    );
              }
          }
        );
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
