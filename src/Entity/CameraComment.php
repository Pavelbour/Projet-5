<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CameraCommentRepository")
 */
class CameraComment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Camera", inversedBy="cameraComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cameraId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cameraComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added;

    public function getId()
    {
        return $this->id;
    }

    public function getCameraId(): ?Camera
    {
        return $this->cameraId;
    }

    public function setCameraId(?Camera $cameraId): self
    {
        $this->cameraId = $cameraId;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getAdded(): ?\DateTimeInterface
    {
        return $this->added;
    }

    public function setAdded(\DateTimeInterface $added): self
    {
        $this->added = $added;

        return $this;
    }
}
