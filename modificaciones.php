<?php
    include('conexion.php');
    include('funciones.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Bienvenido</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">SIW</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="altas.php">Alta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bajas.php">Bajas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="modificaciones.php">Modificaciones</a>
                </li>
            </ul>
            </div>
        </div>
    </nav> 
    <br><br>
    <div class="container">
        <div class="text-center">
            <?php

            $IdEquipo = "";
            if(isset($_POST["IdEquipo"])){
                $IdEquipo = trim($_POST["IdEquipo"]); 
                if ($IdEquipo == ""){
                    if(isset($_GET["IdEquipo"])){
                        $IdEquipo = $_GET["IdEquipo"];
                        if ($IdEquipo == ""){
                            $IdEquipo = "";
                        }
                    }
                }
            }    
            else{ 
                if ($IdEquipo == ""){
                    $IdEquipo = "";
                }
                if(isset($_GET["IdEquipo"])){ 
                    $IdEquipo = $_GET["IdEquipo"];
                    if ($IdEquipo == ""){
                        $IdEquipo = "";
                    }
                }    
            }

            if ($IdEquipo == "") {
                ?>
                <form action="modificaciones.php" method="post">
                    <?php
                        LlenaComboSaltado("select IdEquipo, Nombre from equipos","algo", "IdEquipo");
                    ?>
                    <br>
                    <button class='btn btn-primary' type='submit' href='modificaciones.php'>Seleccionar</button>
                </form>
                <?php
            }else{
                $nombre = "";
                $estado = "";
                $descripcion = "";
                $arreglo = [];
                $query = "select Nombre, e.Descripcion, t.Descripcion from equipos e, estado t where IdEquipo = ".$IdEquipo;
                $result = mysqli_query($conn,$query);
                if (mysqli_num_rows($result)>0){
                    while ($row=mysqli_fetch_row($result)){
                        $nombre = $row[0];
                        $estado = $row[2];
                        $descripcion = $row[1];
                    }
                }
                $query = "select t.IdTaller from taller t, equipotaller e, equipos f where e.IdEquipo = f.IdEquipo and t.IdTaller = e.IdTaller and e.IdEquipo = ".$IdEquipo;
                $result = mysqli_query($conn,$query);
                if (mysqli_num_rows($result)>0){
                    while ($row=mysqli_fetch_row($result)){
                        array_push($arreglo, $row[0]);
                    }
                }
                ?>
                    <form method='post' enctype='multipart/form-data' action='edita.php' name='principal'>
                        <div class="col-md-4">
                            <label for="validationDefault01" class="form-label" style="color:black;">Nombre del aparato</label>
                            <?php
                            echo "<input type='text' class='form-control' id='validationDefault01' name='nombre' value ='".$nombre."' required>";
                            ?>
                        </div>
                        <div class="col-md-4">
                            <label for="validationDefault02" class="form-label" style="color:black;">Descripcion</label>
                            <?php
                            echo "<input type='text' class='form-control' id='validationDefault02' name='descripcion' value='".$descripcion."' required>";
                            ?>
                        </div>
                        <br>
                        <div class="col-md-4">
                        <label for="validationDefault02" class="form-label" style="color:black;">Selecciona el estado del aparato</label>
                        <?php
                            LlenaComboSaltado("select IdEstado, Descripcion from estado",$estado,"estado");
                        ?>
                        </div>
                        <div class="col-md-4">
                            <label for="validationDefault02" class="form-label" style="color:black;">Selecciona el taller del aparato</label>
                            <div class="mb-3 form-check">
                            <?php
                                LlenaChecksMarcado("select IdTaller, Descripcion from taller", $arreglo);
                            ?>
                            </div>
                        </div>
                        <?php echo"<input type='hidden' name='IdEquipo' value=".$IdEquipo.">"   ?>
                        <button class='btn btn-primary' type='submit' href='edita.php'>Subir</button>
                    </form>
                <?php
            }
            ?>
            
        </div>
    </div>
</body>
</html>