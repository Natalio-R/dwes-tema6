<?php

namespace dwesgram\modelo;

use dwesgram\modelo\Usuario;
use dwesgram\modelo\BaseDatos;

class UsuarioBd
{
    use BaseDatos;

    public static function getUsuario(int $id): Usuario|null
    {
        try {
            $conexion = BaseDatos::getConexion();
            $sentencia = $conexion->prepare("select * from usuario where id=?");
            $sentencia->bind_param('i', $id);
            $sentencia->execute();
            $resultado = $sentencia->get_result();
            $fila = $resultado->fetch_assoc();
            if ($fila == null) {
                return null;
            } else {
                return new Usuario(
                    id: $fila['id'],
                    nombre: $fila['nombre'],
                    email: $fila['email'],
                    clave: $fila['clave'],
                    avatar: $fila['avatar'],
                    registrado: $fila['registrado']
                );
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public static function getUsuarioPorNombre(string $nombre): Usuario|null
    {
        try {
            $conexion = BaseDatos::getConexion();
            $sentencia = $conexion->prepare("select id, nombre, avatar, clave from usuario where nombre=?");
            $sentencia->bind_param('s', $nombre);
            $sentencia->execute();
            $resultado = $sentencia->get_result();
            $fila = $resultado->fetch_assoc();
            if ($fila == null) {
                return null;
            } else {
                return new Usuario(
                    id: $fila['id'],
                    nombre: $fila['nombre'],
                    avatar: $fila['avatar'],
                    clave: $fila['clave'],
                );
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public static function insertarUsuario(Usuario $usuario): int|null
    {
        try {
            $conexion = BaseDatos::getConexion();
            $sentencia = $conexion->prepare("insert into usuario (nombre, clave, email, avatar, registrado) values (?, ?, ?, ?, unix_timestamp())");
            $nombre = $usuario->getNombre();
            $email = $usuario->getEmail();
            $clave = $usuario->getClave();
            $rep_clave = $usuario->getRepClave();
            if ($clave == $rep_clave) {
                $claveCryppt = password_hash($clave, PASSWORD_BCRYPT);
            }
            $avatar = $usuario->getAvatar();
            $sentencia->bind_param('ssss', $nombre, $claveCryppt, $email, $avatar);
            $sentencia->execute();

            return $conexion->insert_id;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }
}
