<?php
    require "../conexion/Conexion.php";
    require "../conexion/Config.php";

    $dbConn = conexion($db);


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

      $sql = $dbConn->prepare("CALL spRepartidorRegistrar(?,?,?,?,?,?,?,?,?,?,?)");
      $sql->bindValue('1', $_GET['primer_pellido']);
      $sql->bindValue('2', $_GET['segundo_apellido']);
      $sql->bindValue('3', $_GET['nombre']);
      $sql->bindValue('4', $_GET['numero_id']);
      $sql->bindValue('5', $_GET['celular']);
      $sql->bindValue('6', $_GET['sexo']);
      $sql->bindValue('7', $_GET['correo']);
      $sql->bindValue('8', $_GET['nombre_vehiculo']);// tipo de verhiculo
      $sql->bindValue('9', $_GET['placa_vehiculo']);
      $sql->bindValue('10', $_GET['id_us']); //id usuario
      $sql->bindValue('11', $_GET['contrasena']);

      $sql->execute();

      if($sql === false){
        $arreglo['estatus'] = 204;
    }else{
        $arreglo['estatus'] = 200;
    }

      header('Content-Type: application/json');
      header("HTTP/1.1 200 OK");

      $arreglo['data']= $sql->fetchAll();
      echo json_encode($arreglo);   

    exit();
}

header("HTTP/1.1 400 Bad Request");

?>