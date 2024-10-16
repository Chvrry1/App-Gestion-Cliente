<?php
require "../conexion/Conexion.php";
require "../conexion/Config.php";

$dbConn = conexion($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //Mostrar lista de post
    $input = $_GET;
    $id = $input['id'];
    $estado = $input['estado'];

    $sql = $dbConn->prepare("SELECT tblpedido.IdPedido, tblpedido.hora, tblpersona.apPaterno AS apellido, 
    tblpersona.nombres AS nombre, tblpedido.importetotalMX, tblpedido.pagoconMX, tblpedido.cambioMX, 
    tblmetodopago.nombre AS metodoPago, tblpersona.celular, tblestadopedido.nombreEstado FROM tblpedido
      INNER JOIN tblcliente ON tblcliente.IdCliente = tblpedido.IdCliente
      INNER JOIN tblpersona ON tblpersona.IdPersona = tblcliente.IdPersona
      INNER JOIN tblmetodopago ON tblmetodopago.IdMetodoPago = tblpedido.IdMetodoPago
      INNER JOIN tblestadopedido ON tblestadopedido.IdEstadoPedido = tblpedido.IdEstadoPedido
      WHERE tblpedido.IdRepartidor = :IdRepartidor AND tblestadopedido.IdEstadoPedido= :IdEstadoPedido LIMIT 1");

    $sql->bindParam(':IdRepartidor', $id, PDO::PARAM_INT);
    $sql->bindParam(':IdEstadoPedido', $estado, PDO::PARAM_INT);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);

    $arreglo['data'] = $sql->fetchAll();
    echo json_encode($arreglo);

    header('Content-Type: application/json');
    header("HTTP/1.1 200 OK");

    exit();
}

header("HTTP/1.1 400 Bad Request");
