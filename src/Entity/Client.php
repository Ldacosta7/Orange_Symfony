<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends User
{


    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $fidelite = null;

// Ajoutez la propriété pour la relation OneToMany avec Materiel
    #[ORM\OneToMany(mappedBy: "client", targetEntity: Materiel::class)]
    private Collection $materiels;

// Constructeur
    public function __construct()
    {
        $this->materiels = new ArrayCollection();
    }

// Getter
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

// Ajoutez un getter pour un matériel spécifique (optionnel)
    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels->add($materiel);
            $materiel->setClient($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            if ($materiel->getClient() === $this) {
                $materiel->setClient(null);
            }
        }

        return $this;
    }




    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getFidelite(): ?string
    {
        return $this->fidelite;
    }

    public function setFidelite(string $fidelite): static
    {
        $this->fidelite = $fidelite;

        return $this;
    }
}
