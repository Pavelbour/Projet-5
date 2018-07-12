<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    private $name;

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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LensManufacturer", inversedBy="lens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Monture", inversedBy="lens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $monture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CamManufacturer", inversedBy="lens")
     */
    private $forManufacturer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LensComment", mappedBy="lensId", orphanRemoval=true)
     */
    private $lensComments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ForumTheme", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $theme;

    public function __construct()
    {
        $this->forManufacturer = new ArrayCollection();
        $this->lensComments = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getManufacturer(): ?LensManufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?LensManufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getMonture(): ?Monture
    {
        return $this->monture;
    }

    public function setMonture(?Monture $monture): self
    {
        $this->monture = $monture;

        return $this;
    }

    /**
     * @return Collection|CamManufacturer[]
     */
    public function getForManufacturer(): Collection
    {
        return $this->forManufacturer;
    }

    public function addForManufacturer(CamManufacturer $forManufacturer): self
    {
        if (!$this->forManufacturer->contains($forManufacturer)) {
            $this->forManufacturer[] = $forManufacturer;
        }

        return $this;
    }

    public function removeForManufacturer(CamManufacturer $forManufacturer): self
    {
        if ($this->forManufacturer->contains($forManufacturer)) {
            $this->forManufacturer->removeElement($forManufacturer);
        }

        return $this;
    }

    /**
     * @return Collection|LensComment[]
     */
    public function getLensComments(): Collection
    {
        return $this->lensComments;
    }

    public function addLensComment(LensComment $lensComment): self
    {
        if (!$this->lensComments->contains($lensComment)) {
            $this->lensComments[] = $lensComment;
            $lensComment->setLensId($this);
        }

        return $this;
    }

    public function removeLensComment(LensComment $lensComment): self
    {
        if ($this->lensComments->contains($lensComment)) {
            $this->lensComments->removeElement($lensComment);
            // set the owning side to null (unless already changed)
            if ($lensComment->getLensId() === $this) {
                $lensComment->setLensId(null);
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
