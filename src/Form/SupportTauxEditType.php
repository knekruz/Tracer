<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\SchemaTaux;
use App\Entity\Emetteur;
use App\Entity\Schema;
use App\Entity\SupportTaux;
use App\Repository\SupportRepository;
use App\Repository\SchemaRepository;
use App\Repository\EmetteurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupportTauxEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tauxMfex', TextType::class, [
                'label' => 'Taux Mfex',
                'required' => false,
                'empty_data' => '',])
            ->add('tauxBrut', TextType::class, [
                'label' => 'Taux Brut',
                'required' => false,
                'empty_data' => '',])
            ->add('tauxNet', TextType::class, [
                'label' => 'Taux Net',
                'required' => false,
                'empty_data' => '',])
            ->add('taux', TextType::class, [
                'label' => 'Taux Client',
                'required' => false,])
            ->add('tauxEmetteur', TextType::class, [
                'label' => 'Taux MFEX',
                'required' => false,])
            ->add('tauxCnp', TextType::class, [
                'label' => 'Taux Cnp',
                'required' => false,])
            ->add('tauxDistributeur', TextType::class, [
                'label' => 'Taux Distributeur',
                'required' => false,])
            ->add('debutCommerce', DateType::class, [
                'label' => 'Date Début Commercialisation',
                'widget' => 'single_text',
                'required' => false,
                'empty_data' => '',])
            ->add('finCommerce', DateType::class, [
                'label' => 'Date Fin Commercialisation',
                'widget' => 'single_text',
                'required' => false,
                'empty_data' => '',])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SupportTaux::class,
        ]);
    }
}
