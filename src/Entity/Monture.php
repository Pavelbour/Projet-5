<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MontureRepository")
 */
class Monture
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
    private $monture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CamManufacturer", inversedBy="montures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manufacturer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Camera", mappedBy="monture")
     */
    private $cameras;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lens", mappedBy="monture", orphanRemoval=true)
     */
    private $lens;

    public function __construct()
    {
        $this->cameras = new ArrayCollection();
        $this->lens = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMonture(): ?string
    {
        return $this->monture;
    }

    public function setMonture(string $monture): self
    {
        $this->monture = $monture;

        return $this;
    }

    public function getManufacturer(): ?CamManufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?CamManufacturer $manufacturer): self
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
            $camera->addMonture($this);
        }

        return $this;
    }

    public function removeCamera(Camera $camera): self
    {
        if ($this->cameras->contains($camera)) {
            $this->cameras->removeElement($camera);
            $camera->removeMonture($this);
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
            $len->setMonture($this);
        }

        return $this;
    }

    public function removeLen(Lens $len): self
    {
        if ($this->lens->contains($len)) {
            $this->lens->removeElement($len);
            // set the owning side to null (unless already changed)
            if ($len->getMonture() === $this) {
                $len->setMonture(null);
            }
        }

        return $this;
    }
}
