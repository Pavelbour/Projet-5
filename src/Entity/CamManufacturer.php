<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CamManufacturerRepository")
 */
class CamManufacturer
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
    private $manufacturer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Camera", mappedBy="manufacturer", orphanRemoval=true)
     */
    private $cameras;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Monture", mappedBy="manufacturer", orphanRemoval=true)
     */
    private $montures;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Lens", mappedBy="forManufacturer")
     */
    private $lens;

    public function __construct()
    {
        $this->cameras = new ArrayCollection();
        $this->montures = new ArrayCollection();
        $this->lens = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

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
            $camera->setManufacturer($this);
        }

        return $this;
    }

    public function removeCamera(Camera $camera): self
    {
        if ($this->cameras->contains($camera)) {
            $this->cameras->removeElement($camera);
            // set the owning side to null (unless already changed)
            if ($camera->getManufacturer() === $this) {
                $camera->setManufacturer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Monture[]
     */
    public function getMontures(): Collection
    {
        return $this->montures;
    }

    public function addMonture(Monture $monture): self
    {
        if (!$this->montures->contains($monture)) {
            $this->montures[] = $monture;
            $monture->setManufacturer($this);
        }

        return $this;
    }

    public function removeMonture(Monture $monture): self
    {
        if ($this->montures->contains($monture)) {
            $this->montures->removeElement($monture);
            // set the owning side to null (unless already changed)
            if ($monture->getManufacturer() === $this) {
                $monture->setManufacturer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lens[]
     */
    public function getLens(): Collection
    {
        return $this->lens;
    }

    public function addLen(Lens $len): self
    {
        if (!$this->lens->contains($len)) {
            $this->lens[] = $len;
            $len->addForManufacturer($this);
        }

        return $this;
    }

    public function removeLen(Lens $len): self
    {
        if ($this->lens->contains($len)) {
            $this->lens->removeElement($len);
            $len->removeForManufacturer($this);
        }

        return $this;
    }
}
