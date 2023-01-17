<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ApiResource(
    denormalizationContext: ['groups' => ['write']],
    normalizationContext: ['groups' => ['read']]
)]
class Post
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[Groups(['read'])]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read', 'write'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Slug(fields: ['title'])]
    #[Groups(['read', 'write'])]
    private ?string $slug = null;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['read', 'write'])]
    private $shortDescription;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['read', 'write'])]
    private $content;

    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?bool $isPublish = null;

    #[ORM\Column]
    #[Groups(['read', 'write'])]
    private ?bool $isFeatured = null;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups(['read', 'write'])]
    private $metaTagTitle;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups(['read', 'write'])]
    private $metaTagDescription;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups(['read', 'write'])]
    private $metaTagKeywords;

    #[ORM\Column(name: 'created', type: Types::DATE_MUTABLE)]
    #[Gedmo\Timestampable(on: 'create')]
    #[Groups(['read'])]
    private ?\DateTimeInterface $createdAt;

    #[ORM\Column(name: 'updated', type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable(on: 'update')]
    #[Groups(['read'])]
    private ?\DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): ?string
    {
        return $this->id;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function isIsPublish(): ?bool
    {
        return $this->isPublish;
    }

    public function setIsPublish(bool $isPublish): self
    {
        $this->isPublish = $isPublish;

        return $this;
    }

    public function isIsFeatured(): ?bool
    {
        return $this->isFeatured;
    }

    public function setIsFeatured(bool $isFeatured): self
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getMetaTagTitle(): ?string
    {
        return $this->metaTagTitle;
    }

    public function setMetaTagTitle(?string $metaTagTitle): self
    {
        $this->metaTagTitle = $metaTagTitle;

        return $this;
    }

    public function getMetaTagDescription(): ?string
    {
        return $this->metaTagDescription;
    }

    public function setMetaTagDescription(?string $metaTagDescription): self
    {
        $this->metaTagDescription = $metaTagDescription;

        return $this;
    }

    public function getMetaTagKeywords(): ?string
    {
        return $this->metaTagKeywords;
    }

    public function setMetaTagKeywords(?string $metaTagKeywords): self
    {
        $this->metaTagKeywords = $metaTagKeywords;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
