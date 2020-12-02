<?php

namespace App\Form\Admin;

use App\Entity\Admin\BaseIngredient;
use App\Entity\Admin\BasePizza;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BasePizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            /* je dit que je prend une EntityType pour pouvoir selectioner mes ingredient de la base en option
            pour sela je doit definir dans quelle entity avec 'class'=> BaseIngredient
            puis je choisi la colonne de ma table */
            ->add('baseIngredient',EntityType::class,[
                'label'=> "ingredient de la base",
                'class'=> BaseIngredient::class,
                'choice_label'=> 'name'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BasePizza::class,
        ]);
    }
}
