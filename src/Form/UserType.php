<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        for ($i = 0; $i < $options['nbrUser']; $i++) {
            $j = $i + 1;
            $builder
                ->add('nom' . $j, TextType::class, [
                    'label' => 'Prénom/Nom',
                    'empty_data' => '',
                    'required' => true,
                ])
                ->add('depenses' . $j, NumberType::class, [
                    'label' => 'Dépenses',
                    'empty_data' => '',
                    'required' => true,
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'nbrUser' => 0,
        ]);
    }
}