<?php

// src/Entity/Avisos.php
namespace App\Entity;

use App\Repository\AvisosRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=AvisosRepository::class)
 * @Vich\Uploadable
 */
class Avisos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imagen = null;

    /**
     * @Vich\UploadableField(mapping="avisos_images", fileNameProperty="imagen")
     * @var File|null
     */
    private $imagenFile;

    // getters y setters...

    public function setImagenFile(?File $imagenFile = null): void
    {
        $this->imagenFile = $imagenFile;

        if (null !== $imagenFile) {
            // Se necesita para la actualización en la base de datos
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImagenFile(): ?File
    {
        return $this->imagenFile;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }
}
