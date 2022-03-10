<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DepozitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/*Depozit - read: name, dataIntrare, dataIesire, marfa, angajat
Depozit - write exclus: dataIesire*/

#[ORM\Entity(repositoryClass: DepozitRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
    itemOperations: [
        'put'
    ],
    collectionOperations: [
        'get',
        'post'
    ]
)]
class Depozit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(["read", "write"])]
    #[ORM\Column(type: 'string', length: 255)]
    private $nume;

    #[Groups("write")]
    #[ORM\Column(type: 'string', length: 255)]
    private $locatie;

    #[Groups(["read", "write"])]
    #[ORM\Column(type: 'date')]
    private $dataIntrare;

    #[Groups("read")]
    #[ORM\Column(type: 'date', nullable: true)]
    private $dataIesire;

    #[Groups(["read", "write"])]
    #[ORM\OneToMany(mappedBy: 'depozit', targetEntity: marfa::class, orphanRemoval: true)]
    private $marfa;

    #[Groups(["read", "write"])]
    #[ORM\OneToOne(inversedBy: 'depozit', targetEntity: angajat::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $angajat;

    public function __construct()
    {
        $this->marfa = new ArrayCollection();
    }

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

    public function getLocatie(): ?string
    {
        return $this->locatie;
    }

    public function setLocatie(string $locatie): self
    {
        $this->locatie = $locatie;

        return $this;
    }

    public function getDataIntrare(): ?\DateTimeInterface
    {
        return $this->dataIntrare;
    }

    public function setDataIntrare(\DateTimeInterface $dataIntrare): self
    {
        $this->dataIntrare = $dataIntrare;

        return $this;
    }

    public function getDataIesire(): ?\DateTimeInterface
    {
        return $this->dataIesire;
    }

    public function setDataIesire(?\DateTimeInterface $dataIesire): self
    {
        $this->dataIesire = $dataIesire;

        return $this;
    }

    /**
     * @return Collection<int, marfa>
     */
    public function getMarfa(): Collection
    {
        return $this->marfa;
    }

    public function addMarfa(marfa $marfa): self
    {
        if (!$this->marfa->contains($marfa)) {
            $this->marfa[] = $marfa;
            $marfa->setDepozit($this);
        }

        return $this;
    }

    public function removeMarfa(marfa $marfa): self
    {
        if ($this->marfa->removeElement($marfa)) {
            // set the owning side to null (unless already changed)
            if ($marfa->getDepozit() === $this) {
                $marfa->setDepozit(null);
            }
        }

        return $this;
    }

    public function getAngajat(): ?angajat
    {
        return $this->angajat;
    }

    public function setAngajat(angajat $angajat): self
    {
        $this->angajat = $angajat;

        return $this;
    }
}
