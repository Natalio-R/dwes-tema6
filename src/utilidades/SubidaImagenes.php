<?php

namespace dwesgram\utilidades;


class SubidaImagenes
{
    public static function subir(array $files, string $carpeta): bool|null|string
    {
        //if ($files && isset($files['file']) && $files['file']['error'] === UPLOAD_ERR_OK) {
        if (is_uploaded_file($files['tmp_name'])) {
            $fichero = $files['tmp_name'];
            $permitido = MIME_IMAGENES_PERMITIDOS;

            $mime_fichero = mime_content_type($files['tmp_name']);

            if (!in_array($mime_fichero, $permitido)) {
                return false;
            }
            //$extension = pathinfo($files['name'], PATHINFO_EXTENSION);
            $rutaFicheroDestino = $carpeta . "/" . time() . $files['name'];

            if (move_uploaded_file($files['tmp_name'], $rutaFicheroDestino)) {
                return $rutaFicheroDestino;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
