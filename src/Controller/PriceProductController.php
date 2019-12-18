<?php

namespace App\Controller;

use App\Entity\PriceProduct;
use App\Form\PriceProductType;
use App\Repository\PriceProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/price/product")
 */
class PriceProductController extends AbstractController
{
    /**
     * @Route("/", name="price_product_index", methods={"GET"})
     */
    public function index(PriceProductRepository $priceProductRepository): Response
    {
        return $this->render('price_product/index.html.twig', [
            'price_products' => $priceProductRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="price_product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $priceProduct = new PriceProduct();
        $form = $this->createForm(PriceProductType::class, $priceProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($priceProduct);
            $entityManager->flush();

            return $this->redirectToRoute('price_product_index');
        }

        return $this->render('price_product/new.html.twig', [
            'price_product' => $priceProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="price_product_show", methods={"GET"})
     */
    public function show(PriceProduct $priceProduct): Response
    {
        return $this->render('price_product/show.html.twig', [
            'price_product' => $priceProduct,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="price_product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PriceProduct $priceProduct): Response
    {
        $form = $this->createForm(PriceProductType::class, $priceProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('price_product_index');
        }

        return $this->render('price_product/edit.html.twig', [
            'price_product' => $priceProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="price_product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PriceProduct $priceProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$priceProduct->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($priceProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('price_product_index');
    }
}
