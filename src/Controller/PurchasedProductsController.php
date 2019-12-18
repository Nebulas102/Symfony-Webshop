<?php

namespace App\Controller;

use App\Entity\PurchasedProducts;
use App\Form\PurchasedProductsType;
use App\Repository\PurchasedProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/purchased/products")
 */
class PurchasedProductsController extends AbstractController
{
    /**
     * @Route("/", name="purchased_products_index", methods={"GET"})
     */
    public function index(PurchasedProductsRepository $purchasedProductsRepository): Response
    {
        return $this->render('purchased_products/index.html.twig', [
            'purchased_products' => $purchasedProductsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="purchased_products_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $purchasedProduct = new PurchasedProducts();
        $form = $this->createForm(PurchasedProductsType::class, $purchasedProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($purchasedProduct);
            $entityManager->flush();

            return $this->redirectToRoute('purchased_products_index');
        }

        return $this->render('purchased_products/new.html.twig', [
            'purchased_product' => $purchasedProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="purchased_products_show", methods={"GET"})
     */
    public function show(PurchasedProducts $purchasedProduct): Response
    {
        return $this->render('purchased_products/show.html.twig', [
            'purchased_product' => $purchasedProduct,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="purchased_products_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PurchasedProducts $purchasedProduct): Response
    {
        $form = $this->createForm(PurchasedProductsType::class, $purchasedProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('purchased_products_index');
        }

        return $this->render('purchased_products/edit.html.twig', [
            'purchased_product' => $purchasedProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="purchased_products_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PurchasedProducts $purchasedProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$purchasedProduct->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($purchasedProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('purchased_products_index');
    }
}
