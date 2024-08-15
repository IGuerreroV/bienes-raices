<?php


define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
// define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function getCarpetaImagenes(string $tipo) {
    $carpetaImagenes = __DIR__ . '/../imagenes/';

    if($tipo === 'propiedades') {
        $carpetaImagenes .= 'propiedades/';
    } else if($tipo === 'vendedores') {
        $carpetaImagenes .= 'vendedores/';
    }

    return $carpetaImagenes;
}

function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado() {
    session_start();
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    if(!$_SESSION['login']) {
        header('Location: /');
    }
}

function debuguear($variable) {
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}