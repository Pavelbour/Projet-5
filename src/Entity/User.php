<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salt;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CameraComment", mappedBy="userId", orphanRemoval=true)
     */
    private $cameraComments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LensComment", mappedBy="userId", orphanRemoval=true)
     */
    private $lensComments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForumMessage", mappedBy="user", orphanRemoval=true)
     */
    private $forumMessages;

    public function __construct()
    {
        $this->cameraComments = new ArrayCollection();
        $this->lensComments = new ArrayCollection();
        $this->forumMessages = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt(): ?string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function eraseCredentials()
    {

    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->salt,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->salt
        ) = unserialize($serialized, ['allowed_classes' => false]);
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
            $cameraComment->setUserId($this);
        }

        return $this;
    }

    public function removeCameraComment(CameraComment $cameraComment): self
    {
        if ($this->cameraComments->contains($cameraComment)) {
            $this->cameraComments->removeElement($cameraComment);
            // set the owning side to null (unless already changed)
            if ($cameraComment->getUserId() === $this) {
                $cameraComment->setUserId(null);
            }
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
            $lensComment->setUserId($this);
        }

        return $this;
    }

    public function removeLensComment(LensComment $lensComment): self
    {
        if ($this->lensComments->contains($lensComment)) {
            $this->lensComments->removeElement($lensComment);
            // set the owning side to null (unless already changed)
            if ($lensComment->getUserId() === $this) {
                $lensComment->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ForumMessage[]
     */
    public function getForumMessages(): Collection
    {
        return $this->forumMessages;
    }

    public function addForumMessage(ForumMessage $forumMessage): self
    {
        if (!$this->forumMessages->contains($forumMessage)) {
            $this->forumMessages[] = $forumMessage;
            $forumMessage->setUser($this);
        }

        return $this;
    }

    public function removeForumMessage(ForumMessage $forumMessage): self
    {
        if ($this->forumMessages->contains($forumMessage)) {
            $this->forumMessages->removeElement($forumMessage);
            // set the owning side to null (unless already changed)
            if ($forumMessage->getUser() === $this) {
                $forumMessage->setUser(null);
            }
        }

        return $this;
    }
}
