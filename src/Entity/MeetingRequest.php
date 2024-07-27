<?php

namespace App\Entity;

use App\Repository\MeetingRequestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeetingRequestRepository::class)]
class MeetingRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Fname = null;

    #[ORM\Column(length: 255)]
    private ?string $Lname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $ChooseDateTime = null;

    #[ORM\Column(length: 255)]
    private ?string $purpose = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFname(): ?string
    {
        return $this->Fname;
    }

    public function setFname(string $Fname): static
    {
        $this->Fname = $Fname;

        return $this;
    }

    public function getLname(): ?string
    {
        return $this->Lname;
    }

    public function setLname(string $Lname): static
    {
        $this->Lname = $Lname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getChooseDateTime(): ?\DateTimeInterface
    {
        return $this->ChooseDateTime;
    }

    public function setChooseDateTime(\DateTimeInterface $ChooseDateTime): static
    {
        $this->ChooseDateTime = $ChooseDateTime;

        return $this;
    }

    public function getPurpose(): ?string
    {
        return $this->purpose;
    }

    public function setPurpose(string $purpose): static
    {
        $this->purpose = $purpose;

        return $this;
    }
}
