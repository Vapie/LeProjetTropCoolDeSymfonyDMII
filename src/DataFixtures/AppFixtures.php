<?php

namespace App\DataFixtures;

use App\Entity\Action;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\TitreTemplate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Actions
        $manager->persist(Action::creation("découpez !ingredients!"));
        $manager->persist(Action::creation("faites cuire !ingredients! à feu doux pendant !temps!"));
        $manager->persist(Action::creation("tournez sur vous même puis regardez fixement !ingredients!"));
        $manager->persist(Action::creation("lavez !ingredients! et levez les fillets"));
        $manager->persist(Action::creation("mettez !ingredients! dans une passoire"));
        $manager->persist(Action::creation("coupez !ingredients! en petits dés"));
        $manager->persist(Action::creation("vérifiez si !ingredients! est commestible"));
        $manager->persist(Action::creation("mettez !ingredients! dans une casserole puis allumez le feu"));
        $manager->persist(Action::creation("utilisez un cul de poule pour mélanger !ingredients! "));
        $manager->persist(Action::creation("mettez !ingredients! dans une casserole puis allumez le feu"));
        $manager->flush();

        //Ingredients
        $manager->persist(Ingredient::creation("gravier","le","berzingue", $this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("fromage","le","gramme", $this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("","le","berzingue", $this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("gravier","le","berzingue", $this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("larme de sardoche","la","litre",$this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("tomate","la","unité",$this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("oeuf","le","unité",$this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("lait","du","litre",$this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("poivre","du","pincée",$this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("sel","le","pincée",$this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("maximator 11,6%","la","canette",$this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("farine","la","grammes",$this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("bonnet","le","unité",$this->getRandomActionList($manager)));
        $manager->persist(Ingredient::creation("battlebus","le","unité",$this->getRandomActionList($manager)));
        $manager->flush();

        //Title Template

        $manager->persist(TitreTemplate::creation("!ingredient! très cher accompagné de !ingredient!"));
        $manager->persist(TitreTemplate::creation("!ingredient! sur son lit !ingredient!"));
        $manager->persist(TitreTemplate::creation("!ingredient! assaisoné avec !ingredient!"));
        $manager->persist(TitreTemplate::creation("!ingredient! revenue à la poêle avec un filet d'huile d'olive et un peu de  !ingredient!"));
        $manager->persist(TitreTemplate::creation("!ingredient! délicatement cuit avec sa sauce !ingredient!"));

        $manager->flush();
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
        Recette::createRandRecette($manager);
    }

    /**
     * @return Action[]
     */
    public function getRandomActionList($manager){
        $actions = $manager->getRepository(Action::class)->findAll();
        $rand = rand(2,6);
        $selected_actions_index = array_rand($actions,$rand);
        $selected_actions = [];
        for ($i = 0; $i < $rand ;$i++) {
            array_push($selected_actions,$actions[$selected_actions_index[$i]]);
        }
        return $selected_actions;
    }
}
