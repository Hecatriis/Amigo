<?php

namespace App\Form;

use App\Entity\Bureau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;


class BureauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('Pole')
            ->add('Role')
            ->add('dateDebut')
            ->add('fichier', VichFileType::class, [
                'asset_helper' => false,
                'required' => false,
                'allow_delete' => false,
                'download_uri' => '',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bureau::class,
        ]);
    }
}
