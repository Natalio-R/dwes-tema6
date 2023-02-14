<?php

namespace dwesgram\utilidades;

class Sesion
{
    private int|null $id;
    private string|null $nombre;
    private string|null $avatar;

    public function __construct()
    {
        $this->id = $_SESSION && isset($_SESSION['usuario']) && isset($_SESSION['usuario']['id']) ? htmlentities($_SESSION['usuario']['id']) : null;
        $this->nombre = $_SESSION && isset($_SESSION['usuario']) && isset($_SESSION['usuario']['nombre']) ? htmlentities($_SESSION['usuario']['nombre']) : null;
        $this->avatar = $_SESSION && isset($_SESSION['usuario']) && isset($_SESSION['usuario']['avatar']) ? htmlentities($_SESSION['usuario']['avatar']) : null;
    }

    public function haySesion(): bool
    {
        return $this->id !== null ? $this->nombre : false;
    }

    public function mismoUsuario(int $id): bool
    {
        return $this->id === $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string|null
    {
        return $this->nombre;
    }

    public function getAvatar(): string|null
    {
        return $this->avatar;
    }
}
