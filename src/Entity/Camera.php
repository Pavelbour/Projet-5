<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CameraRepository")
 */
class Camera
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
    private $Manufacturer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CameraName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Sensor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Monture;

    /**
     * @ORM\Column(type="integer")
     */
    private $Length;

    /**
     * @ORM\Column(type="integer")
     */
    private $width;

    /**
     * @ORM\Column(type="integer")
     */
    private $height;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $images;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $time;

    public function getId()
    {
        return $this->id;
    }

    public function getManufacturer(): ?string
    {
        return $this->Manufacturer;
    }

    public function setManufacturer(string $Manufacturer): self
    {
        $this->Manufacturer = $Manufacturer;

        return $this;
    }

    public function getCameraName(): ?string
    {
        return $this->CameraName;
    }

    public function setCameraName(string $CameraName): self
    {
        $this->CameraName = $CameraName;

        return $this;
    }

    public function getSensor(): ?string
    {
        return $this->Sensor;
    }

    public function setSensor(string $Sensor): self
    {
        $this->Sensor = $Sensor;

        return $this;
    }

    public function getMonture(): ?string
    {
        return $this->Monture;
    }

    public function setMonture(string $Monture): self
    {
        $this->Monture = $Monture;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->Length;
    }

    public function setLength(int $Length): self
    {
        $this->Length = $Length;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

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

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(string $images): self
    {
        $this->images = $images;

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

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }
}
