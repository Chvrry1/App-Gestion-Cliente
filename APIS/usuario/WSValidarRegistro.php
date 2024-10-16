<?php
    require "../conexion/Conexion.php";
    require "../conexion/Config.php";

    $dbConn = conexion($db);

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        if (isset($_GET['identificacion']) && isset($_GET['email']) && isset($_GET['celular']) && isset($_GET['usuario']))
        {
            if(!empty($_GET['identificacion']) || !empty($_GET['email']) || !empty($_GET['celular']) || !empty($_GET['usuario'])){
                $sql = $dbConn->prepare("CALL spUsuarioValidarRegistro(:identificacion, :email, :celular, :usuario, @EXISTS_ID, @EXISTS_MAIL, @EXISTS_CELULAR, @EXISTS_USUARIO)");
                $sql->bindValue(':identificacion', $_GET['identificacion']);
                $sql->bindValue(':email', $_GET['email']);
                $sql->bindValue(':celular', $_GET['celular']);
                $sql->bindValue(':usuario', $_GET['usuario']);
                $sql->execute();
                $sql->closeCursor();
                
                //construir query para obtener valores de retorno.
                $query = "SELECT";
                if(!empty($_GET['identificacion'])){
                    $query = $query . "@EXISTS_ID AS id,";
                }
                if(!empty($_GET['email'])){
                    $query = $query . "@EXISTS_MAIL AS correo,";
                }
                if(!empty($_GET['celular'])){
                    $query = $query . "@EXISTS_CELULAR AS celular,";
                }
                if(!empty($_GET['usuario'])){
                    $query = $query . "@EXISTS_USUARIO AS usuario,";
                }

                //remover ultima coma
                $query = rtrim($query,',');
    
                $row = $dbConn->query($query)->fetch(PDO::FETCH_ASSOC);
    
                $items =  [];
                /**
                 * convertir de String a Int si existe el parametro-
                 */
                if(array_key_exists('id', $row)){
                    $items['id'] = intval($row['id'] );
                }

                if(array_key_exists('correo', $row)){
                    $items['correo'] = intval($row['correo'] );
                }

                if(array_key_exists('celular', $row)){
                    $items['celular'] = intval($row['celular'] );
                }

                if(array_key_exists('usuario', $row)){
                    $items['usuario'] = intval($row['usuario'] );
                }

                $arreglo['data']= $items;
                $arreglo['estatus'] = 200;
                echo json_encode($arreglo);
    
                header('Content-Type: application/json');
                header("HTTP/1.1 200 OK");
                
                exit();
            }else{
                echo ("¡Faltan datos!");
            }
           
        }else{
            echo ("¡Faltan parametros!");
        }
    }else{
        echo ("Metodo no permitido, es GET");
    }

    header("HTTP/1.1 400 Bad Request");

?>