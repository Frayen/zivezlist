<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchAnimeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $option = [
            'label' => false,
            'required' => false,
            'attr' => [
                'readonly' => false,
                'class' => 'input'
            ],
            'row_attr' => [

            ]
        ];

        $option['attr']['placeholder'] = 'All';
        $builder->add('season', TextType::class, $option);

        $option['attr']['placeholder'] = 'Sort';
        $builder->add('sort', TextType::class, $option);

        $option['attr']['placeholder'] = 'Format';
        $builder->add('format', TextType::class, $option);

        $option['attr']['placeholder'] = 'Status';
        $builder->add('status', TextType::class, $option);

        $option['attr']['placeholder'] = 'Country';
        $builder->add('country', TextType::class, $option);

        $option['attr']['placeholder'] = 'Source';
        $builder->add('source', TextType::class, $option);

        $option['attr']['readonly'] = false;
        $option['attr']['placeholder'] = 'search';
        $builder->add('search', TextType::class, $option);

        $option['label'] = 'Hide from my list';
        $builder->add('hide_list', CheckboxType::class, $option);

        $option['label'] = 'Show adult content';
        $builder->add('adult', CheckboxType::class, $option);

        $builder
            ->add('year', HiddenType::class, $option)
            ->add('year_greater', HiddenType::class, $option)
            ->add('year_lesser', HiddenType::class, $option);


        $builder->add('genre_in', ChoiceType::class, [
            'label' => false,
            'choices' => array_values($options['genres']),
            'choice_label' => false,
            'expanded' => true,
            'multiple'=> true,
            'choice_attr' => function ($choice, $key, $value) {
                return ['class' => 'include'];
            },
        ]);
        $builder->add('genre_out', ChoiceType::class, [
            'label' => false,
            'choices' => array_values($options['genres']),
            'choice_label' => false,
            'expanded' => true,
            'multiple'=> true,
            'choice_attr' => function ($choice, $key, $value) {
                return ['class' => 'exclude'];
            },
        ]);

        $builder->add('tag_in', ChoiceType::class, [
            'label' => false,
            'choices' => $options['tags'],
            'choice_label' => function ($choice, $key, $value) {

                return $choice;
            },
            'expanded' => true,
            'multiple'=> true,
            'choice_attr' => function ($choice, $key, $value) {
                return ['class' => 'exclude'];
            },
        ]);
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'genres' => 1,
            'tags' => null,
            'data_class' => 'App\Entity\SearchAnime',
        ]);
    }

}