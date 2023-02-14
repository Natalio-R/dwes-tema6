<?php
$nombre = $_POST && !empty($_POST['nombre']) ? htmlentities(trim($_POST['nombre'])) : '';
$email = $_POST && !empty($_POST['email']) ? htmlentities(trim($_POST['email'])) : '';

$usuario = $datosParaVista['datos'];

$errores = $usuario ? $usuario->getErrores() : [];
?>
<section class="bg-white pt-5 mx-auto max-w-8xl">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Crear una cuenta
                </h1>
                <form class="space-y-4 md:space-y-6" action="index.php?controlador=usuario&accion=registro" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre de usuario</label>
                        <input type="text" name="nombre" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $nombre ?>">
                    </div>
                    <?php
                    if (isset($errores['nombre']) && $errores['nombre'] !== null) {
                        echo "<p class='mb-2 text-sm text-red-600'><span class='font-medium'>Oops!</span> {$errores['nombre']}</p>";
                    }
                    ?>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="nombre@gmail.com" value="<?= $email ?>">
                    </div>
                    <?php
                    if (isset($errores['email']) && $errores['email'] !== null) {
                        echo "<p class='mb-2 text-sm text-red-600'><span class='font-medium'>Oops!</span> {$errores['email']}</p>";
                    }
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
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Confirmar contraseña</label>
                        <input type="password" name="repiteclave" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    </div>
                    <?php
                    if (isset($errores['rep_clave']) && $errores['rep_clave'] !== null) {
                        echo "<p class='mt-2 text-sm text-red-600 dark:text-red-500'><span class='font-medium'>Oops!</span> {$errores['rep_clave']}</p>";
                    }
                    ?>
                    <div>
                        <label for="avatar" class="block mb-2 text-sm font-medium text-gray-900">Puedes elegir un avatar</label>
                        <input type="file" name="avatar" id="avatar" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300" required="">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-light text-gray-500">Acepto las <a class="font-medium text-primary-600 hover:underline" href="#">Condiciones y Servicios</a></label>
                        </div>
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Crear una cuenta</button>
                    <p class="text-sm font-light text-gray-500">
                        ¿Ya tienes una cuenta? <a href="index.php?controlador=usuario&accion=login" class="font-medium text-primary-600 hover:underline">Inicia Sesión</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>