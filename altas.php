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
                    <a class="nav-link" href="#">Alta</a>
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

    <div class="container">
        <div class="text-center">
            <h1>Bienvenido, llena los campos</h1>
            <br><br>
            <form method='post' enctype='multipart/form-data' action='subir.php' name='principal'>
                <div class="col-md-4">
                    <label for="validationDefault01" class="form-label" style="color:black;">Nombre del aparato</label>
                    <input type="text" class="form-control" id="validationDefault01" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="col-md-4">
                    <label for="validationDefault02" class="form-label" style="color:black;">Descripcion</label>
                    <textarea type="text" class="form-control" id="validationDefault02" name="descripcion" placeholder="Descripcion" required></textarea>
                </div>
                <br>
                <div class="col-md-4">
                <label for="validationDefault02" class="form-label" style="color:black;">Selecciona el estado del aparato</label>
                <?php
                    LlenaComboSaltado("select IdEstado, Descripcion from estado","algo","estado");
                ?>
                </div>
                <div class="col-md-4">
                    <label for="validationDefault02" class="form-label" style="color:black;">Selecciona el taller del aparato</label>
                    <div class="mb-3 form-check">
                    <?php
                        LlenaChecks("select IdTaller, Descripcion from taller");
                    ?>
                    </div>
                </div>
                <button class='btn btn-primary' type='submit' href='subir.php'>Subir</button>
            </form>
        </div>
    </div>
</body>
</html>