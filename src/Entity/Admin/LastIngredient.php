<?php

namespace App\Entity\Admin;

use App\Repository\Admin\LastIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LastIngredientRepository::class)
 */
class LastIngredient
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
     * @ORM\OneToMany(targetEntity=Pizza::class, mappedBy="lastIngredient")
     */
    private $pizzas;

    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
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
     * @return Collection|Pizza[]
     */
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }

    public function addPizza(Pizza $pizza): self
    {
        if (!$this->pizzas->contains($pizza)) {
            $this->pizzas[] = $pizza;
            $pizza->setLastIngredient($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        if ($this->pizzas->removeElement($pizza)) {
            // set the owning side to null (unless already changed)
            if ($pizza->getLastIngredient() === $this) {
                $pizza->setLastIngredient(null);
            }
        }

        return $this;
    }




}
