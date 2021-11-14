<?php

    include('conexion.php');
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $IdEquipo = $_POST['IdEquipo'];
    $estado = $_POST['estado'];
    $arreglo = $_POST['chk'];

    $query = "update equipos set nombre='".$nombre."', descripcion='".$descripcion."', IdEstado='".$estado."' where IdEquipo='".$IdEquipo."'";
    echo $query;
    $result = mysqli_query($conn,$query);
    
    $query = "delete from equipotaller where IdEquipo='".$IdEquipo."'";
    echo $query;
    $result = mysqli_query($conn,$query);

    for ($i=0; $i < count($arreglo); $i++) {
        $query = "insert into equipotaller (IdEquipo, IdTaller) values ('".$IdEquipo."','".$arreglo[$i]."')";
        $result = mysqli_query($conn, $query);
    }
    
    header('location:index.php');

?>