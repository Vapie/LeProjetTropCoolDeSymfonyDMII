<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;


    #[ORM\ManyToMany(targetEntity: Etape::class, mappedBy: 'ingredients')]
    private $etapes;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $article;

    #[ORM\Column(type: 'string', length: 255)]
    private $mesure;

    #[ORM\ManyToMany(targetEntity: Action::class, inversedBy: 'ingredients')]
    private $allowed_actions;

    public function __construct()
    {
        $this->etapes = new ArrayCollection();
        $this->allowed_actions = new ArrayCollection();
    }
    public static function creation(string $nom,string $article,string $mesure ,):Ingredient
    {
        $ingredient = new self();
        $ingredient
            ->setNom($nom)
            ->setArticle($article)
            ->setMesure($mesure);
        return $ingredient;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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
            $etape->addIngredient($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): self
    {
        if ($this->etapes->removeElement($etape)) {
            $etape->removeIngredient($this);
        }

        return $this;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(?string $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getMesure(): ?string
    {
        return $this->mesure;
    }

    public function setMesure(string $mesure): self
    {
        $this->mesure = $mesure;

        return $this;
    }

    /**
     * @return Collection|Action[]
     */
    public function getAllowedActions(): Collection
    {
        return $this->allowed_actions;
    }

    public function addAllowedAction(Action $allowedAction): self
    {
        if (!$this->allowed_actions->contains($allowedAction)) {
            $this->allowed_actions[] = $allowedAction;
        }

        return $this;
    }

    public function removeAllowedAction(Action $allowedAction): self
    {
        $this->allowed_actions->removeElement($allowedAction);

        return $this;
    }
}
