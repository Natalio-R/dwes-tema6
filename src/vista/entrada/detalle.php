<?php

use dwesgram\modelo\UsuarioBd;
use dwesgram\modelo\EntradaBd;

if (!empty($datosParaVista['datos']) && $datosParaVista['datos'] != null) {
    $entrada = $datosParaVista['datos'];
    $id = $entrada->getId();
    $desc = $entrada->getTexto();
    $autor = $entrada->getAutor();
    $autorStr = UsuarioBd::getUsuario($entrada->getAutor()) !== null ? UsuarioBd::getUsuario($entrada->getAutor()) : '';
    $img = $entrada->getImagen();
    $borrarBoton = $sesion->haySesion() && $sesion->getId() == EntradaBd::getEntrada($id)->getAutor() ? "<a href='index.php?controlador=entrada&accion=eliminart&id=$id' class='inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center'>Eliminar</a>" : '';
    //$dt = new \DateTime('@' . $entrada->getCreado());
    //$dtstr = $dt->format('r');
    $fecha_deseada = $entrada->getCreado();
    $tiempo_transcurrido = time() - $fecha_deseada;

    $minutos = $tiempo_transcurrido / 60;
    $dias = $tiempo_transcurrido / 86400;
    $semanas = $tiempo_transcurrido / 604800;

    if ($tiempo_transcurrido < 60) {
        $tiempo = round($minutos) . ' minuto/s';
    } else if ($tiempo_transcurrido < 86400) {
        $tiempo = round($dias) . ' día/s';
    } else if ($tiempo_transcurrido < 604800) {
        $tiempo = round($semanas) . ' semana/s';
    }


    echo <<<END
    <section class="bg-white mt-4 container mx-auto max-w-8xl flex">
        <img src="$img" width="50%" alt="Imagen entrada" class="rounded-lg">
        <div class="py-16 px-4 mx-auto" style="width: 50%">
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900">Descripción</dt>
                <dd class="mb-5 font-light text-gray-500">$desc</dd>
            </dl>
            <dl class="my-4 flex space-x-3 items-center">
                <img class="rounded-full w-12 h-12" src="$avatar" alt="Avatar usuario">
                <div class="font-medium text-left">
                    <div class="font-semibold text-gray-900">{$autorStr->getNombre()}</div>
                    <div class="text-sm font-light text-gray-500">Publicado hace $tiempo.</div>
                </div>
            </dl>
            <div class="flex items-center space-x-4"> 
                <a href="index.php?controlador=entrada&accion=lista" class='text-gray-600 bg-gray-300 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center'>
                    Volver
                </a>
                $borrarBoton
            </div>
        </div>
    </section>
    END;
} else {
    echo "<p>No existe este item</p>";
}
