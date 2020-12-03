<?php

namespace App\Form\Admin;

use App\Entity\Admin\BaseIngredient;
use App\Entity\Admin\BasePizza;
use App\Entity\Admin\Cheese;
use App\Entity\Admin\Fish;
use App\Entity\Admin\Legume;
use App\Entity\Admin\Meat;
use App\Entity\Admin\Other;
use App\Entity\Admin\Pizza;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null,[
                'label'=> 'nom de la pizza :'
            ])
            ->add('comment', null,[
                "label"=>'option pour (calzone)'
            ])

            ->add('price', null,[
                'label'=>'prix :'
            ])

            ->add('basepizza',EntityType::class,[
                'class'=>BasePizza::class,
                'choice_label'=>'name',
                'label'=>' choix de la base :'
            ])

            ->add('baseIngredient',EntityType::class,[
                    'class'=>BaseIngredient::class,
                    'choice_label'=>'name',
                    'label'=>'choix du premier ingredient :'
            ])

            ->add('meat',EntityType::class,[
                'class'=>Meat::class,
                'choice_label'=> 'name',
                'multiple'=> true,
                'label'=> 'viande :',
                'required'=>false,


            ])

            ->add('fish',EntityType::class,[
                'class'=>Fish::class,
                'choice_label'=>'name',
                'multiple'=> true,
                'label'=> 'produits de la mer :',
                'required'=>false,

            ])

            ->add('legume',EntityType::class,[
                'class'=>Legume::class,
                'choice_label'=>'name',
                'multiple'=> true,
                'label'=> 'légume :',
                'required'=>false,

            ])

            ->add('cheese',EntityType::class,[
                'class'=>Cheese::class,
                'choice_label'=>'name',
                'multiple'=> true,
                'label'=> 'fromage :',
                'required'=>false,

            ])

            ->add('other', EntityType::class,[
                'class'=>Other::class,
                'choice_label'=>'name',
                'multiple'=> true,
                'label'=> 'autres :',
                'required'=>false,


            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}
