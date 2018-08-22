<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>

<div class="container pt-4">
    <h2><strong>Realizar Ejercicio</strong></h2>
    <div class="hrr mb-3"></div>
    <?php
    include_once '../inc/ejercicio.php';
    $ejer = new Ejercicio();
    $ejerparameter = $_GET['exercise'];

    $result = $ejer->getEjercicioById($ejerparameter);
    $fila = mysqli_fetch_array($result)
    ?>		
    <div class="row pt-1">  
        <div class="col-md-3">
            <p>Nombre: <?php echo 'Ejercicio ' . $fila['id_ejercicio'] ?></p> 
        </div>
        <div class="col-md-3"> 
            <p>Categoria: <?php echo $fila['tipo'] ?></p>
        </div>
        <div class="col-md-3"> 
            <p>Nivel: <?php echo $fila['nivel'] ?></p>

        </div>
        <div class="col-md-3"> 
            <p>Intentos: </p>
        </div>
    </div>
    <?php echo '<form action="../handler/validate_exercise.php?exercise=' . $fila['id_ejercicio'] . '" method="post">' ?>
    <div class="row pt-1">
        <div class="col-md-6">
            <p>Enunciado: <?php echo $fila['enunciado'] ?></p> 
        </div>
        <div class="col-md-6"> 
            <textarea  id="solucion" name="sol_ejercicio" class="form-control" rows="18" placeholder="Escribe la solución aquí..." required></textarea>
        </div>
    </div> 
    <div class="row pt-1">
        <button type="submit" id="alert-sol" class="btn btn-primary ">Comprobar</button>
    </div>
    <?php
    if (isset($_SESSION['msg_solucion'])) {
        echo $_SESSION['msg_solucion'];
        unset($_SESSION['msg_solucion']);
    }
    ?>
    

</form>
</div>
<script>
        $('#modalSolucion').removeClass('show');
        /*$(document).ready(function () {
            setTimeout("$('div').removeClass('show');", 5000);
        });*/
    </script>
<?php include("footer.php"); ?>


