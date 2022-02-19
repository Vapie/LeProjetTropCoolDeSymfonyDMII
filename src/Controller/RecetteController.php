<?php

namespace App\Controller;

use App\Entity\Action;
use App\Entity\Etape;
use App\Entity\Ingredient;

use App\Entity\Recette;
use App\Entity\TitreTemplate;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class RecetteController extends AbstractController
{
    #[Route('/', name: 'recettes')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
            'recettes'=> $entityManager->getRepository(Recette::class)->findAll()
        ]);
    }
    #[Route('/recette/{id}', name: 'recette')]
    public function getrecette(EntityManagerInterface $entityManager,int $id): Response
    {
        $recette = $entityManager->getRepository(Recette::class)->find($id);
       // dd($recette);
        return $this->render('recette/detail.html.twig', [
            'controller_name' => 'RecetteController',
            'recette'=>$recette
        ]);
    }

    #[Route('/rand', name: 'generate_recette')]
    public function generate(EntityManagerInterface $entityManager ): Response
    {
        $ingredients = $entityManager->getRepository(Ingredient::class)->findAll();
        $rand = rand(3,5);
        $selected_ingredients_index = array_rand($ingredients,$rand);
        $selected_ingredients = [];
        $templates_title = $entityManager->getRepository(TitreTemplate::class)->findAll();
        /** @var TitreTemplate $titre */
        $titre = $templates_title[rand(0,count($templates_title)-1)];
        for ($i = 0; $i < $rand ;$i++) {
            array_push($selected_ingredients, $ingredients[$selected_ingredients_index[$i]]);
        }
        //        etapes
        $rand_etapes  = rand(3,5);

        $recette = new Recette();
        $recette->setTitre($titre->getCompletedString($selected_ingredients));
        for ($i = 0; $i < $rand_etapes ;$i++) {
            /** @var Ingredient $rand_ingred */
            $rand_ingred  = $selected_ingredients[rand(0,$rand-1)];
            $actions = $rand_ingred->getAllowedActions();
            /** @var Action $selected_action */
            $selected_action = $actions[rand(0,count($actions)-1)];
            $current_etape = new Etape();
            $current_etape->addIngredient($rand_ingred)->setEtapeAction($selected_action)->setEtapeIndex($i)->setRecette($recette);
            $recette->addEtape($current_etape);


        }
        $entityManager->persist($recette);
        $entityManager->flush();


        return $this->render('recette/random.html.twig', [
            'controller_name' => 'RecetteController',
            "recette"=>$recette,

        ]);
    }

    /**
     * @Route("/email")
     */
    public function sendEmailForm(MailerInterface $mailer, Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('save', SubmitType::class, ['label' => 'Send Mail'])
            ->add('text', TextType::class, ['label' => 'texte'])
            ->getForm();
        $form->handleRequest($request);

        // creation du mail si le form est submité

        if($form->isSubmitted()){
            $data = $form->getData();
            $email = (new Email())
                ->from('vapie.valentin@gmail.com')
                ->to('nathan.charvin@gmail.com')
                ->subject('Time for Symfony Mailer!')
                ->text('Sending emails is fun again!')
                ->html('<p>'.$data['text'].'</p>');
            $mailer->send($email);
            return $this->redirectToRoute('recettes');
        }




        return  $this->render('recette/email.html.twig', [
            'controller_name' => 'RecetteController',
            'form' => $form->createView()
        ]);

    }


}
