<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typeitem
 *
 * @ORM\Table(name="typeitem", indexes={@ORM\Index(name="genre", columns={"genre"})})
 * @ORM\Entity
 */
class Typeitem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var \Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="genre", referencedColumnName="id")
     * })
     */
    private $genre;

    public function getId(): ?int
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

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }


}
