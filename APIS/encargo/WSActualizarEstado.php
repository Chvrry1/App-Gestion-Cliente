<?php
    require "../conexion/Conexionn.php";
    require "../conexion/Config.php";

    $dbConn = conexion($db);
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $input = $_GET;
        $postId = $input['id'];
        $estado = $input['estado'];

        $statement = $dbConn->prepare("UPDATE tblpedido SET tblpedido.IdEstadoPedido = :IdEstadoPedido WHERE tblpedido.IdPedido= :IdPedido");
        $statement->bindParam(':IdEstadoPedido', $estado, PDO::PARAM_INT);
        $statement->bindParam(':IdPedido', $postId, PDO::PARAM_INT);
        $result = $statement->execute();
        $result = $statement->rowCount();

        //$results = $statement->fetchAll(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");

        if ($result) {
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

    header("HTTP/1.1 400 Bad Request");
?>
