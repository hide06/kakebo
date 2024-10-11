<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\KakeboRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

#[ORM\Entity(repositoryClass: KakeboRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Kakebo
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $year_month_date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $objectif_reduction = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $objectif_undertake = null;

    #[ORM\Column]
    private ?float $save_money = null;

    #[ORM\ManyToOne(inversedBy: 'kakebos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYearMonthDate(): ?\DateTimeImmutable
    {
        return $this->year_month_date;
    }

    public function setYearMonthDate(\DateTimeImmutable $year_month_date): static
    {
        $this->year_month_date = $year_month_date;

        return $this;
    }

    public function getObjectifReduction(): ?string
    {
        return $this->objectif_reduction;
    }

    public function setObjectifReduction(?string $objectif_reduction): static
    {
        $this->objectif_reduction = $objectif_reduction;

        return $this;
    }

    public function getObjectifUndertake(): ?string
    {
        return $this->objectif_undertake;
    }

    public function setObjectifUndertake(?string $objectif_undertake): static
    {
        $this->objectif_undertake = $objectif_undertake;

        return $this;
    }

    public function getSaveMoney(): ?float
    {
        return $this->save_money;
    }

    public function setSaveMoney(float $save_money): static
    {
        $this->save_money = $save_money;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
