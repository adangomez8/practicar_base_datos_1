<?php

require_once 'lib/db.php';

function mostrarRegistros() {
    echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <base href="' . BASE_URL . '">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <title>Registro de pagos</title>
        </head>
        <body>

        <nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary mb-3">
            <a class="navbar-brand" href="">TODOList</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="listar">Home <span class="sr-only">(current)</span></a>
                </li>
                </ul>
            </div>
            </nav>

            <div class="container">

                <h1>Registro de pago de deudas</h1>

                <form action="crearRegistro" method="POST" class="my-4 col-xs-12 col-md-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input name="deudor" type="text" class="form-control" placeholder="Deudor">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                               <input type="number" name="cuota" id=""  placeholder="Cuota">
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                               <input type="number" name="cuota_capital" id=""  placeholder="Capital de la cuota">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                               <input type="date" name="fecha_pago" id="" placeholder="Fecha de pago">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
    ';

    // obtiene las pagos (arreglo)
    $pagos = cargarRegistros();

    // arma la lista de pagos
    echo "<table class='table table-striped'>";
    //echo "<thead>":
    echo "<td>Deudor</td>";
    echo "<td>Cuota</td>";
    echo "<td>Capital de la cuota</td>";
    echo "<td>Fecha de pago</td>";
   // echo "</thead>":
    foreach ($pagos as $pago) {
      echo "<tr>";
        echo "<td><b>" . $pago->deudor . "</td></b><td><b>" . $pago->cuota . "</td></b><td><b>" . $pago->cuota_capital . "</td></b><td><b>" . $pago->fecha_pago . "</td></b>";
        
        echo "</tr>";
    }
    echo "<table>";


    echo '  
            </div>          
        </body>
    </html>
    ';
}


function crearRegistro() {

    // toma los valores enviados por el usuario
   
    if(isset ($_POST['deudor'])){
        $deudor = $_POST['deudor'];
    }
    if(isset ($_POST['cuota'])){
        $cuota = $_POST['cuota'];
    }
    if(isset ($_POST['cuota_capital'])){
        $cuota_capital = $_POST['cuota_capital'];
    }
    if(isset ($_POST['fecha_pago'])){
        $fecha_pago = $_POST['fecha_pago'];
    }


    // verifica los datos obligatorios
    if (!empty($deudor) && !empty($cuota) && !empty($cuota_capital) && !empty($fecha_pago)) {

        // inserta en la DB y redirige
        inserarPago($deudor, $cuota, $cuota_capital, $fecha_pago);
        header('Location: ' . BASE_URL . "registros");
    } else {
        echo "<h2>ERROR! Faltan datos obligatorios</h2>";
    }


}