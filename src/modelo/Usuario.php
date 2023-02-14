<?php

namespace dwesgram\modelo;

use dwesgram\modelo\Modelo;
use dwesgram\utilidades\SubidaAvatar;

class Usuario extends Modelo
{
    private array $errores = [];

    public function __construct(
        private int|null $id = null,
        private string|null $nombre = null,
        private string|null $clave = null,
        private string|null $rep_clave = null,
        private string|null $email = null,
        private string $avatar = '',
        private int|null $registrado = null
    ) {
        $this->errores = [
            'nombre' => $nombre === null || empty($nombre) ? 'El nombre no puede estar vacío' : null,
            'email' => $email === null || empty($email) ? 'El email no puede estar vacío' : null,
            'clave' => $clave === null || empty($clave) ? 'La contraseña no puede estar vacía' : null,
            'rep_clave' => $clave !== $rep_clave ? 'Las contraseñas deben coincidir' : null,
            'avatar' => null
        ];
    }

    public static function crearUsuarioDesdePost(array $post): Usuario
    {
        $nombre = $post && isset($post['nombre']) ? htmlspecialchars(trim($post['nombre'])) : null;
        $email = $post && isset($post['email']) ? htmlspecialchars(trim($post['email'])) : null;
        $clave = $post && isset($post['clave']) ? htmlspecialchars(trim($post['clave'])) : null;
        $rep_clave = $post && isset($post['repiteclave']) ? htmlspecialchars(trim($post['repiteclave'])) : null;

        $usuario = new Usuario(
            nombre: $nombre,
            email: $email,
            clave: $clave,
            rep_clave: $rep_clave,
            registrado: time()
        );

        $resultado = SubidaAvatar::subir($_FILES['avatar'], CARPETA_AVATARES);
        if ($resultado === false) {
            $usuario->errores['avatar'] = 'El avatar tiene que ser una imagen PNG y JPEG';
        } else if ($resultado === null) {
            $usuario->avatar = '';
        } else {
            $usuario->avatar = $resultado;
        }

        if (mb_strlen($usuario->clave) < 8) {
            $usuario->errores['clave'] = "La contraseña debe ser de 8 caracteres como mínimo.";
        }

        $otro = UsuarioBd::getUsuarioPorNombre($usuario->nombre);
        if ($otro !== null) {
            $usuario->errores['nombre'] = "Ya existe un usuario con ese nombre.";
        }

        return $usuario;
    }

    // Getters y Setters
    public function getId(): int|null
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getNombre(): string
    {
        return $this->nombre ? $this->nombre : '';
    }
    public function getEmail(): string
    {
        return $this->email ? $this->email : '';
    }
    public function getClave(): string
    {
        return $this->clave ? $this->clave : '';
    }
    public function getRepClave(): string
    {
        return $this->rep_clave ? $this->rep_clave : '';
    }
    public function getAvatar(): string
    {
        return $this->avatar ? $this->avatar : '';
    }
    public function getRegistrado(): int
    {
        return $this->registrado;
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
