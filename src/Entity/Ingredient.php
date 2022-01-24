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

    #[ORM\ManyToMany(targetEntity: IngredientType::class, inversedBy: 'ingredients')]
    private $Types;

    public function __construct()
    {
        $this->Types = new ArrayCollection();
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
     * @return Collection|IngredientType[]
     */
    public function getTypes(): Collection
    {
        return $this->Types;
    }

    public function addType(IngredientType $type): self
    {
        if (!$this->Types->contains($type)) {
            $this->Types[] = $type;
        }

        return $this;
    }

    public function removeType(IngredientType $type): self
    {
        $this->Types->removeElement($type);

        return $this;
    }
}
