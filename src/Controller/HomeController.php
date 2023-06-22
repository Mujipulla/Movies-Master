<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        $categories = $this->em->getRepository(Category::class)->findAll();
        $categoryName = $request->query->get('category');
        
        if ( $categoryName )
        {
            $products = $this->em->getRepository(Product::class)->findByCatergoryName(['name' => $categoryName]);
              
        }else{
              
            $products = $this->em->getRepository(Product::class)->findAll();
        }
        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'products' => $products,
        ]);

    }
}
