<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typeitem
 *
 * @ORM\Table(name="typeitem")
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
     * @var int|null
     *
     * @ORM\Column(name="name", type="integer", nullable=true)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?int
    {
        return $this->name;
    }

    public function setName(?int $name): self
    {
        $this->name = $name;

        return $this;
    }


}
