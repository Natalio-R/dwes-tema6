<?php

use dwesgram\modelo\UsuarioBd;
use dwesgram\modelo\EntradaBd;

if (!empty($datosParaVista['datos'])) {
  echo <<<END
    <div class="container mx-auto max-w-8xl">
      <h1 class="mb-5 mt-8 text-6xl text-center font-extrabold leading-none tracking-tight text-gray-900">Últimas publicaciones</h1>
      <div class="grid grid-cols-4 gap-4">
  END;

  foreach ($datosParaVista['datos'] as $entrada) {
    $id = $entrada->getId();
    $texto = $entrada->getTexto();
    $imagen = $entrada->getImagen() === null ? 'assets/img/default.jpg' : $entrada->getImagen();
    $autor = UsuarioBd::getUsuario($entrada->getAutor());
    $creado = $entrada->getCreado();
    $avatar = $autor->getAvatar() === null || empty($autor->getAvatar()) ? 'assets/img/bender.png' : $autor->getAvatar();
    $borrarBoton = $sesion->haySesion() && $sesion->getId() == EntradaBd::getEntrada($id)->getAutor() ? "<a href='index.php?controlador=entrada&accion=eliminar&id=$id' class='px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700'>Eliminar</a>" : '';

    echo <<<END
    <div class="p-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow">
      <img class="rounded-lg" style="height:306px" src="$imagen" alt="Imagen publicación">
      <div class="my-5">
        <p class="mt-3 font-normal text-gray-900 font-bold">Descripción</p>
        <p class="mb-3 font-normal text-gray-700">$texto</p>
      </div>
      <hr />
      <div class="my-4 flex space-x-3">
        <img class="rounded-full w-9 h-9" src="$avatar" alt="Avatar usuario">
        <div class="space-y-0.5 font-medium text-left">
          <div>{$autor->getNombre()}</div>
          <div class="text-sm font-light text-gray-500">$creado</div>
        </div>
      </div>    
      <div class="inline-flex rounded-md shadow-sm">
        <a href="index.php?controlador=entrada&accion=ver&id=$id" class="px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
          Ver
        </a>
        $borrarBoton
      </div>
    </div>
    END;
  }
  echo "</div></div>";
} else {
  echo <<<END
    <section class="bg-white">
      <div class="mx-auto max-w-screen-md text-center py-8">
        <h1 class="mb-4 font-bold tracking-tight leading-none text-gray-900 text-6xl">Vaya...</h1>
        <p class="font-light text-gray-500 text-xl">No hay publicaciones todavía.</p>
      </div>
    </section>
  END;
}
