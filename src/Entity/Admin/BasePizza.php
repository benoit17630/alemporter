<?php

namespace App\Entity\Admin;

use App\Repository\Admin\BasePizzaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BasePizzaRepository::class)
 */
class BasePizza
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
     * @ORM\ManyToOne(targetEntity=BaseIngredient::class, inversedBy="basePizzas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $baseIngredient;

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

    public function getBaseIngredient(): ?BaseIngredient
    {
        return $this->baseIngredient;
    }

    public function setBaseIngredient(?BaseIngredient $baseIngredient): self
    {
        $this->baseIngredient = $baseIngredient;

        return $this;
    }
}
