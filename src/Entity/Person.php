<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 2000)]
    private ?string $bio = null;

    #[ORM\ManyToOne(inversedBy: 'people')]
    private ?Address $address = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }
    public function JsonSerialize()
    {
        return [
            "id" =>$this->getId(),
            "name" =>$this->getName(),
            "bio" =>$this->getBio(),
        ];
    }

    public function getAddress(): ?address
    {
        return $this->address;
    }

    public function setAddress(?address $address): static
    {
        $this->address = $address;

        return $this;
    }


}
