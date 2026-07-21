<?php

namespace App\Entity;

use App\Repository\OpeningHourRepository;
use BcMath\Number;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningHourRepository::class)]
class OpeningHour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $day = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
private ?\DateTimeInterface $opening = null;

#[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
private ?\DateTimeInterface $closing = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getOpening(): ?\DateTimeInterface
    {
        return $this->opening;
    }

    public function setOpening(?\DateTimeInterface $opening): static
    {
        $this->opening = $opening;

        return $this;
    }

    public function getClosing(): ?\DateTimeInterface
    {
        return $this->closing;
    }

    public function setClosing(?\DateTimeInterface $closing): static
    {
        $this->closing = $closing;

        return $this;
    }
}
