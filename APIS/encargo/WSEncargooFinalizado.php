<?php
    require "../conexion/Conexionn.php";
    require "../conexion/Config.php";

    $dbConn = conexion($db);
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $sql = $dbConn->prepare("CALL spEncargoFinalizado(:IdRepartidor,:IdPedido)");
        $sql->bindValue(':IdRepartidor', $_GET['IdRepartidor']);
        $sql->bindValue(':IdPedido', $_GET['IdPedido']);
        $sql->execute();


        if ($sql) {
            $arreglo['data'] = 'Actualizado';
            $arreglo['estatus'] = 200;
        } else {
            $arreglo['data'] = 'No actualizado';
            $arreglo['estatus'] = 204;
        }

        echo json_encode($arreglo);

        header('Content-Type: application/json');
        header("HTTP/1.1 200 OK");
        exit();
    }
	echo mysqli_error($dbConn);
    header("HTTP/1.1 400 Bad Request");
?>
