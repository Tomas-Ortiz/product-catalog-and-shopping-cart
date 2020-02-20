<?php
$host = 'localhost';
$bd = 'productos';
$usuario = 'root';

$conexion = new mysqli($host, $usuario, null, $bd);

//si devuelve 1 (true) ocurrio un error
if($conexion->connect_errno){
    die('Error de conexión: '. $conexion->connect_errno);
}