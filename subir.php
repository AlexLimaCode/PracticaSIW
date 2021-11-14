<?php

include('conexion.php');

$arreglo = $_POST['chk'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$estado = $_POST['estado'];
$IdEquipo = 0;
$query = "insert into equipos (Nombre, Descripcion, IdEstado) values ('".$nombre."','".$descripcion."','".$estado."')";
$result = mysqli_query($conn, $query);

$query = "select IdEquipo from equipos order by IdEstado desc limit 1";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result)>0){
    while ($row=mysqli_fetch_row($result)){
        $IdEquipo = $row[0];
    }
}

for ($i=0; $i < count($arreglo); $i++) {
    echo "valor = ".$arreglo[$i];
    $query = "insert into equipotaller (IdEquipo, IdTaller) values ('".$IdEquipo."','".$arreglo[$i]."')";
    $result = mysqli_query($conn, $query);
}

header('location:index.php');


?>