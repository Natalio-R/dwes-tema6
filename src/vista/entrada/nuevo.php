<?php
$entrada = $datosParaVista['datos'];

$texto = $entrada ? $entrada->getTexto() : '';
$imagen = $entrada ? $entrada->getImagen() : '';

$errores = $entrada ? $entrada->getErrores() : [];
?>

<div class="container mx-auto max-w-8xl">
    <h1 class="my-8 text-6xl text-center font-extrabold leading-none tracking-tight text-gray-900">Nueva entrada</h1>
    <form action="index.php?controlador=entrada&accion=crear" method="post" enctype="multipart/form-data">
        <div class="mb-5">
            <label for="texto" class="block mb-2 text-sm font-medium text-gray-900">Descripción. Tienes 128 caracteres para plasmarlo... el resto se ignorará</label>
            <textarea id="texto" name="texto" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="¿Qué estás pensando?"><?= $texto ?></textarea>
            <?php
            if (isset($errores['texto']) && $errores['texto'] !== null) {
                echo "<p class='mt-2 text-sm text-red-600'><span class='font-medium'>Oops!</span> {$errores['texto']}</p>";
            }
            ?>
        </div>

        <div class="mb-3">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="user_avatar">Sube una imagen. (Solo se permiten imagenes con extensión .PNG, .JPE o JPEG)</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="file" type="file" name="file">
            <?php
            if (isset($errores['imagen']) && $errores['imagen'] !== null) {
                echo "<p class='mt-2 text-sm text-red-600'><span class='font-medium'>Oops!</span> {$errores['imagen']}</p>";
            }
            ?>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Publicar</button>
    </form>
</div>