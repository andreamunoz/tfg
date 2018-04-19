<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/php charset=utf-8"/>
		<link href="css/prueba.css" rel="stylesheet" type="text/css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	
		
		<link href="cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" >
		<script src="hcdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js" ></script>


	    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	    <script defer src="https://use.fontawesome.com/releases/[VERSION]/js/all.js"></script>
  		<script defer src="https://use.fontawesome.com/releases/[VERSION]/js/v4-shims.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

  		

		<title>SQLab</title>
	</head>	
	<body>

		<?php include("navbar_menu.php"); ?>
		<?php include("menu_lateral.php"); ?>
		
		<!--CONTENEDOR -->
		<div class="container-center "> 
			<?php include("adm_hojas.php"); ?>
			<?php include("adm_ejercicios.php"); ?>
			<?php include("adm_configuracion.php"); ?>
			<?php include("adm_estadisticas.php"); ?>
		</div> 



	<script type="text/javascript" src="js/functions.js"></script>
	</body>
	<footer class="footer py-3 text-center">
		© 2018 <a id="pie" href="prueba_index.php">Sqlab</a> 
	</footer>
</html>