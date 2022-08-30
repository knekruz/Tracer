<?php

namespace App\Controller;

use App\Entity\Recherche;
use App\Entity\Support;
use App\Entity\SupportTaux;
use App\Form\RechercheType;
use App\Form\SupportType;
use App\Form\SupportTauxEditType;
use App\Form\SupportTauxType;
use App\Form\SupportEditType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class SupportTauxController extends AbstractController
{
    #[Route('/supporttaux', name: 'app_support_taux_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $supportTaux = $entityManager
            ->getRepository(SupportTaux::class)
            ->findAllOrderByDateFin();

        return $this->render('support_taux/index.html.twig', [
            'supportTaux' => $supportTaux,
        ]);
    }

    #[Route('/supporttaux/new', name: 'app_support_taux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $supportTaux = new SupportTaux();
        $form = $this->createForm(SupportTauxType::class, $supportTaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($supportTaux);
            $entityManager->flush();

            return $this->redirectToRoute('app_support_taux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('support_taux/new.html.twig', [

            'supportTaux' => $supportTaux,
            'form' => $form,
        ]);
    }

    #[Route('/supporttaux/{id}/edit', name: 'app_support_taux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SupportTaux $supportTaux, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SupportTauxEditType::class, $supportTaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_support_taux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('support_taux/edit.html.twig', [
            'supporttaux' => $supportTaux,
            'form' => $form,
        ]);
    }

    #[Route('/supporttaux/delete/{id}', name: 'app_support_taux_delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $entityManager, SupportTaux $supportTaux) : Response
    {
        if(!$supportTaux){
            $this->addFlash(
                'Alerte',
                'La ligne n\'a pas été trouvé!'
            );
            return $this->redirectToRoute('app_support_taux_index');
        }    
        $entityManager->remove($supportTaux);
        $entityManager->flush();

        $this->addFlash(
            'Alerte',
            'La ligne a été supprimé avec succès!'
        );
        
        return $this->redirectToRoute('app_support_taux_index');
    }
}
