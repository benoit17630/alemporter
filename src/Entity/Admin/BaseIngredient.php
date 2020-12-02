<?php

namespace App\Entity\Admin;

use App\Repository\Admin\BaseIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BaseIngredientRepository::class)
 */
class BaseIngredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=BasePizza::class, mappedBy="baseIngredient")
     */
    private $basePizzas;

    public function __construct()
    {
        $this->basePizzas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|BasePizza[]
     */
    public function getBasePizzas(): Collection
    {
        return $this->basePizzas;
    }

    public function addBasePizza(BasePizza $basePizza): self
    {
        if (!$this->basePizzas->contains($basePizza)) {
            $this->basePizzas[] = $basePizza;
            $basePizza->setBaseIngredient($this);
        }

        return $this;
    }

    public function removeBasePizza(BasePizza $basePizza): self
    {
        if ($this->basePizzas->removeElement($basePizza)) {
            // set the owning side to null (unless already changed)
            if ($basePizza->getBaseIngredient() === $this) {
                $basePizza->setBaseIngredient(null);
            }
        }

        return $this;
    }
}
