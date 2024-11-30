<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterielRepository::class)]
class Materiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idMateriel = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $dateAchat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlImage = null;

    // Ajoutez la propriété pour la relation ManyToOne avec Categorie
    #[ORM\ManyToOne(targetEntity: Categorie::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    // Ajoutez la propriété pour la relation ManyToOne avec Client
    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    // Ajoutez la relation ManyToMany avec Intervention
    #[ORM\ManyToMany(targetEntity: Intervention::class, mappedBy: "materiels")]
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
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): self
    {
        $this->interventions->removeElement($intervention);
        return $this;
    }


// Getter et Setter
    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }


// Getter et Setter
    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(Categorie $categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMateriel(): ?int
    {
        return $this->idMateriel;
    }

    public function setIdMateriel(int $idMateriel): static
    {
        $this->idMateriel = $idMateriel;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateAchat(): ?string
    {
        return $this->dateAchat;
    }

    public function setDateAchat(string $dateAchat): static
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getUrlImage(): ?string
    {
        return $this->urlImage;
    }

    public function setUrlImage(?string $urlImage): static
    {
        $this->urlImage = $urlImage;

        return $this;
    }
}
