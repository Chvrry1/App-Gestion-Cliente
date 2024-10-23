<?php
    require "../conexion/Conexionn.php";
    require "../conexion/Config.php";

    $dbConn = conexion($db);
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $sql = $dbConn->prepare("CALL spObtenerUbicacionEntrega(:IdPedido)");
        
        $sql->bindValue(':IdPedido', $_GET['IdPedido']);
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
