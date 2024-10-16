<?php
    require "../conexion/Conexion.php";
    require "../conexion/Config.php";


    $dbConn = conexion($db);


if ($_SERVER['REQUEST_METHOD'] == 'GET'){


      //Mostrar lista de post

      $sql = $dbConn->prepare("SELECT tbltienda.nombre, tbltienda.descripcionubicacion , tblpersona.celular
       FROM tbltienda INNER JOIN tblpersona ON tblpersona.IdPersona = tbltienda.IdPersona");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);

      $arreglo['data']= $sql->fetchAll();
      echo json_encode($arreglo);

      header('Content-Type: application/json');
      header("HTTP/1.1 200 OK");

      exit();
}

header("HTTP/1.1 400 Bad Request");

?>