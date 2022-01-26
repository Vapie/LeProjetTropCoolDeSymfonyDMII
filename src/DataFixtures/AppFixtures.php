<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $manager->persist(Ingredient::creation("gravier","le","berzingue"));
        $manager->persist(Ingredient::creation("tomate","la","unité"));
        $manager->persist(Ingredient::creation("oeuf","le","unité"));
        $manager->persist(Ingredient::creation("lait","du","litre"));
        $manager->persist(Ingredient::creation("poivre","du","pincée"));
        $manager->persist(Ingredient::creation("sel","le","pincée"));
        $manager->persist(Ingredient::creation("maximator 11,6%","la","canette"));
        $manager->persist(Ingredient::creation("farine","la","grammes"));
        $manager->persist(Ingredient::creation("bonnet","le","unité"));

        $manager->flush();
    }
}
