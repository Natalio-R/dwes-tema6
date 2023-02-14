<?php

namespace dwesgram\utilidades;


class SubidaAvatar
{
    public static function subir(array $files, string $carpeta): bool|null|string
    {
        if ($files['error'] == UPLOAD_ERR_OK && $files['size'] > 0) {
            $fichero = $files['tmp_name'];
            $permitido = MIME_IMAGENES_PERMITIDOS;

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_fichero = finfo_file($finfo, $fichero);

            if (!in_array($mime_fichero, $permitido)) {
                return false;
            }

            $rutaFicheroDestino = $carpeta . "/" . time() . $files['name'];
            $seHaSubido = move_uploaded_file($files['tmp_name'], $rutaFicheroDestino);

            if ($seHaSubido) {
                return $rutaFicheroDestino;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
