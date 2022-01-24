<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapeRepository::class)]
class Etape
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $etape_index;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'etapes')]
    private $ingredients;

    #[ORM\ManyToOne(targetEntity: Action::class, inversedBy: 'etapes')]
    #[ORM\JoinColumn(nullable: false)]
    private $etape_action;

    #[ORM\ManyToOne(targetEntity: Recette::class, inversedBy: 'etapes')]
    #[ORM\JoinColumn(nullable: false)]
    private $recette;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtapeIndex(): ?int
    {
        return $this->etape_index;
    }

    public function setEtapeIndex(int $etape_index): self
    {
        $this->etape_index = $etape_index;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        $this->ingredients->removeElement($ingredient);

        return $this;
    }

    public function getEtapeAction(): ?Action
    {
        return $this->etape_action;
    }

    public function setEtapeAction(?Action $etape_action): self
    {
        $this->etape_action = $etape_action;

        return $this;
    }

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): self
    {
        $this->recette = $recette;

        return $this;
    }
}
