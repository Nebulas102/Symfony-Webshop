<?php

namespace App\Controller;

use App\Entity\AvailabilityProduct;
use App\Form\AvailabilityProductType;
use App\Repository\AvailabilityProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/availability/product")
 */
class AvailabilityProductController extends AbstractController
{
    /**
     * @Route("/", name="availability_product_index", methods={"GET"})
     */
    public function index(AvailabilityProductRepository $availabilityProductRepository): Response
    {
        return $this->render('availability_product/index.html.twig', [
            'availability_products' => $availabilityProductRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="availability_product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $availabilityProduct = new AvailabilityProduct();
        $form = $this->createForm(AvailabilityProductType::class, $availabilityProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($availabilityProduct);
            $entityManager->flush();

            return $this->redirectToRoute('availability_product_index');
        }

        return $this->render('availability_product/new.html.twig', [
            'availability_product' => $availabilityProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="availability_product_show", methods={"GET"})
     */
    public function show(AvailabilityProduct $availabilityProduct): Response
    {
        return $this->render('availability_product/show.html.twig', [
            'availability_product' => $availabilityProduct,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="availability_product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AvailabilityProduct $availabilityProduct): Response
    {
        $form = $this->createForm(AvailabilityProductType::class, $availabilityProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('availability_product_index');
        }

        return $this->render('availability_product/edit.html.twig', [
            'availability_product' => $availabilityProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="availability_product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AvailabilityProduct $availabilityProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$availabilityProduct->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($availabilityProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('availability_product_index');
    }
}
