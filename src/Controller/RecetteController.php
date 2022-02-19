<?php

namespace App\Controller;

use App\Entity\Action;
use App\Entity\Etape;
use App\Entity\Ingredient;

use App\Entity\Recette;
use App\Entity\TitreTemplate;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
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

    #[Route('/unfav/{id}', name: 'recetteunfav')]
    public function unfavr(EntityManagerInterface $entityManager,int $id): Response
    {

        /** @var Recette $recette */
        $recette = $entityManager->getRepository(Recette::class)->find($id);
        /** @var User $user */
        $user = $this->getUser();
        if ($user != null){
            $user->removeFavori($recette);
            $entityManager->persist($user);
            $entityManager->flush();
        }
        return $this->render('recette/detail.html.twig', [
            'controller_name' => 'RecetteController',
            'recette'=>$recette
        ]);
    }

    #[Route('/fav/{id}', name: 'recettefav')]
    public function favr(EntityManagerInterface $entityManager,int $id): Response
    {
        /** @var Recette $recette */
        $recette = $entityManager->getRepository(Recette::class)->find($id);
        // dd($recette);
        /** @var User $user */
        $user = $this->getUser();
        if ($user != null){
            $user->addFavori($recette);
            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('recette/detail.html.twig', [
            'controller_name' => 'RecetteController',
            'recette' => $recette
        ]);
    }

    #[Route('/favoris', name: 'recette')]
    public function fav(EntityManagerInterface $entityManager): Response
    {

        /** @var User $user */
        $user = $this->getUser();
        if ($user != null){
            return $this->render('recette/favoris.html.twig', [
                'controller_name' => 'RecetteController',
                'recettes'=>$user->getFavoris()
            ]);
        }
        return $this->render('recette/favoris.html.twig', [
            'controller_name' => 'RecetteController'
        ]);
        // dd($recette);

    }

    #[Route('/rand', name: 'generate_recette')]
    public function generate(EntityManagerInterface $entityManager ): Response
    {
        $recette =  Recette::createRandRecette($entityManager);

        return $this->render('recette/detail.html.twig', [
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
