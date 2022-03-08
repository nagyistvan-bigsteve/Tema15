<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MarfaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarfaRepository::class)]
#[ApiResource]
class Marfa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nume;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $descriere;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dataExpirari;

    #[ORM\Column(type: 'boolean')]
    private $fragil;

    #[ORM\Column(type: 'float')]
    private $greutate;

    #[ORM\Column(type: 'float')]
    private $volum;

    #[ORM\ManyToOne(targetEntity: Depozit::class, inversedBy: 'marfa')]
    #[ORM\JoinColumn(nullable: false)]
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

    public function getDescriere(): ?string
    {
        return $this->descriere;
    }

    public function setDescriere(?string $descriere): self
    {
        $this->descriere = $descriere;

        return $this;
    }

    public function getDataExpirari(): ?\DateTimeInterface
    {
        return $this->dataExpirari;
    }

    public function setDataExpirari(?\DateTimeInterface $dataExpirari): self
    {
        $this->dataExpirari = $dataExpirari;

        return $this;
    }

    public function getFragil(): ?bool
    {
        return $this->fragil;
    }

    public function setFragil(bool $fragil): self
    {
        $this->fragil = $fragil;

        return $this;
    }

    public function getGreutate(): ?float
    {
        return $this->greutate;
    }

    public function setGreutate(float $greutate): self
    {
        $this->greutate = $greutate;

        return $this;
    }

    public function getVolum(): ?float
    {
        return $this->volum;
    }

    public function setVolum(float $volum): self
    {
        $this->volum = $volum;

        return $this;
    }

    public function getDepozit(): ?Depozit
    {
        return $this->depozit;
    }

    public function setDepozit(?Depozit $depozit): self
    {
        $this->depozit = $depozit;

        return $this;
    }
}
