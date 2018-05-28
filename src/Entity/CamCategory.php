<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CamCategoryRepository")
 */
class CamCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Camera", mappedBy="category", orphanRemoval=true)
     */
    private $cameras;

    public function __construct()
    {
        $this->cameras = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Camera[]
     */
    public function getCameras(): Collection
    {
        return $this->cameras;
    }

    public function addCamera(Camera $camera): self
    {
        if (!$this->cameras->contains($camera)) {
            $this->cameras[] = $camera;
            $camera->setCategory($this);
        }

        return $this;
    }

    public function removeCamera(Camera $camera): self
    {
        if ($this->cameras->contains($camera)) {
            $this->cameras->removeElement($camera);
            // set the owning side to null (unless already changed)
            if ($camera->getCategory() === $this) {
                $camera->setCategory(null);
            }
        }

        return $this;
    }
}
