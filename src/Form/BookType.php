<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Genre;
use App\Entity\Author;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',TextType::class)
        ->add('sum', TextAreaType::class)
        ->add('genre', EntityType::class, [ 'class' => Genre::class])
        ->add('author', EntityType::class, ['class'=> Author::class])
        ->add('adddate', DateType::class)
        ->add('save', SubmitType::class)
        ;
    }
}