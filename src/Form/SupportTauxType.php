<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\SchemaTaux;
use App\Entity\Emetteur;
use App\Entity\Schema;
use App\Entity\Support;
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

class SupportTauxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idSupport', EntityType::class, [
                'label' => 'Support : ',
                'class' => Support::class ,
                'attr' => ['class' => 'js-example-basic-single'],
                'query_builder' => function(SupportRepository $er)
                {
                    return $er->createQueryBuilder('s')->orderBy('s.nom' , 'DESC');
                } ,
                'choice_label' => 'nom',])
            ->add('idSchema', EntityType::class, [
                'label' => 'Schema : ',
                'class' => Schema::class ,
                'attr' => ['class' => 'js-example-basic-single'],
                'query_builder' => function(SchemaRepository $er)
                {
                    return $er->createQueryBuilder('s')->orderBy('s.nom' , 'DESC');
                } ,
                'choice_label' => 'nom',])
            ->add('taux', TextType::class, [
                'label' => 'Taux Client',
                'required' => false,
                'empty_data' => '',])
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
            ->add('tauxEmetteur', TextType::class, [
                'label' => 'Taux Emetteur',
                'required' => false,
                'empty_data' => '',])
            ->add('tauxCnp', TextType::class, [
                'label' => 'Taux Cnp',
                'required' => false,
                'empty_data' => '',])
            ->add('tauxDistributeur', TextType::class, [
                'label' => 'Taux Distributeur',
                'required' => false,
                'empty_data' => '',])
            ->add('partCnp', TextType::class, [
                'label' => 'Part Cnp',
                'required' => false,
                'empty_data' => '',])
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
