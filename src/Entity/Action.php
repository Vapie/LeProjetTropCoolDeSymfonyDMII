<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActionRepository::class)]
#[ORM\Table(name: '`action`')]
class Action
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $label;

    #[ORM\ManyToMany(targetEntity: IngredientType::class, inversedBy: 'actions')]
    private $allowed_types;

    public function __construct()
    {
        $this->allowed_types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|IngredientType[]
     */
    public function getAllowedTypes(): Collection
    {
        return $this->allowed_types;
    }

    public function addAllowedType(IngredientType $allowedType): self
    {
        if (!$this->allowed_types->contains($allowedType)) {
            $this->allowed_types[] = $allowedType;
        }

        return $this;
    }

    public function removeAllowedType(IngredientType $allowedType): self
    {
        $this->allowed_types->removeElement($allowedType);

        return $this;
    }
}
