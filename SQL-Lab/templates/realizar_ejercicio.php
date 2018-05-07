<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/php charset=utf-8"/>
		<link href="../css/prueba.css" rel="stylesheet" type="text/css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	

	    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	    <script defer src="https://use.fontawesome.com/releases/[VERSION]/js/all.js"></script>
  		<script defer src="https://use.fontawesome.com/releases/[VERSION]/js/v4-shims.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

		<title>SQLab</title>
	</head>	
	<body>
		<?php include("modals/modals_cerrar_sesion.php"); ?>
		<?php include("navbar/navbar_menu_alumno.php"); ?>
		<div class="container pt-4">
			<h3 class="text-center" >REALIZAR EJERCICIO</h3>
			<div class="hrr mb-3"></div>
        <?php 
              include_once '../inc/ejercicio.php';
              $ejer = new Ejercicio();
              $ejerparameter = $_GET['ejercicio'];
              $result = $ejer->getEjercicio($ejerparameter);
              while($fila = mysqli_fetch_array($result)){
        ?>		
  			<div class="row pt-1">  
  				<div class="col-md-3">
  					<p>Nombre: <?php echo $fila['nombre'] ?></p> 
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
  			<div class="row pt-1">
  				<div class="col-md-6">
  					<p>Enunciado: <?php echo $fila['enunciado'] ?></p> 
  				</div>

  				<div class="col-md-6"> 
  					<textarea  id="solucion" name="sol_ejercicio" class="form-control" rows="18" placeholder="Escribe la solución aquí..." required></textarea>
  				</div>
          <?php } ?>
  			</div> 	
		</div>
	</body>
</html>