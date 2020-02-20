<?php
session_start();

include 'conexionBD.php';

$conex = $conexion;

function consultarMarcas()
{

    $sql = 'SELECT marca, COUNT(marca) AS cantidad FROM `producto` GROUP BY marca';

    $resultado = mysqli_query($GLOBALS['conex'], $sql);

//si es diferente de true entonces hubo un error

    if (!$resultado) {

        return false;
    }
    if ($resultado->num_rows === 0) {
        sinResultados();
        return false;
    }

    return $resultado;
}

function mostrarProductos()
{

    $sql = 'SELECT producto.modelo, producto.marca, producto.precio, imgproducto.url FROM producto,imgproducto WHERE producto.modelo = imgproducto.modelo';

    $resultado = mysqli_query($GLOBALS['conex'], $sql);

    if (!$resultado) {
        return false;
    }

    if ($resultado->num_rows === 0) {
        sinResultados();
        return false;
    }

    return $resultado;
}

function ordenarProductos($ordenarPor)
{

    if (empty($_SESSION['marcaSeleccionada'])) {
        $sql = "SELECT producto.modelo, producto.marca, producto.precio, imgproducto.url FROM producto,imgproducto WHERE producto.modelo = imgproducto.modelo ORDER BY producto.precio $ordenarPor";
    } else {
        $marca = $_SESSION['marcaSeleccionada'];
        $sql = "SELECT producto.modelo, producto.marca, producto.precio, imgproducto.url FROM producto,imgproducto WHERE producto.modelo = imgproducto.modelo AND producto.marca = '$marca' ORDER BY producto.precio $ordenarPor";
    }


    $resultado = mysqli_query($GLOBALS['conex'], $sql);

    if (!$resultado) {
        return false;
    }

    if ($resultado->num_rows === 0) {
        sinResultados();
        return false;
    }

    return $resultado;

}

function filtrarMarca($marca)
{

    if (!empty($_SESSION['precio']) && empty($_SESSION['precioMin']) && empty($_SESSION['precioMax'])) {
        $ordenarPor = $_SESSION['precio'];
        $sql = "SELECT producto.modelo, producto.marca, producto.precio, imgproducto.url FROM producto,imgproducto WHERE producto.modelo = imgproducto.modelo AND producto.marca = '$marca' ORDER BY producto.precio $ordenarPor";

    } else if (!empty($_SESSION['precioMin']) && !empty($_SESSION['precioMax'])) {

        $min = $_SESSION['precioMin'];
        $max = $_SESSION['precioMax'];

        $sql = "SELECT producto.modelo, producto.marca, producto.precio, imgproducto.url FROM producto,imgproducto WHERE producto.modelo = imgproducto.modelo AND producto.marca = '$marca' AND producto.precio BETWEEN $min AND $max";

    } else {
        $sql = "SELECT producto.modelo, producto.marca, producto.precio, imgproducto.url FROM producto,imgproducto WHERE producto.modelo = imgproducto.modelo AND producto.marca = '$marca'";
    }

    $resultado = mysqli_query($GLOBALS['conex'], $sql);

    if (!$resultado) {
        return false;
    }

    if ($resultado->num_rows === 0) {
        sinResultados();
        return false;
    }

    return $resultado;

}

function eliminarFiltros()
{
    //*Elimina todas las variables de sesion para eliminar los filtros, menos el carro y el contador de indice para los productos del carro

    foreach($_SESSION as $clave => $valor){

        if($clave != "carro" && $clave != "proximoIndice"){
            unset($_SESSION[$clave]);
        }

    }

}

function filtrarRangoPrecio($min, $max)
{

    if(!empty($_SESSION['marcaSeleccionada'])){

        $marca = $_SESSION['marcaSeleccionada'];

        $sql = "SELECT producto.modelo, producto.marca, producto.precio, imgproducto.url FROM producto,imgproducto WHERE producto.modelo = imgproducto.modelo AND producto.marca = '$marca' AND producto.precio BETWEEN $min AND $max";
    } else{
        $sql = "SELECT producto.modelo, producto.marca, producto.precio, imgproducto.url FROM producto,imgproducto WHERE producto.modelo = imgproducto.modelo AND producto.precio BETWEEN $min AND $max";
    }

    $resultado = mysqli_query($GLOBALS['conex'], $sql);

    if (!$resultado) {
        return false;
    }

    if ($resultado->num_rows === 0) {
        sinResultados();
        return false;
    }

    return $resultado;

}

function sinResultados(){
    echo '<p class="alert alert-danger" style="width: 100%" role="alert">¡No se han encontrado resultados para la búsqueda!</p>';
}
function sinResultadosCarro(){
    echo '<p class="alert alert-danger" style="width: 50%; margin-top: 3%" role="alert">¡No hay productos en tu carrito!</p>';
    echo '<a href="Inicio.php" id="volverProd" class="btn btn-primary" type="button">Volver a Productos</a>';
}

function mostrarMasInfoProd($modelo){

    $sql = "SELECT * FROM producto WHERE modelo = '$modelo'";

    $resultado = mysqli_query($GLOBALS['conex'], $sql);

    if (!$resultado) {
        return false;
    }

    if ($resultado->num_rows === 0) {
        sinResultados();
        return false;
    }

    return $resultado;
}

function obtenerColores($modelo){

    $sql = "SELECT * FROM color WHERE modelo = '$modelo'";

    $resultado = mysqli_query($GLOBALS['conex'], $sql);

    if (!$resultado) {
        return false;
    }

    if ($resultado->num_rows === 0) {
        sinResultados();
        return false;
    }

    return $resultado;

}

function obtenerAlmacenamientos($modelo){

    $sql = "SELECT * FROM almacenamiento WHERE modelo = '$modelo'";

    $resultado = mysqli_query($GLOBALS['conex'], $sql);

    if (!$resultado) {
        return false;
    }

    if ($resultado->num_rows === 0) {
        sinResultados();
        return false;
    }

    return $resultado;

}