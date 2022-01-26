<?php

namespace App\Controller;

use App\Entity\Ingredient;

use Doctrine\ORM\EntityManagerInterface;

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
