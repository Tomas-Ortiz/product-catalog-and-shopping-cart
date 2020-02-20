<?php
include 'conexionBD.php';
include 'consultasBD.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carro de compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.12.0/js/all.js" data-auto-replace-svg="nest"></script>

    <script src="../js/productos.js"></script>
    <link href="../css/inicio.css" rel="stylesheet" type="text/css">
    <link href="../css/carro.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="container-fluid">

    <div class="row">

        <?php
        include '../encabezado.html';
        ?>

    </div>

    <div class="row">

        <div class="col-lg-11 col-sm-11 hero-feature">
            <?php
            if (empty($_SESSION['carro'])) {
                sinResultadosCarro();
                //termina el script
                exit();
            }
            ?>
            <div class="table-responsive">
                <!-- TABLA -->
                <table class="table table-bordered tbl-cart">

                    <thead>
                    <tr>
                        <td></td>
                        <td>Producto</td>
                        <td>Color</td>
                        <td>Almacenamiento</td>
                        <td>SO</td>
                        <td>CPU</td>
                        <td>Bateria</td>
                        <td>Pulgadas</td>
                        <td>Ram</td>
                        <td>Cantidad</td>
                        <td>Precio unitario</td>
                        <td>SubTotal</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;

                    foreach ($_SESSION['carro'] as $carro) {

                        $total += $carro['subtotal'];

                        ?>
                        <tr>
                            <td>
                                <img src="../<?php echo $carro['url'] ?>" width="47" height="47">
                            </td>
                            <td><?php echo $carro['marca'] . ' ' . $carro['modelo'] ?></td>

                            <td>
                                <select>
                                    <?php
                                    $resultado = obtenerColores($carro['modelo']);

                                    while ($fila = $resultado->fetch_assoc()) {
                                        ?>
                                        <option><?php echo $fila['color'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select>
                                    <?php
                                    $resultado = obtenerAlmacenamientos($carro['modelo']);

                                    while ($fila = $resultado->fetch_assoc()) {
                                        ?>
                                        <option><?php echo $fila['almacenamiento'] ?> GB</option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>

                            <td><?php echo $carro['so'] ?></td>
                            <td><?php echo $carro['cpu'] ?></td>
                            <td><?php echo $carro['bateria'] ?> mAh</td>
                            <td><?php echo $carro['pulgadas'] ?></td>
                            <td><?php echo $carro['ram'] ?></td>
                            <td><?php echo $carro['cantidad'] ?></td>
                            <td>$<?php echo $carro['precio'] ?></td>
                            <td>$<?php echo $carro['subtotal'] ?></td>
                            <td class="text-center">
                                <a href="carro.php?borrarProducto=true&modelo=<?php echo $carro['modelo'] ?>"
                                   class="remove_cart" rel="2">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }

                    ?>

                    <tr>
                        <td colspan="11" style="text-align: right">Total</td>
                        <td class="total" colspan="2"><b>$<?php echo $total ?></b>
                        </td>
                    </tr>

                    </tbody>
                    <!-- FIN TABLA-->
                </table>

            </div>

            <a href="Inicio.php" id="volverProd" class="btn btn-primary" type="button">Volver a Productos</a>

            <a href="carro.php?eliminarTodo=true" id="LimpiarCarro" type="button"
               class="btn btn-danger">Eliminar todo </a>

            <a href="#" id="Comprar" type="button" class="btn btn-success">Comprar</a>

        </div>

    </div>

</div>

</body>
</html>