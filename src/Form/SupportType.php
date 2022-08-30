<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Emetteur;
use App\Entity\Schema;
use App\Entity\Support;
use App\Repository\CategorieRepository;
use App\Repository\SchemaRepository;
use App\Repository\EmetteurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isin', TextType::class, [
                'label' => 'ISIN',])
            ->add('nom', TextType::class, [
                'label' => 'Nom',])
            ->add('datePremierInvestist', DateType::class, [
                'label' => 'Date premier invesissement',
                'widget' => 'single_text',
                'required' => true,
                'empty_data' => '',])
            ->add('montantInvest', TextType::class, [
                'label' => 'Encours actuel',
                'required' => false,])
            ->add('emetteur', EntityType::class, [
                'label' => 'Emetteur : ',
                'class' => Emetteur::class ,
                'attr' => ['class' => 'js-example-basic-single'],
                'query_builder' => function(EmetteurRepository $er)
                {
                    return $er->createQueryBuilder('e')->orderBy('e.nom' , 'DESC');
                } ,
                'choice_label' => 'nom',])
            ->add('categories', EntityType::class, [
                'label' => 'Catégories    :',
                'class' => Categorie::class ,
                'attr' => ['class' => 'js-example-basic-multiple'],
                'query_builder' => function(CategorieRepository $er)
                {
                    return $er->createQueryBuilder('c')->orderBy('c.nom' , 'DESC');
                } ,
                'choice_label' => 'nom',
                'multiple' => true,])
            ->add('schemas', EntityType::class, [
                'label' => 'Schéma :',
                'class' => Schema::class ,
                'attr' => ['class' => 'js-example-basic-multiple'],
                'query_builder' => function(SchemaRepository $er)
                {

                    return $er->createQueryBuilder('a')->orderBy('a.nom' , 'DESC');
                } ,
                'choice_label' => 'nom',
                'multiple' => true,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Support::class,
        ]);
    }
}
