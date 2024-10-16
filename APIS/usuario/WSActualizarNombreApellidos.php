<?php
    require "../conexion/Conexion.php";
    require "../conexion/Config.php";

    $dbConn = conexion($db);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input = $_GET;
        $sql = $dbConn->prepare("CALL spUsuarioActualizarNombreApelidos(:IdPersona, :nombre, :primerApellido,:segundoApellido)");

        $sql->bindParam(':IdPersona', $_GET['IdPersona']);
        $sql->bindParam(':nombre', $_GET['nombre']);
        $sql->bindParam(':primerApellido', $_GET['primerApellido']);
        $sql->bindParam(':segundoApellido', $_GET['segundoApellido']);
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
