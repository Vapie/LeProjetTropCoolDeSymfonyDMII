<?php

namespace App\Controller;

use App\Entity\Ingredient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    #[Route('/', name: 'recettes')]
    public function index(): Response
    {
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
        ]);
    }

    #[Route('/rand', name: 'generate_recette')]
    public function generate(EntityManagerInterface $entityManager ): Response
    {
        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();
        $rand = rand(2,4);
        $selected_ingredients_index = array_rand($ingredients,$rand);
        $selected_ingredients = [];
        for ($i = 0; $i < $rand ;$i++) {
            array_push($selected_ingredients,$ingredients[$selected_ingredients_index[$i]]);
        }
        return $this->render('recette/random.html.twig', [
            'controller_name' => 'RecetteController',"ingredients"=>$selected_ingredients
        ]);

    }
}
