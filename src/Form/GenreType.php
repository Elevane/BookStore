<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Typeitem;

class GenreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr' => ['class' => "col-sm"]])
            ->add('typeitem', EntityType::class, ['class' => TypeItem::class, 'choice_label' => 'name',])
            ->add('save', SubmitType::class, ['attr' => ['class' => "btn btn-primary"]])
        ;
    }
}