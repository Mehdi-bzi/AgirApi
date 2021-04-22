<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * 
 * @ORM\Entity(repositoryClass=ThemeRepository::class)
 */
class Theme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"formation:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"formation:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     * 
     * 
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Formation::class, mappedBy="theme", orphanRemoval=true)
     */
    private $formation;

    public function __construct()
    {
        $this->formation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formation->contains($formation)) {
            $this->formation[] = $formation;
            $formation->setTheme($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formation->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getTheme() === $this) {
                $formation->setTheme(null);
            }
        }

        return $this;
    }
}
