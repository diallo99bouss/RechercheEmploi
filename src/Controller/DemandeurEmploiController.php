<?php

namespace App\Controller;

use App\Entity\DemandeurEmploi;
use App\Form\DemandeurEmploiType;
use App\Repository\DemandeurEmploiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demandeur_emploi_index")
 */
class DemandeurEmploiController extends AbstractController
{
    /**
     * @Route("/", name="demandeur_emploi_index", methods={"GET"})
     */
    public function index(DemandeurEmploiRepository $demandeurEmploiRepository): Response
    {
        return $this->render('demandeur_emploi/index.html.twig', [
            'demandeur_emplois' => $demandeurEmploiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="demandeur_emploi_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $demandeurEmploi = new DemandeurEmploi();
        $form = $this->createForm(DemandeurEmploiType::class, $demandeurEmploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($demandeurEmploi);
            $entityManager->flush();

            return $this->redirectToRoute('demandeur_emploi_index');
        }

        return $this->render('demandeur_emploi/new.html.twig', [
            'demandeur_emploi' => $demandeurEmploi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demandeur_emploi_show", methods={"GET"})
     */
    public function show(DemandeurEmploi $demandeurEmploi): Response
    {
        return $this->render('demandeur_emploi/show.html.twig', [
            'demandeur_emploi' => $demandeurEmploi,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="demandeur_emploi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DemandeurEmploi $demandeurEmploi): Response
    {
        $form = $this->createForm(DemandeurEmploiType::class, $demandeurEmploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demandeur_emploi_index');
        }

        return $this->render('demandeur_emploi/edit.html.twig', [
            'demandeur_emploi' => $demandeurEmploi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demandeur_emploi_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DemandeurEmploi $demandeurEmploi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeurEmploi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($demandeurEmploi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demandeur_emploi_index');
    }
}
