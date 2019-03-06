<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MetierRepository")
 */
class Metier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PortailB2B", inversedBy="metiers")
     * @ORM\JoinColumn(nullable=true)
     */
    private $portailB2B;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypePrestation", mappedBy="metier")
     */
    private $typesPrestations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="metiers")
     */
    private $partenaires;

    public function __construct()
    {
        $this->typesPrestations = new ArrayCollection();
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

    public function getPortailB2B(): ?PortailB2B
    {
        return $this->portailB2B;
    }

    public function setPortailB2B(?PortailB2B $portailB2B): self
    {
        $this->portailB2B = $portailB2B;

        return $this;
    }

    /**
     * @return Collection|TypePrestation[]
     */
    public function getTypesPrestations(): Collection
    {
        return $this->typesPrestations;
    }

    public function addTypesPrestation(TypePrestation $typesPrestation): self
    {
        if (!$this->typesPrestations->contains($typesPrestation)) {
            $this->typesPrestations[] = $typesPrestation;
            $typesPrestation->setMetier($this);
        }

        return $this;
    }

    public function removeTypesPrestation(TypePrestation $typesPrestation): self
    {
        if ($this->typesPrestations->contains($typesPrestation)) {
            $this->typesPrestations->removeElement($typesPrestation);
            // set the owning side to null (unless already changed)
            if ($typesPrestation->getMetier() === $this) {
                $typesPrestation->setMetier(null);
            }
        }

        return $this;
    }

    public function getPartenaires(): ?Partenaire
    {
        return $this->partenaires;
    }

    public function setPartenaires(?Partenaire $partenaires): self
    {
        $this->partenaires = $partenaires;

        return $this;
    }
}
