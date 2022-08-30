<?php

namespace App\Controller;

use App\Entity\Recherche;
use App\Entity\Support;
use App\Form\RechercheType;
use App\Form\SupportType;
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
class SupportController extends AbstractController
{
    #[Route('/', name: 'app_index', methods: ['GET'])]
    public function indexHome(EntityManagerInterface $entityManager): Response
    {
        return $this->render('partials/index.html.twig', [
        ]);
    }

    #[Route('/supportEncours', name: 'app_support_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $supports = $entityManager
            ->getRepository(Support::class)
            ->findAll();

        return $this->render('support/index.html.twig', [
            'supports' => $supports,
        ]);
    }

    #[Route('/supports', name: 'app_supports_index', methods: ['GET'])]
    public function indexAll(EntityManagerInterface $entityManager): Response
    {
        $supports = $entityManager
            ->getRepository(Support::class)
            ->findAll();

        return $this->render('support/index_all.html.twig', [
            'supports' => $supports,
        ]);
    }

    #[Route('/support/new', name: 'app_support_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $support = new Support();
        $form = $this->createForm(SupportType::class, $support);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($support);
            $entityManager->flush();

            return $this->redirectToRoute('app_support_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('support/new.html.twig', [
            'support' => $support,
            'form' => $form,
        ]);
    }

    #[Route('/support/{isin}/{showArchive}', name: 'app_support_show', defaults: ["showArchive" => false], methods: ['GET'])]
    public function show(Support $support, bool $showArchive): Response
    {
        return $this->render('support/show.html.twig', [
            'support' => $support,
            'showArchive' => $showArchive,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_support_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Support $support, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SupportEditType::class, $support);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_supports_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('support/edit.html.twig', [
            'support' => $support,
            'form' => $form,
        ]);
    }

    #[Route('/support/{id}', name: 'app_support_delete', methods: ['POST'])]
    public function delete(Request $request, Support $support, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$support->getId(), $request->request->get('_token'))) {
            $entityManager->remove($support);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_support_index', [], Response::HTTP_SEE_OTHER);
    }
}
