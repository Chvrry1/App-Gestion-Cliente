<?PHP
$hostname_localhost="40.124.84.125";
$database_localhost="dbencargalo";
$username_localhost="uroot";
$password_localhost="encargalo";

$json = array();

        $conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
        
        $consulta = "CALL sp_muestraTiendas('FARMACIA')";
        $resultado = mysqli_query($conexion,$consulta);

        while($registro=mysqli_fetch_array($resultado)){
        
            $result["IdTienda"]=$registro['IdTienda'];
            $result["nombre"]=$registro['nombre'];
            $result["foto"]=$registro['foto'];
            $result["calificacion"]=$registro['calificacion'];
            $result["descripcionubicacion"]=$registro['descripcionubicacion'];
            $json['tiendas'][]=$result;

        }
        mysqli_close($conexion);
        echo json_encode($json);
        
?>