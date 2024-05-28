<?php

namespace App\Entity;

use App\Repository\UsuariosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuariosRepository::class)]
class Usuarios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $nombre = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $apellido_paterno = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $apellido_materno = null;

    #[ORM\Column(length: 15)]
    private ?string $usuario = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contrasenia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidoPaterno(): ?string
    {
        return $this->apellido_paterno;
    }

    public function setApellidoPaterno(?string $apellido_paterno): static
    {
        $this->apellido_paterno = $apellido_paterno;

        return $this;
    }

    public function getApellidoMaterno(): ?string
    {
        return $this->apellido_materno;
    }

    public function setApellidoMaterno(?string $apellido_materno): static
    {
        $this->apellido_materno = $apellido_materno;

        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getContrasenia(): ?string
    {
        return $this->contrasenia;
    }

    public function setContrasenia(?string $contrasenia): static
    {
        $this->contrasenia = $contrasenia;

        return $this;
    }
}
