<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ForumThemeRepository")
 */
class ForumTheme
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
    private $theme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $themeParent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForumMessage", mappedBy="theme")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForumMessage", mappedBy="theme", orphanRemoval=true)
     */
    private $forumMessages;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->forumMessages = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getThemeParent(): ?string
    {
        return $this->themeParent;
    }

    public function setThemeParent(string $themeParent): self
    {
        $this->themeParent = $themeParent;

        return $this;
    }

    /**
     * @return Collection|ForumMessage[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(ForumMessage $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setTheme($this);
        }

        return $this;
    }

    public function removeUser(ForumMessage $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getTheme() === $this) {
                $user->setTheme(null);
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
            $forumMessage->setTheme($this);
        }

        return $this;
    }

    public function removeForumMessage(ForumMessage $forumMessage): self
    {
        if ($this->forumMessages->contains($forumMessage)) {
            $this->forumMessages->removeElement($forumMessage);
            // set the owning side to null (unless already changed)
            if ($forumMessage->getTheme() === $this) {
                $forumMessage->setTheme(null);
            }
        }

        return $this;
    }
}
