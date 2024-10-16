<?php
    require "../conexion/Conexion.php";
    require "../conexion/Config.php";

    $dbConn = conexion($db);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $sql = $dbConn->prepare("CALL spUsuarioActualizarCelular(:IdPersona,:celular)");
        $sql->bindValue(':IdPersona', $_GET['IdPersona']);
        $sql->bindValue(':celular', $_GET['celular']);
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

    header("HTTP/1.1 400 Bad Request");
?>
