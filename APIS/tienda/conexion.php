<?php
$hostname='localhost';
$username ='root';
$password='1234';
$database ='dbencargalo';

$conexion = mysqli_connect($hostname,$username,$password,$database);

if( mysqli_connect_errno() ){
    echo "Conexion fallida: " . mysqli_connect_error();
}
?>