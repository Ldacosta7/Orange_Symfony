<?php

namespace App\Entity;


use App\Repository\TechnicienRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TechnicienRepository::class)]
class Technicien extends User
{

    #[ORM\Column(length: 255)]
    private ?string $specialite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datEntree = null;

    #[ORM\Column(length: 255)]
    private ?string $poste = null;

// Ajoutez la relation OneToMany avec Intervention
    #[ORM\OneToMany(mappedBy: "technicien", targetEntity: Intervention::class)]
    private Collection $interventions;

// Constructeur
    public function __construct()
    {
        $this->interventions = new ArrayCollection();
    }

// Getter
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

// Ajouter une intervention (si nécessaire)
    public function addIntervention(Intervention $intervention): self
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions->add($intervention);
            $intervention->setTechnicien($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): self
    {
        if ($this->interventions->removeElement($intervention)) {
            if ($intervention->getTechnicien() === $this) {
                $intervention->setTechnicien(null);
            }
        }

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): static
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getDatEntree(): ?\DateTimeInterface
    {
        return $this->datEntree;
    }

    public function setDatEntree(\DateTimeInterface $datEntree): static
    {
        $this->datEntree = $datEntree;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): static
    {
        $this->poste = $poste;

        return $this;
    }
}
