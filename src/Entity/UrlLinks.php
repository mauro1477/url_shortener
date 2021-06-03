<?php

namespace App\Entity;

use App\Repository\UrlLinksRepository;
use Doctrine\ORM\Mapping as ORM;


use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UrlLinksRepository::class)
 */
class UrlLinks
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(
     *    message = "The url '{{ value }}' is not a valid url",
     * )
     */
    private $original_link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $short_link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginalLink(): ?string
    {
        return $this->original_link;
    }

    public function setOriginalLink(string $original_link): self
    {
        $this->original_link = $original_link;

        return $this;
    }

    public function getShortLink(): ?string
    {
        return $this->short_link;
    }

    public function setShortLink(string $short_link): self
    {
        $this->short_link = $short_link;

        return $this;
    }
}
