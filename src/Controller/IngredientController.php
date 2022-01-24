<?php

namespace App\Controller;

use App\Entity\Ingredient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'ingredient')]
    public function index(EntityManagerInterface $entityManager ): Response
    {
        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();

        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',"ingredients"=>$ingredients
        ]);
    }
}
