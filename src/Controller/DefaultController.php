<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Type;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(TypeRepository $typeRepository)
    {
        return $this->render('default/index.html.twig', [
            'types' => $typeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/shop/{slug}/", name="type_category", methods={"GET"})
     */
    public function typeCategories(Type $type)
    {
        $categories = $type->getCategories();
        
        return $this->render('default/type.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/shop/{type_slug}/{slug}/", name="category_product", methods={"GET"})
     */
    public function categoryProducts(Type $type, Category $category)
    {
        $categories = $type->getCategories();
        $products = $category->getProducts();

        return $this->render('default/category.html.twig', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
