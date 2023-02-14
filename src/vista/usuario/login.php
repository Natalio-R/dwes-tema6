<?php

$datos = $datosParaVista['datos'];
$nombre = $datos !== null ? $datos['nombre'] : '';
$error = $datos !== null ? $datos['error'] : '';

?>
<section class="bg-white pt-5 mx-auto max-w-8xl">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Iniciar Sesión
                </h1>
                <form class="space-y-4 md:space-y-6" action="index.php?controlador=usuario&accion=login" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre de usuario</label>
                        <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $nombre ?>">
                    </div>
                    <?php
                    echo "<p class='mt-2 text-sm text-red-600 dark:text-red-500'>$error</p>";
                    ?>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
                        <input type="password" name="clave" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700">
                    </div>
                    <?php
                    if (isset($errores['clave']) && $errores['clave'] !== null) {
                        echo "<p class='mt-2 text-sm text-red-600 dark:text-red-500'><span class='font-medium'>Oops!</span> {$errores['clave']}</p>";
                    }
                    ?>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Iniciar Sesión</button>
                    <p class="text-sm font-light text-gray-500">
                        ¿Todavía no tienes una cuenta? <a href="index.php?controlador=usuario&accion=registro" class="font-medium text-primary-600 hover:underline">Crear cuenta</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>