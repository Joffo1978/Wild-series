<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'seasons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Program $program = null;

    #[ORM\OneToMany(mappedBy: 'season', targetEntity: Episode::class)]
    private Collection $episodes;

       public function __construct()
    {
        $this->episode = new ArrayCollection();
        $this->episodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }



    /**
     * @return Collection<int, Season>
     */
    public function getEpisode(): Collection
    {
        return $this->episode;
    }

    public function addEpisode(Season $episode): self
    {
        if (!$this->episode->contains($episode)) {
            $this->episode->add($episode);
            $episode->setEpisode($this);
        }

        return $this;
    }

    public function removeEpisode(Season $episode): self
    {
        if ($this->episode->removeElement($episode)) {
            // set the owning side to null (unless already changed)
            if ($episode->getEpisode() === $this) {
                $episode->setEpisode(null);
            }
        }

        return $this;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): self
    {
        $this->program = $program;

        return $this;
    }

    /**
     * @return Collection<int, Episode>
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }
}
