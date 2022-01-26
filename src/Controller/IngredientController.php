<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'ingredient')]
    public function index(EntityManagerInterface $entityManager ,Request $request): Response
    {
        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();
        $ingredient = new Ingredient();

        $form = $this->createForm(IngredientFormType::class, $ingredient);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            dd($form->getData());
        }
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',"ingredients"=>$ingredients,"form"=>$form->createView()
        ]);
    }
}
