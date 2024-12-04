<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends User
{


    #[ORM\Column(length: 255)]
    private ?string $grade = null;

    #[ORM\Column(length: 255)]
    private ?string $fidelite = null;


    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setType(string $grade): static
    {
        $this->grade = $grade;

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
