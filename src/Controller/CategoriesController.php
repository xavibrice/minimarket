<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/category/{name}", name="categories")
     */
    public function index($name)
    {
        $em = $this->getDoctrine()->getManager();

        $a = str_replace("-", " ", $name);
        $b = ucwords($a);

        $category = $em->getRepository(Category::class)->findOneBy(['name' => $b]);
        $products = $em->getRepository(Product::class)->findBy(['category' => $category]);

        return $this->render('categories/index.html.twig', [
            'products' => $products
        ]);
    }

}
