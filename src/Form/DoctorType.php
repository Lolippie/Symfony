<?php

namespace App\Form;

use App\Entity\Doctor;
use App\Entity\Specialty;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', options:['label'=> 'Prénom'])
            ->add('lastName', options:['label'=> 'Nom'])
            ->add('photoFile', FileType::class, ['required' => false, 'mapped' => false])
            ->add('phone', TelType::class, ['label'=> 'Téléphone',  'attr' => ['placeholder' => '06 00 00 00 00', 'pattern' => '(?:0|\+33)[1-9](?:[ .\-]?\d{2}){4}']])
            ->add('email', EmailType::class)
            ->add('description')
            ->add('specialties', EntityType::class, [
                'label' =>'Spécialité(s)',
                'class' => Specialty::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' =>true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
        ]);
    }
}
