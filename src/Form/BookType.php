<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Genre;
use App\Entity\Author;
use App\Entity\Image;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BookType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('id', IntegerType::class)
        ->add('name',TextType::class)
        ->add('sum', TextAreaType::class)
        ->add('genre', TextType::class)
        ->add('author', TextType::class)
        ->add('image', EntityType::class, [ 'class' => Image::class,
        'choice_label' => 'name'])
        ->add('rate', IntegerType::class)
        ->add('adddate', DateType::class)
        ->add('save', SubmitType::class)
        ;
    }
}