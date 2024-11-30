<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idIntervention = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateInter = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $duree = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\Column]
    private ?float $prix = null;

// Ajoutez la relation ManyToMany avec Materiel
    #[ORM\ManyToMany(targetEntity: Materiel::class, inversedBy: "interventions")]
    #[ORM\JoinTable(name: "intervention_materiel")]
    private Collection $materiels;

    // Ajoutez la relation ManyToOne avec Technicien
    #[ORM\ManyToOne(targetEntity: Technicien::class, inversedBy: "interventions")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Technicien $technicien = null;

// Getter et Setter
    public function getTechnicien(): ?Technicien
    {
        return $this->technicien;
    }

    public function setTechnicien(Technicien $technicien): self
    {
        $this->technicien = $technicien;
        return $this;
    }


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

// Ajouter un matériel
    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels->add($materiel);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        $this->materiels->removeElement($materiel);
        return $this;
    }




    public function getIdIntervention(): ?int
    {
        return $this->idIntervention;
    }

    public function setIdIntervention(int $idIntervention): static
    {
        $this->idIntervention = $idIntervention;

        return $this;
    }

    public function getDateInter(): ?\DateTimeInterface
    {
        return $this->dateInter;
    }

    public function setDateInter(\DateTimeInterface $dateInter): static
    {
        $this->dateInter = $dateInter;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }
}
