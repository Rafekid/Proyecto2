<?php

    session_start();
    echo $_SESSION['username'];
    $usuario2 = $_SESSION['username'];


    if(!$usuario2){
        header("location: loginAdmin.php");
        die();
    } 

    include "conexiones/conexion.php";
    $result = $conexion->query("select count(id_transaction) as cant_trans,fecha from transaction where fecha = curdate()") or die($conexion->error());
    $row = mysqli_fetch_assoc($result);
    $cantidad = $row['cant_trans'];
    $fecha = $row['fecha'];

    

    $sql="SELECT count(id_transaction), fecha from transaction where fecha=curdate()";
    $result2=mysqli_query($conexion,$sql);
    /*Para utilizar los datos de mysql en la gráfica se debe de usar jason*/
    $valoresY=array();//cantidad
    $valoresX=array();//fecha

    while($ver=mysqli_fetch_row($result2)){
        $valoresY[]=$ver[0];
        $valoresX[]=$ver[1];
    }
    /* print_r($valoresX);
    print_r($valoresY); */

    $datosY=json_encode($valoresY);
    $datosX=json_encode($valoresX);
?>

<!DOCTYPE html>
<html lang="en">
<?php include "layouts/headAdmin.php";?>
<body>
    <div class="alert alert-success" role="alert">
    Bienvenido al portal de Administrador <?php echo $usuario2?></div>
    
        <div class="contenedor">

            <div class="sidebar">
                <h2>MENÚ</h2>
                <ul>
                    <li><a href="adminPanel.php">Panel Administrador</a></li>
                    <li><a href="logica/cerrarSessionAdmin.php">Cerrar Sesión</a></li>
                    <li><a href="logica/cerrarSistema.php">Cerrar Sistema</a></li>    
                </ul>
            </div>
            
            <div class="contenido">
                <div class="alert alert-success" role="alert">
                Cantidad de Transacciones del  <?php echo $fecha;?> : <?php echo $cantidad;?></div>
                
                
                <div id="graficaBarras" style="width:600px;height:250px;"></div>

            </div>
        </div>
  
</body>
</html>
<script>
    function crearCadenaLineal(json){
        var parsed = JSON.parse(json);
        var arr = [];
        for(var x in parsed){
            arr.push(parsed[x]);
        }
        return arr;
    }
</script>

<script>

    datosY=crearCadenaLineal('<?php echo $datosY?>');
    datosX=crearCadenaLineal('<?php echo $datosX?>');

    var data = [
  {
    x: datosX,
    y: datosY,
    type: 'bar'
  }
];

Plotly.newPlot('graficaBarras', data);
</script>