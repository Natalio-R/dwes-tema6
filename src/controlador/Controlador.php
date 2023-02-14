<?php

namespace dwesgram\controlador;

use dwesgram\modelo\Modelo;
use dwesgram\utilidades\Sesion;

abstract class Controlador
{
    protected string $vista;

    public function getVista(): string
    {
        return $this->vista;
    }

    public function autenticado(): bool
    {
        $sesion = new Sesion();
        if (!$sesion->haySesion()) {
            return false;
        }
        return true;
    }

    abstract public function lista(): array;
    abstract public function ver(): Modelo|null;
    abstract public function crear(): Modelo|null;
    abstract public function eliminar(): bool|null;
}
