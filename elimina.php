<?php
    include('conexion.php');
    include('funciones.php');

    $IdEquipo = $_POST['IdEquipo'];

    $query = "delete from equipotaller where IdEquipo='".$IdEquipo."'";
    $result = mysqli_query($conn,$query);
    $query = "delete from equipos where IdEquipo = '$IdEquipo'";
    $result = mysqli_query($conn, $query);
    
    header('location:index.php');


?>