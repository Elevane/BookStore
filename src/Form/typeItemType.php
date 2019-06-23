<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Genre;

class typeItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr' => ['class' => "col-sm"]])
            ->add('genre', EntityType::class, ['class' => Genre::class, 'choice_label' => 'name',])
            ->add('save', SubmitType::class, ['attr' => ['class' => "btn btn-primary"]])
        ;
    }
}