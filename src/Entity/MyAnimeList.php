<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MyAnimeListRepository")
 * @ORM\Table(name="app_my_anime_list")
 */
class MyAnimeList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $mal_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $al_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1, nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $episode;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rewatches;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Notes", cascade={"persist", "remove"}, )
     * @JoinColumn(name="notes_id", referencedColumnName="id")
     */
    private $notes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMalId(): ?int
    {
        return $this->mal_id;
    }

    public function setMalId(int $mal_id): self
    {
        $this->mal_id = $mal_id;

        return $this;
    }

    public function getAlId(): ?int
    {
        return $this->al_id;
    }

    public function setAlId(int $al_id): self
    {
        $this->al_id = $al_id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getEpisode(): ?int
    {
        return $this->episode;
    }

    public function setEpisode(int $episode): self
    {
        $this->episode = $episode;

        return $this;
    }

    public function getRewatches(): ?int
    {
        return $this->rewatches;
    }

    public function setRewatches(int $rewatches): self
    {
        $this->rewatches = $rewatches;

        return $this;
    }

    public function getNotes(): ?Notes
    {
        return $this->notes;
    }

    public function setNotes($note): self
    {
        $this->notes = $note;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
