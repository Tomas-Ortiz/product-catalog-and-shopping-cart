<?php
include 'conexionBD.php';
include 'consultasBD.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Celulares</title>

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
</head>
<body>


<div class="container-fluid">

    <div class="row">

        <?php
        include '../encabezado.html';
        ?>

    </div>

    <div class="row">
        <div class="filtros col-md-4 col-lg-4">

            <div class="card">

                <article class="card-group-item">
                    <header class="card-header">
                        <form method="post">
                            <input class="eliminarFiltro btn btn-primary" type="submit" value="Eliminar filtros"
                                   name="eliminarFiltros"/>
                        </form>
                    </header>

                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">Ordenar productos</h6>
                        </header>
                        <div class="filter-content">

                            <div class="card-body">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ordenar por
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        <form method="post">
                                            <input class="dropdown-item" type="submit" value="Mayor Precio"
                                                   name="mayorPrecio">
                                            <hr>
                                            <input class="dropdown-item" type="submit" value="Menor Precio"
                                                   name="menorPrecio">
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </article>

                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">Rango de precios</h6>
                        </header>
                        <div class="filter-content">
                            <div class="card-body">
                                <div class="inputPrecios form-row">

                                    <form method="post">
                                        <div class="form-group col-md-6">
                                            <label>Min.</label>
                                            <input type="number" class="form-control" name="precioMin" id="precioMin"
                                                   placeholder="$0">
                                        </div>
                                        <div class="form-group col-md-6 text-right">
                                            <label>Máx.</label>
                                            <input type="number" class="form-control" name="precioMax" id="precioMax"
                                                   placeholder="$100000">
                                            <button class="btnRangoPrecio btn fas fa-arrow-right"
                                                    type="submit"></button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="card-group-item">
                        <header class="card-header">
                            <h6 class="title">Marca</h6>
                        </header>
                        <div class="filter-content">
                            <div class="card-body">
                                <?php

                                $resultado = consultarMarcas();

                                if ($resultado != false) {

                                    while ($fila = $resultado->fetch_assoc()) {

                                        ?>
                                        <div class="custom-control custom-checkbox">
                                            <form method="post">
                                                <span class="float-right badge badge-light round"><?php echo $fila['cantidad'] ?></span>
                                                <input type="submit" class="custom-control-input"
                                                       name="marcaSeleccionada"
                                                       id="check_<?php echo $fila['marca'] ?>"
                                                       value="<?php echo $fila['marca'] ?>">
                                                <label class="custom-control-label"
                                                       for="check_<?php echo $fila['marca'] ?>"><?php echo $fila['marca'] ?></label>
                                            </form>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </article>
            </div>

        </div>
        <div class="col-md-8 col-sm-8">

            <?php
            include 'productos.php';

            ?>

            <br>

        </div>

    </div>
</div>
</body>

</html>