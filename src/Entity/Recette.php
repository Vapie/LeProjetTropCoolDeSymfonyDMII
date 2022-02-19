<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\ObjectManager;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Etape::class, orphanRemoval: true, cascade: ['persist'] )]
    private $etapes;

    public function __construct()
    {
        $this->etapes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection|Etape[]
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etape $etape): self
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes[] = $etape;
            $etape->setRecette($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): self
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getRecette() === $this) {
                $etape->setRecette(null);
            }
        }

        return $this;
    }

    public static function createRandRecette(ObjectManager $entityManager){
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
        return $recette;
    }
}
