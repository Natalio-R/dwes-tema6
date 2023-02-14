<?php

namespace dwesgram\modelo;

use dwesgram\modelo\Modelo;
use dwesgram\utilidades\SubidaImagenes;

class Entrada extends Modelo
{
    private array $errores = [];

    public function __construct(
        private int|null $id = null,
        private string|null $texto,
        private string|null $imagen = null,
        private string|null $avatar = null,
        private int|null $autor = null,
        private int|null $creado = null
    ) {
        $this->errores = [
            'texto' => $texto === null || empty($texto) ? 'El texto no puede estar vacío' : null,
            'imagen' => null
        ];
    }

    public static function crearEntradaDesdePost(array $post): Entrada
    {
        $texto = $post && isset($post['texto']) ? htmlspecialchars(trim($post['texto'])) : null;
        $resultdo = SubidaImagenes::subir($_FILES['file'], CARPETA_IMAGENES);

        $entrada = new Entrada(
            texto: $texto,
            imagen: $resultdo,
            creado: time()
        );

        if ($resultdo === false) {
            $entrada->errores['imagen'] = "Las imagenes deben ser PNG, JPG o JPEG.";
        }

        return $entrada;
    }

    // Getters y Setter
    public function getId(): int|null
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getTexto(): string
    {
        return $this->texto ? $this->texto : '';
    }
    public function getImagen(): string|null
    {
        return $this->imagen;
    }
    public function getAutor(): int|null
    {
        return $this->autor ? $this->autor : null;
    }
    public function getAvatar(): string|null
    {
        return $this->avatar;
    }
    public function getCreado(): int
    {
        return $this->creado;
    }

    public function esValido(): bool
    {
        if ($this->errores === null) {
            return true;
        } else {
            $arrayErrores = array_filter($this->errores, function ($v1) {
                return $v1 !== null;
            });

            if (count($arrayErrores) === 0) {
                return true;
            }
        }

        return false;
    }

    public function getErrores(): array
    {
        return $this->errores;
    }
}
