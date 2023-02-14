<?php

namespace dwesgram\controlador;

use dwesgram\controlador\Controlador;
use dwesgram\modelo\Entrada as ModeloEntrada;
use dwesgram\modelo\EntradaBd;

class EntradaControlador extends Controlador
{
    public function lista(): array
    {
        $this->vista = 'entrada/lista';
        return EntradaBd::getEntradas();
    }

    public function ver(): ModeloEntrada|null
    {
        $this->vista = 'entrada/detalle';
        $id = htmlspecialchars($_GET['id']);
        return EntradaBd::getEntrada($id);
    }

    public function crear(): ModeloEntrada|null
    {
        if (!$this->autenticado()) {
            header('Location: index.php');
            return null;
        }

        // Si no hay POST: cargo el formulario vacío
        if (!$_POST) {
            $this->vista = 'entrada/nuevo';
            return null;
        }

        // Si hay POST: se crea el modelo desde el POST
        $entrada = ModeloEntrada::crearEntradaDesdePost($_POST);
        if ($entrada->esValido()) {
            $this->vista = 'entrada/detalle';
            $entrada->setId(EntradaBd::insertar($entrada));

            return $entrada;
        } else {
            $this->vista = 'entrada/nuevo';
            return $entrada;
        }
    }

    public function eliminar(): bool
    {
        global $sesion;

        if (!$this->autenticado()) {
            header('Location: index.php');
            return null;
        }

        $this->vista = 'entrada/eliminar';
        $id = $_GET && isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;

        if ($id !== null) {
            if ($sesion->getId() == EntradaBd::getEntrada($id)->getAutor()) {
                return EntradaBd::eliminar($id);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
