<?php
include 'conexion.php';  
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['idusuario'])) {
        $c_idusuario = $_GET['idusuario'];
        if ($stmt = $conexion->prepare("CALL consultarUsuario(?)")) {
            $stmt->bind_param('s', $c_idusuario);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();  
                if ($resultado->num_rows > 0) {
                    $json = array();
                    while ($fila = $resultado->fetch_assoc()) {
                        $result["nombres"] = $fila['nombres'];
                        $result["ubicacion"] = $fila['descripcion'];
                        $json['consulta'][] = $result;
                    }
                    echo json_encode($json);
                } else {
                    echo json_encode(['error' => 'No se encontró el usuario.']);
                }
            } else {
                echo json_encode(['error' => 'Error en la ejecución de la consulta: ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['error' => 'Error al preparar la consulta: ' . $conexion->error]);
        }
    } else {
        echo json_encode(['error' => 'No se proporcionó el parámetro requerido idusuario.']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido. Se requiere una solicitud GET.']);
}

$conexion->close();
?>
