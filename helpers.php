<?php

function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}
/**
 * Cargar una vista por su nombre
 * @param string $name
 * @param array $data
 * @return void
 */

function loadView($name, $data = [])
{
    $viewPath = basePath("APP/views/$name.view.php");
    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "la vista $name no existe";
    }
}
/**
 * Carga una vista parcial por su nombre 
 * @param string $name
 * @return void
 */
function loadPartial($name)
{
    $partialPath = basePath("App/views/partials/$name.php");
    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "la vista $name no existe";
    }
}
function sanitize($dirty)
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}
function redirect($url)
{
    header("Location: $url");
}

function resizeImg($trasto)
{
    $ruta_img = basePath('public/images/' . $trasto['imgurl']);
    $maxSize = 300;
    $image = new Imagick($ruta_img);
    if ($image->getImageHeight() <= $image->getImageWidth()) {
        //Usar algoritmo de lanczos en base al mayor
        $image->resizeImage($maxSize, 0, Imagick::FILTER_LANCZOS, 1);
    } else {
        //En base al alto
        $image->resizeImage(0, $maxSize, Imagick::FILTER_LANCZOS, 1);
    }
    // Usar compresion en jpg
    $image->setImageCompression(Imagick::COMPRESSION_JPEG);
    // Elegir nivel de compresion(minimo 1, maximo 100, )
    $image->setImageCompressionQuality(80);
    // borrar metadatos innecesarios
    $image->stripImage();

    // Guardar copia en directorio
    $image->writeImage(basePath('public/thumbnail/' . 'thumb' . $trasto['imgurl']));
    // Destroys Imagick object, freeing allocated resources in the process
    $image->destroy();
}


/**
 * inspeccionar una variable y para la ejecución
 * @param mixed $value
 * @return void
 */

function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}
/**
 * inspeccionar una variable y para la ejecución
 * @param mixed $value
 * @return void
 */

function inspectAndDie($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}
