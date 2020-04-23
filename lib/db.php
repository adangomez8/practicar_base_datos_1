<?php

/**
 * Se conecta a la base de datos, y trae todas las tareas.
 */
function cargarRegistros() {

    // 1. abro la conexión con MySQL 
    $db = new PDO('mysql:host=localhost;'.'dbname=db_tp3_p3;charset=utf8', 'root', '');

    // 2. enviamos la consulta (3 pasos)
    $sentencia = $db->prepare("SELECT * FROM pagos"); // prepara la consulta
    $sentencia->execute(); // ejecuta
    $pagos = $sentencia->fetchAll(PDO::FETCH_OBJ); // obtiene la respuesta

    return $pagos;
}

/**
 * Inserta un registro en la base da datos
 */
function inserarPago($deudor, $cuota, $cuota_capital, $fecha_pago) {
     // 1. abro la conexión con MySQL 
     $db = new PDO('mysql:host=localhost;'.'dbname=db_tp3_p3;charset=utf8', 'root', '');

     // 2. enviamos la consulta
    $sentencia = $db->prepare("INSERT INTO pagos(deudor, cuota, cuota_capital, fecha_pago) VALUES(?, ?, ?, ?)"); // prepara la consulta
    $sentencia->execute([$deudor, $cuota, $cuota_capital, $fecha_pago]); // ejecuta

}

function borrarRegistro($id){
     // 1. abro la conexión con MySQL 
     $db = new PDO('mysql:host=localhost;'.'dbname=db_tp3_p3;charset=utf8', 'root', '');

     // 2. enviamos la consulta (3 pasos)
     $sentencia = $db->prepare("DELETE FROM pagos where id_pagos=?"); // prepara la consulta
     $sentencia->execute([$id]);
     inserarPago($deudor, $cuota, $cuota_capital, $fecha_pago);
        header('Location: ' . BASE_URL . "registro");
}

//function pagarDeuda($id){
    // 1. abro la conexión con MySQL 
    //$db = new PDO('mysql:host=localhost;'.'dbname=db_tp3_p3;charset=utf8', 'root', '');

    // 2. enviamos la consulta (3 pasos)
    //$sentencia = $db->prepare("UPDATE pagos set pagado=1 where  id_pagos=?"); // prepara la consulta
    //$sentencia->execute([$id]);
    //inserarPago($deudor, $cuota, $cuota_capital, $fecha_pago);
   //    header('Location: ' . BASE_URL . "registro");
//}
