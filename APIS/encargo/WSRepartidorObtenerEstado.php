<?php
    require "../conexion/Conexionn.php";
    require "../conexion/Config.php";


    $dbConn = conexion($db);


if ($_SERVER['REQUEST_METHOD'] == 'GET'){


      //Mostrar lista de post

      $sql = $dbConn->prepare("CALL spRepartidorObtenerEstado(:IdRepartidor)");
      $sql->bindValue(':IdRepartidor', $_GET['IdRepartidor']);
      
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