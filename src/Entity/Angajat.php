<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AngajatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AngajatRepository::class)]
#[ApiResource]
class Angajat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nume;

    #[ORM\OneToOne(mappedBy: 'angajat', targetEntity: Depozit::class, cascade: ['persist', 'remove'])]
    private $depozit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNume(): ?string
    {
        return $this->nume;
    }

    public function setNume(string $nume): self
    {
        $this->nume = $nume;

        return $this;
    }

    public function getDepozit(): ?Depozit
    {
        return $this->depozit;
    }

    public function setDepozit(Depozit $depozit): self
    {
        // set the owning side of the relation if necessary
        if ($depozit->getAngajat() !== $this) {
            $depozit->setAngajat($this);
        }

        $this->depozit = $depozit;

        return $this;
    }
}
