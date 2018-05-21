<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LensRepository")
 */
class Lens
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $monture;

    /**
     * @ORM\Column(type="integer")
     */
    private $length;

    /**
     * @ORM\Column(type="integer")
     */
    private $diameter;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\Column(type="integer")
     */
    private $focal_length_min;

    /**
     * @ORM\Column(type="integer")
     */
    private $focal_length_max;

    /**
     * @ORM\Column(type="integer")
     */
    private $focuse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aperture;

    /**
     * @ORM\Column(type="integer")
     */
    private $diameter_of_filter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $for_manufacturer;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    public function setDiameter(int $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getFocalLengthMin(): ?int
    {
        return $this->focal_length_min;
    }

    public function setFocalLengthMin(int $focal_length_min): self
    {
        $this->focal_length_min = $focal_length_min;

        return $this;
    }

    public function getFocalLengthMax(): ?int
    {
        return $this->focal_length_max;
    }

    public function setFocalLengthMax(int $focal_length_max): self
    {
        $this->focal_length_max = $focal_length_max;

        return $this;
    }

    public function getFocuse(): ?int
    {
        return $this->focuse;
    }

    public function setFocuse(int $focuse): self
    {
        $this->focuse = $focuse;

        return $this;
    }

    public function getAperture(): ?string
    {
        return $this->aperture;
    }

    public function setAperture(string $aperture): self
    {
        $this->aperture = $aperture;

        return $this;
    }

    public function getDiameterOfFilter(): ?int
    {
        return $this->diameter_of_filter;
    }

    public function setDiameterOfFilter(int $diameter_of_filter): self
    {
        $this->diameter_of_filter = $diameter_of_filter;

        return $this;
    }

    public function getForManufacturer(): ?string
    {
        return $this->for_manufacturer;
    }

    public function setForManufacturer(string $for_manufacturer): self
    {
        $this->for_manufacturer = $for_manufacturer;

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
}
