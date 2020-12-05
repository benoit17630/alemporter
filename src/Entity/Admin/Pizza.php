<?php

namespace App\Entity\Admin;

use App\Repository\Admin\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PizzaRepository::class)
 * @UniqueEntity("name")
 */
class Pizza
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = "4",
     *      max = 50,
     *      minMessage = "au mini un mot de {{ limit }} ",
     *      maxMessage = "ne peut pas depasser {{ limit }} lettres"
     * )
     * @Assert\NotBlank(message="le formulaire est vide")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity=Meat::class, inversedBy="pizzas")
     */
    private $meat;

    /**
     * @ORM\ManyToMany(targetEntity=Fish::class, inversedBy="pizzas")
     */
    private $fish;

    /**
     * @ORM\ManyToMany(targetEntity=Legume::class, inversedBy="pizzas")
     */
    private $legume;

    /**
     * @ORM\ManyToMany(targetEntity=Cheese::class, inversedBy="pizzas")
     */
    private $cheese;

    /**
     * @ORM\ManyToMany(targetEntity=Other::class, inversedBy="pizzas")
     */
    private $other;

    /**
     * @ORM\ManyToOne(targetEntity=BasePizza::class, inversedBy="pizzas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $basepizza;

    /**
     * @ORM\ManyToOne(targetEntity=BaseIngredient::class, inversedBy="pizzas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $baseIngredient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->meat = new ArrayCollection();
        $this->fish = new ArrayCollection();
        $this->legume = new ArrayCollection();
        $this->cheese = new ArrayCollection();
        $this->other = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Meat[]
     */
    public function getMeat(): Collection
    {
        return $this->meat;
    }

    public function addMeat(Meat $meat): self
    {
        if (!$this->meat->contains($meat)) {
            $this->meat[] = $meat;
        }

        return $this;
    }

    public function removeMeat(Meat $meat): self
    {
        $this->meat->removeElement($meat);

        return $this;
    }

    /**
     * @return Collection|Fish[]
     */
    public function getFish(): Collection
    {
        return $this->fish;
    }

    public function addFish(Fish $fish): self
    {
        if (!$this->fish->contains($fish)) {
            $this->fish[] = $fish;
        }

        return $this;
    }

    public function removeFish(Fish $fish): self
    {
        $this->fish->removeElement($fish);

        return $this;
    }

    /**
     * @return Collection|Legume[]
     */
    public function getLegume(): Collection
    {
        return $this->legume;
    }

    public function addLegume(Legume $legume): self
    {
        if (!$this->legume->contains($legume)) {
            $this->legume[] = $legume;
        }

        return $this;
    }

    public function removeLegume(Legume $legume): self
    {
        $this->legume->removeElement($legume);

        return $this;
    }

    /**
     * @return Collection|Cheese[]
     */
    public function getCheese(): Collection
    {
        return $this->cheese;
    }

    public function addCheese(Cheese $cheese): self
    {
        if (!$this->cheese->contains($cheese)) {
            $this->cheese[] = $cheese;
        }

        return $this;
    }

    public function removeCheese(Cheese $cheese): self
    {
        $this->cheese->removeElement($cheese);

        return $this;
    }

    /**
     * @return Collection|Other[]
     */
    public function getOther(): Collection
    {
        return $this->other;
    }

    public function addOther(Other $other): self
    {
        if (!$this->other->contains($other)) {
            $this->other[] = $other;
        }

        return $this;
    }

    public function removeOther(Other $other): self
    {
        $this->other->removeElement($other);

        return $this;
    }

    public function getBasepizza(): ?BasePizza
    {
        return $this->basepizza;
    }

    public function setBasepizza(?BasePizza $basepizza): self
    {
        $this->basepizza = $basepizza;

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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
