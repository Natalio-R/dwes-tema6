<?php
$avatar = $sesion->getAvatar() === null || empty($sesion->getAvatar()) ? 'assets/img/bender.png' : $sesion->getAvatar();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DWESgram</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
</head>

<body>
  <div class="relative bg-white">
    <div class="mx-auto max-w-8xl">
      <div class="flex items-center justify-between border-b-2 border-gray-100 py-6">
        <div class="flex justify-start items-center">
          <a href="index.php" class="mr-8">
            <span class="sr-only">DWESgram</span>
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Logotipo Tailwind">
          </a>
          <nav class="space-x-10">
            <a href="index.php" class="mr-4 text-base font-medium text-gray-500 hover:text-gray-900">Inicio</a>
            <a href="index.php?controlador=entrada&accion=crear" class="text-base font-medium text-gray-500 hover:text-gray-900">Subir publicación</a>
          </nav>
        </div>
        <div class="hidden items-center justify-end md:flex md:flex-1 lg:w-0">
          <?php if ($sesion->haySesion()) { ?>
            <div class="mr-4 flex space-x-3 items-center">
              <img class="rounded-full w-9 h-9" src="<?php echo $avatar; ?>" alt="Avatar usuario">
              <div><?php echo $sesion->getNombre(); ?></div>
            </div>
            <a href="index.php?controlador=usuario&accion=logout" class="inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700">Cerrar Sesión</a>
          <?php } else { ?>
            <a href="index.php?controlador=usuario&accion=registro" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900 mr-8">Crear cuenta</a>
            <a href="index.php?controlador=usuario&accion=login" class="inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Iniciar Sesión</a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>