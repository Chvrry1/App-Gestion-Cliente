<?php
    require "../conexion/Conexion.php";
    require "../conexion/Config.php";

    $dbConn = conexion($db);

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        if (isset($_GET['usuario']))
        {
            $sql = $dbConn->prepare("CALL spUsuarioIniciarSesion(:usuario)");
            $sql->bindValue(':usuario', $_GET['usuario']);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $result = $sql->fetch();

            if($result){
                $arreglo['data']= $result;
                $arreglo['estatus'] = 200;
            }else{
                $arreglo['data'] = '';
                $arreglo['estatus'] = 204;
            }

            echo json_encode($arreglo);

            header('Content-Type: application/json');
            header("HTTP/1.1 200 OK");
            
            exit();
            
        }else{  
            echo ("¡Faltan datos!");
        }
    }else{
        echo ("Metodo no permitido, es GET");
    }

    header("HTTP/1.1 400 Bad Request");

?>