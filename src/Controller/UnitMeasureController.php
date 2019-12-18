<?php

namespace App\Controller;

use App\Entity\UnitMeasure;
use App\Form\UnitMeasureType;
use App\Repository\UnitMeasureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/unit/measure")
 */
class UnitMeasureController extends AbstractController
{
    /**
     * @Route("/", name="unit_measure_index", methods={"GET"})
     */
    public function index(UnitMeasureRepository $unitMeasureRepository): Response
    {
        return $this->render('unit_measure/index.html.twig', [
            'unit_measures' => $unitMeasureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="unit_measure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $unitMeasure = new UnitMeasure();
        $form = $this->createForm(UnitMeasureType::class, $unitMeasure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($unitMeasure);
            $entityManager->flush();

            return $this->redirectToRoute('unit_measure_index');
        }

        return $this->render('unit_measure/new.html.twig', [
            'unit_measure' => $unitMeasure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unit_measure_show", methods={"GET"})
     */
    public function show(UnitMeasure $unitMeasure): Response
    {
        return $this->render('unit_measure/show.html.twig', [
            'unit_measure' => $unitMeasure,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="unit_measure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UnitMeasure $unitMeasure): Response
    {
        $form = $this->createForm(UnitMeasureType::class, $unitMeasure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('unit_measure_index');
        }

        return $this->render('unit_measure/edit.html.twig', [
            'unit_measure' => $unitMeasure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unit_measure_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UnitMeasure $unitMeasure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unitMeasure->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($unitMeasure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('unit_measure_index');
    }
}
