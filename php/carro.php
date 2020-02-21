<?php
include 'consultasBD.php';

$modelo = $_GET['modelo'];

if (isset($_GET['agregarProd'])) {

    agregarProducto($modelo);

    header('location: Inicio.php');

} else if (isset($_GET['borrarProducto'])) {

    eliminarProducto($modelo);

    //cuando se elimina un producto los indices del array se reordenan
    $_SESSION['carro'] = array_values($_SESSION['carro']);

    header('location: productosCarro.php');

} else if (isset($_GET['eliminarTodo'])) {

    unset($_SESSION['carro']);

    header('location: productosCarro.php');

}

function agregarProducto($modelo)
{
    $yaAgregado = productoYaAgregado($modelo);

    if ($yaAgregado) {

        $_SESSION['agregadoAlCarro'] = false;

    } else {

        $_SESSION['agregadoAlCarro'] = true;

        $marca = $_GET['marca'];
        $cant = $_GET['cantProd'];
        $precio = $_GET['precio'];
        $urlImg = $_GET['url'];

        $subtotalProd = $cant * $precio;

//se guardan los valores del producto añadido al carro, para luego mostrar un mensaje en otro archivo
        $cantidad = " (x" . $_GET['cantProd'] . ")";

        $_SESSION['cantProd'] = $cantidad;
        $_SESSION['marca'] = $marca;
        $_SESSION['modelo'] = $modelo;

        $resultado = mostrarMasInfoProd($modelo);

        $fila = $resultado->fetch_assoc();

        //si el carro está vacio se lo declara como un array vacio, para luego agregarle elementos
        if (empty($_SESSION['carro'])) {
            $_SESSION['carro'] = array();
        }

        $producto = array(
            'modelo' => $modelo,
            'marca' => $marca,
            'precio' => $precio,
            'cantidad' => $cant,
            'subtotal' => $subtotalProd,
            'url' => $urlImg,
            'pulgadas' => $fila['pulgadas'],
            'so' => $fila['so'],
            'cpu' => $fila['cpu'],
            'ram' => $fila['ram'],
            'bateria' => $fila['bateria'],
        );

        //se agrega un producto (array) al final del array de carro

        array_push($_SESSION['carro'], $producto);

    }
}

function eliminarProducto($modelo)
{
    $i = 0;
    $flag = true;

//se busca el producto mediante el modelo dentro del array de carro y se lo elimina
//una vez que se lo encuentra y elimina, el ciclo while se detiene y se actualiza la pagina del carro

    while ($flag) {

        //se verifica que un producto exista en ese indice y que sea igual al modelo que queremos eliminar
        if ($_SESSION['carro'][$i]['modelo'] === $modelo) {

            unset($_SESSION['carro'][$i]);
            $flag = false;
        }
        $i++;
    }

}

function productoYaAgregado($modelo)
{
    foreach ($_SESSION['carro'] as $fila) {
        if ($fila['modelo'] === $modelo) {
            return true;
        }
    }
    return false;
}

