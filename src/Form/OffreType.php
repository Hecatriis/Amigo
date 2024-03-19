<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\Offre;
use App\Entity\PartenaireEntreprise;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titreOffre', options: [
                'label' => 'Titre'
            ])
            ->add('villeOffre', options: [
                'label' => 'Ville'
            ])
            ->add('codePostalOffre', options: [
                'label' => 'Code postal'
            ])
            ->add('typeOffre', ChoiceType::class, [
                'choices' => [
                    'Alternance' => 'alternance',
                    'Stage' => 'Stage',
                ],
                'label' => 'Type d\'offre'
            ])
            ->add('resumeOffre', options: [
                'label' => 'Résumé de l\'offre'
            ])
            ->add('contenuOffre', options: [
                'label' => 'Contenu de l\'offre'
            ])
            ->add('entreprise', EntityType::class, [
                'class' => PartenaireEntreprise::class,
                'choice_label' => 'nomEntreprise',
            ])
            ->add('competences', EntityType::class, [
                'class' => Competence::class,
                'choice_label' => 'libelleCompetence',
                'multiple' => true,
                'label' => 'Compétences'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
