<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre", indexes={@ORM\Index(name="t", columns={"typeitem"})})
 * @ORM\Entity
 */
class Genre
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
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var \Typeitem
     *
     * @ORM\ManyToOne(targetEntity="Typeitem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="typeitem", referencedColumnName="id")
     * })
     */
    private $typeitem;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTypeitem(): ?Typeitem
    {
        return $this->typeitem;
    }

    public function setTypeitem(?Typeitem $typeitem): self
    {
        $this->typeitem = $typeitem;

        return $this;
    }


}
