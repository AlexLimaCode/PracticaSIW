
<?php
include('conexion.php');

    function LlenaComboSaltado($Sql,$descripcion,$valor){
        include('conexion.php');
        $result = mysqli_query($conn,$Sql);
        if (mysqli_num_rows($result)>0){
            $i=0;
            $j=0;
            echo"<select class='form-select' aria-label='Default select example' name='$valor'>";
              while ($row=mysqli_fetch_row($result)){
                if($row[$i]==$descripcion){
                    echo "<Option selected value=".$row[0].">$row[1]";
                }else{
                    echo "<Option value=".$row[0].">$row[1]";
                }
                $j++;	
            }
            echo"</select>";
            mysqli_free_result($result);
        }else{
            echo"<h4>NO HAY RESULTADOS DISPONIBLES</h4>";
        }
            
                
    }

    function LlenaChecks($Sql){
        include("conexion.php");
        $result = mysqli_query($conn,$Sql);
        if (mysqli_num_rows($result)>0){
            while ($row=mysqli_fetch_row($result)){
                echo "<div class='form-check'>";
                echo "<input type='checkbox' class='form-check-input' name='chk[]' value=".$row[0]." id=".$row[0]." checked>";
                echo "<label class='form-check-label'  for=".$row[0]." >".$row[1]."</label>";
                echo "</div>";
            }
        }else{
            echo"<h4>NO HAY RESULTADOS DISPONIBLES</h4>";
        }
        
    }
    function LlenaChecksMarcado($Sql, $arreglo){
        include("conexion.php");
        $bandera = 0;
        $result = mysqli_query($conn,$Sql);
        if (mysqli_num_rows($result)>0){
            while ($row=mysqli_fetch_row($result)){
                echo "<div class='form-check'>";
                for ($i=0; $i < count($arreglo); $i++) { 
                    if ($arreglo[$i] == $row[0]) {
                        $bandera = 1;
                    }
                }
                if ($bandera==1) {
                    echo "<input type='checkbox' class='form-check-input' name='chk[]' value=".$row[0]." id=".$row[0]." checked>";
                    $bandera = 0;
                }else{
                    echo "<input type='checkbox' class='form-check-input' name='chk[]' value=".$row[0]." id=".$row[0].">";
                }
                echo "<label class='form-check-label'  for=".$row[0]." >".$row[1]."</label>";
                echo "</div>";
            }
        }else{
            echo"<h4>NO HAY RESULTADOS DISPONIBLES</h4>";
        }
        
    }

    function llenaTabla(){
        include("conexion.php");
        $query = "select IdEquipo from equipos order by IdEquipo asc";
        $result = mysqli_query($conn,$query);
        if (mysqli_num_rows($result)>0){
            echo"<table class='table'><thead><tr><th scope='col'>Nombre</th><th scope='col'>Descripcion</th><th scope='col'>Estado</th><th scope='col'>Talleres</th></tr></thead><tbody>";
            while ($row=mysqli_fetch_row($result)){
                $query2 = "select Nombre, t.Descripcion, e.Descripcion from equipos t, estado e where t.IdEstado = e.IdEstado and IdEquipo = ".$row[0];
                $result2 = mysqli_query($conn,$query2);
                if (mysqli_num_rows($result2)>0){
                    while ($row2=mysqli_fetch_row($result2)){
                        echo "<tr>";
                        echo"<th scope='row'>".$row2[0]."</th>";
                        echo"<th scope='row'>".$row2[1]."</th>";
                        echo"<th scope='row'>".$row2[2]."</th>";
                        echo"<th scope='row'>";
                        $query3 = "select t.Descripcion from taller t, equipotaller e, equipos f where e.IdEquipo = f.IdEquipo and t.IdTaller = e.IdTaller and e.IdEquipo = ".$row[0];
                        $result3 = mysqli_query($conn,$query3);
                        if (mysqli_num_rows($result3)>0){
                            while ($row3=mysqli_fetch_row($result3)){
                                echo $row3[0]." | ";
                            }
                        }
                        echo "</th>";
                        echo "</tr>";
                    }
                }
            }
            echo "</tbody></table>";
        }else{
            echo"SIN REGISTROS";
        }
        
    }
?>