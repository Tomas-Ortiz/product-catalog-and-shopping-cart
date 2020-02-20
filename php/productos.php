<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="../js/productos.js"></script>
<link href="../css/productos.css" rel="stylesheet" type="text/css">

<div class="row product-grid">

    <?php

    //si se pulsa el boton de eliminar Filtros
    if (isset($_POST['eliminarFiltros'])) {
        eliminarFiltros();
    }

    //si se ha agregado al carro se muestra un msj por js
    if (isset($_SESSION['agregadoAlCarro'])) {

        if ($_SESSION['agregadoAlCarro'] === true) {

            $cantidad = $_SESSION['cantProd'];

            ?>
            <script type="text/javascript">

                let producto = '<?php echo $_SESSION['marca'] . ' ' . $_SESSION['modelo'] . $cantidad?>';

                agregadoAlCarro(producto, true);

            </script>

        <?php
        unset($_SESSION['marca']);
        unset($_SESSION['cantProd']);
        unset($_SESSION['modelo']);

        } else{
        ?>
            <script type="text/javascript">
                agregadoAlCarro("Oops!", false);
            </script>
            <?php
        }
        unset($_SESSION['agregadoAlCarro']);
    }

    if (isset($_POST['mayorPrecio'])) {

        //si se ordena por precio entonces se eliminan los rangos de precio
        unset($_SESSION['precioMin']);
        unset($_SESSION['precioMax']);

        $_SESSION['precio'] = "DESC";
        $resultado = ordenarProductos("DESC");

    } else if (isset($_POST['menorPrecio'])) {

        unset($_SESSION['precioMin']);
        unset($_SESSION['precioMax']);

        $_SESSION['precio'] = "ASC";
        $resultado = ordenarProductos("ASC");

        //si no hay filtros
    } else if (isset($_POST['marcaSeleccionada']) && !isset($_POST['precioMin']) && !isset($_POST['precioMax'])) {

        $_SESSION['marcaSeleccionada'] = $_POST['marcaSeleccionada'];

        $resultado = filtrarMarca($_POST['marcaSeleccionada']);

    } else if (isset($_POST['precioMin']) && isset($_POST['precioMax'])) {

        $_SESSION['precioMin'] = $_POST['precioMin'];
        $_SESSION['precioMax'] = $_POST['precioMax'];

        $resultado = filtrarRangoPrecio($_POST['precioMin'], $_POST['precioMax']);

    } else {
        //si se muestran los productos por defecto entonces se elimina el rango de precios
        unset($_SESSION['precioMin']);
        unset($_SESSION['precioMax']);

        $resultado = mostrarProductos();
    }

    ?>

    <script type="text/javascript">
        /* Se obtiene y actualiza el rango de precios, ya que al refrescarse la página estos valores se borran*/

        $('#precioMin').val(<?php echo $_SESSION['precioMin']?>);
        $('#precioMax').val(<?php echo $_SESSION['precioMax']?>);

    </script>

    <?php

    //si es true entonces la consulta fue exitosa
    if ($resultado) {

        $num = 0;

        while ($fila = $resultado->fetch_assoc()) {

            $num++;
            ?>

            <div class="col-md-8 col-sm-8 grid-item">

                <form method="get" action="carro.php">
                    <img src="../<?php echo $fila['url'] ?>" width="110" height="110"/>
                    <h1 class="product-title"><?php echo $fila['marca'] . ' ' . $fila['modelo'] ?></h1>

                    <input type="hidden" name="marca" value="<?php echo $fila['marca'] ?>">
                    <input type="hidden" name="modelo" value="<?php echo $fila['modelo'] ?>">
                    <input type="hidden" name="url" value="<?php echo $fila['url'] ?>">
                    <input type="hidden" name="precio" value="<?php echo $fila['precio'] ?>">
                    <input type="hidden" name="agregarProd">

                    <hr>
                    <h3 class="product-price">$<?php echo $fila['precio'] ?></h3>

                    <div class="cantidad-producto">
                        <input type="number" class="form-control" name="cantProd" value="1" min="1">
                    </div>

                    <button class="btn btn-success add-to-cart-button" id="agregadoAlCarro" name="agregadoAlCarro"><span
                                class="glyphicon glyphicon-ok"></span>Agregar al carro
                    </button>
                </form>
            </div>
            <?php

            if ($num % 3 === 0) {
                ?>
                <div class="row"></div>
                <?php
            }
        }
    }

    ?>

</div>

