<?php

namespace dwesgram\controlador;

use dwesgram\controlador\Controlador;
use dwesgram\modelo\Usuario as ModeloUsuario;
use dwesgram\modelo\Entrada as ModeloEntrada;
use dwesgram\modelo\UsuarioBd;

class UsuarioControlador extends Controlador
{

    public function login(): array|string|null
    {
        if ($this->autenticado()) {
            header('Location: index.php');
            return null;
        }

        // Si no hay POST: cargo el formulario vacío
        if (!$_POST) {
            $this->vista = 'usuario/login';
            return null;
        }

        // Si hay POST: se crea el modelo desde el POST
        $nombre = $_POST && isset($_POST['nombre']) ? htmlentities(trim($_POST['nombre'])) : '';
        $clave = $_POST && isset($_POST['clave']) ? htmlentities(trim($_POST['clave'])) : '';
        $usuario = UsuarioBd::getUsuarioPorNombre($nombre);
        if ($usuario !== null && password_verify($clave, $usuario->getClave())) {
            $_SESSION['usuario'] = [
                'id' => $usuario->getId(),
                'nombre' => $usuario->getNombre(),
                'avatar' => $usuario->getAvatar()
            ];
            header('Location: index.php');
            return null;
        }

        $this->vista = 'usuario/login';

        return [
            'nombre' => $nombre,
            'error' => 'Usuario y/o contraseña no válidos.'
        ];
    }

    public function registro(): ModeloUsuario|null
    {
        if ($this->autenticado()) {
            header('Location: index.php');
            return null;
        }

        if (!$_POST) {
            $this->vista = 'usuario/registro';
            return null;
        }

        // Si llega POST creamos el modelo Usuario
        $usuario = ModeloUsuario::crearUsuarioDesdePost($_POST);

        // Si el usuario no es válido mostramos el formulario con los datos del objeto
        if ($usuario->esValido()) {
            $usuario->setId(UsuarioBd::insertarUsuario($usuario));
            header('Location: index.php');

            return null;
        } else {
            $this->vista = 'usuario/registro';
            return $usuario;
        }
    }

    public function logout(): void
    {
        if (!$this->autenticado()) {
            return;
        }

        session_destroy();
        header('Location: index.php');
    }

    public function lista(): array
    {
        return [];
    }
    public function ver(): ModeloEntrada|null
    {
        return null;
    }
    public function crear(): ModeloEntrada|null
    {
        return null;
    }

    public function eliminar(): bool
    {
        return false;
    }
}
