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
            <link rel="shortcut icon" href="img/icono.jpg" type="image/x-icon">
            <link rel="stylesheet" href="css/estilo.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <script src="https://kit.fontawesome.com/dbc9074876.js" crossorigin="anonymous"></script>
            <title>Registro de pagos</title>
        </head>
        <body>


           
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">PAGAQUÍ</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="registro">Registrarse <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="btn btn-outline-dark fas fa-search"></i></button>
            </form>
        </div>
        </nav>
        
        <header class="row">
        <img src="img/encabezado.png" alt="" class = "col-xs-3" width="300px">
        <h1 class="col-xs-9 titEncabezado"><b>REGISTRO DE PAGO DE DEUDAS</b></h1>
        </header>
            <div class="container">


                <form action="crearRegistro" method="POST" class="my-4 col-xs-12 col-md-3 formDeuda">
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
    echo "<td><i class='fas fa-user-alt'></i> Deudor</td>";
    echo "<td><i class='fas fa-list-ol'></i> Cuota</td>";
    echo "<td><i class='fas fa-coins'></i> Capital de la cuota</td>";
    echo "<td><i class='far fa-calendar-alt'></i> Fecha de pago</td>";
    echo "<td><i class='fas fa-backspace'></i> Borrar usuario</td>";
    echo "<td><i class='fas fa-piggy-bank'></i> Pagar deuda</td>";
   // echo "</thead>":
    foreach ($pagos as $pago) {
      echo "<tr>";
        echo "<td><b>" . $pago->deudor . "</td></b><td><b>Nº". $pago->cuota . "</td></b><td><b>$" . $pago->cuota_capital . "</td></b><td><b>" . $pago->fecha_pago . "</td></b><td><a href='borrar/  $pago->id_pagos 'class='borrar btn btn-outline-danger borrar'><i class='far fa-trash-alt'></i></a></td><td><a href='pagar/  $pago->id_pagos ' class='pagar btn btn-outline-success pagar'><i class='fas fa-hand-holding-usd'></a></td>";
          
    }
    echo "</tr>";
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
        header('Location: ' . BASE_URL . "registro");
    } else {
        echo "<h2>ERROR! Faltan datos obligatorios</h2>";
    }


}

