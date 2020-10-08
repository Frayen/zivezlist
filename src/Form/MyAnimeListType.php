<?php

namespace App\Form;

use App\Entity\MyAnimeList;
use App\Entity\Notes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyAnimeListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mal_id')
            ->add('al_id')
            ->add('title')
            ->add('score')
            ->add('episode')
            ->add('rewatches')
            ->add('notes',NotesType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyAnimeList::class,
            'csrf_protection' => false
        ]);
    }
}
