<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LensManufacturerRepository")
 */
class LensManufacturer
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
     * @ORM\OneToMany(targetEntity="App\Entity\Lens", mappedBy="manufacturer", orphanRemoval=true)
     */
    private $lens;

    public function __construct()
    {
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
            $len->setManufacturer($this);
        }

        return $this;
    }

    public function removeLen(Lens $len): self
    {
        if ($this->lens->contains($len)) {
            $this->lens->removeElement($len);
            // set the owning side to null (unless already changed)
            if ($len->getManufacturer() === $this) {
                $len->setManufacturer(null);
            }
        }

        return $this;
    }
}
