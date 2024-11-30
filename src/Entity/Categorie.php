<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idCategorie = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    // Ajoutez la propriété pour la relation OneToMany avec Materiel
    #[ORM\OneToMany(mappedBy: "categorie", targetEntity: Materiel::class)]
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
            $materiel->setCategorie($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            if ($materiel->getCategorie() === $this) {
                $materiel->setCategorie(null);
            }
        }

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(int $idCategorie): static
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }
}
