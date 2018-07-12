<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    private $CameraName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sensor;

    /**
     * @ORM\Column(type="integer")
     */
    private $length;

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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CamCategory", inversedBy="cameras")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CamManufacturer", inversedBy="cameras")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manufacturer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Monture", inversedBy="cameras")
     */
    private $monture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CameraComment", mappedBy="cameraId", orphanRemoval=true)
     */
    private $cameraComments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg","image/jpg","image/png" })
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ForumTheme", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $theme;

    public function __construct()
    {
        $this->monture = new ArrayCollection();
        $this->cameraComments = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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
        return $this->sensor;
    }

    public function setSensor(string $sensor): self
    {
        $this->sensor = $sensor;

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

    public function getCategory(): ?CamCategory
    {
        return $this->category;
    }

    public function setCategory(?CamCategory $category): self
    {
        $this->category = $category;

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
     * @return Collection|Monture[]
     */
    public function getMonture(): Collection
    {
        return $this->monture;
    }

    public function addMonture(Monture $monture): self
    {
        if (!$this->monture->contains($monture)) {
            $this->monture[] = $monture;
        }

        return $this;
    }

    public function removeMonture(Monture $monture): self
    {
        if ($this->monture->contains($monture)) {
            $this->monture->removeElement($monture);
        }

        return $this;
    }

    /**
     * @return Collection|CameraComment[]
     */
    public function getCameraComments(): Collection
    {
        return $this->cameraComments;
    }

    public function addCameraComment(CameraComment $cameraComment): self
    {
        if (!$this->cameraComments->contains($cameraComment)) {
            $this->cameraComments[] = $cameraComment;
            $cameraComment->setCameraId($this);
        }

        return $this;
    }

    public function removeCameraComment(CameraComment $cameraComment): self
    {
        if ($this->cameraComments->contains($cameraComment)) {
            $this->cameraComments->removeElement($cameraComment);
            // set the owning side to null (unless already changed)
            if ($cameraComment->getCameraId() === $this) {
                $cameraComment->setCameraId(null);
            }
        }

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getTheme(): ?ForumTheme
    {
        return $this->theme;
    }

    public function setTheme(ForumTheme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
