<?php
    require "../conexion/Conexionn.php";
    require "../conexion/Config.php";

    $dbConn = conexion($db);
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $input = $_GET;
        $postId = $input['id'];

        // Preparar la consulta para buscar el pedido por Id
        $statement = $dbConn->prepare("SELECT * FROM tblpedido WHERE tblpedido.IdPedido = :IdPedido");
        $statement->bindParam(':IdPedido', $postId, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');

        // Verificar si se encontró el pedido
        if ($result) {
            echo json_encode($result); // Devolver el resultado del pedido en formato JSON
            header("HTTP/1.1 200 OK");
        } else {
            // Si no se encontró el pedido
            $arreglo['data'] = 'Pedido no encontrado';
            $arreglo['estatus'] = 404;
            echo json_encode($arreglo);
            header("HTTP/1.1 404 Not Found");
        }

        exit();
    }

    header("HTTP/1.1 400 Bad Request");
?>
