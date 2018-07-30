<?php 

    require('languages.php');
    session_start();

    $lang = null;
    if(isset($_GET['lang'])){
      $lang = $_GET['lang'];
      $_SESSION['lang'] = $lang;
    }else{
      if(isset($_SESSION['lang'])){
        $lang = $_SESSION['lang'];
      }else{
        $_SESSION['lang'] = null;
      }
    }
    if(!isset($_SESSION['user'])){
    	header("Location: index.php");
    	exit;
    }
    header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/php charset=utf-8"/>
		<link href="../css/prueba.css" rel="stylesheet" type="text/css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <!-- <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	 -->
	    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	    <!-- <script defer src="https://use.fontawesome.com/releases/[VERSION]/js/all.js"></script> -->
  		<!-- <script defer src="https://use.fontawesome.com/releases/[VERSION]/js/v4-shims.js"></script> -->
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.js" ></script>
		<title>SQLab</title>
	</head>	
	<body>

		<?php include("modals/modals_cerrar_sesion.php"); ?>
		<?php include("navbar/navbar_menu_profesor.php"); ?>
		<div class="contenedor">
			
			<?php include("navbar/navbar_menu_lateral.php"); ?>
			<?php include("navbar/navbar_show_message.php"); ?>
			
			
			<!--CONTENEDOR -->
			<div class="container-center "> 
				<!-- <?php //include("adm_profesor/adm_principal.php"); ?> -->
				<div class="principal"> 
	
					<div class="row ">
						<div class="col-md-11 jumbotron-propio ">
							<h3 id="userPrincipal" data-name="<?php echo $_SESSION['user']; ?>">
								Bienvenid@ <?php echo $_SESSION['user']; ?> 
							</h3>
							<div class="hrr"></div>
							<h4 class="pt-4">
								En el menú lateral le mostramos todas las opciones que puede realizar.
							</h4>
							<div class="pt-5" id="avisos">
								<?php 
								include_once '../inc/usuario.php';
								$user =  $_SESSION['user'];
								$us = new Usuario();
								$mensajes = $us->getAvisosNoLeidos($user); 
								if(count($mensajes) != 0){ ?>
									<h5>AVISOS</h5>
									<?php
									for($i=0; $i<count($mensajes); $i++){
									?>

									<div class="aviso"><?php echo $mensajes[$i];?></div>
									<?php } ?>
									<div class="row">
										<div class="col-md-6 marcarLeidos" data-name="<?php echo $_SESSION['user']; ?>">Marcar estos avisos como leídos</div>
										<div class="col-md-6 mostrarTodos" data-name="<?php echo $_SESSION['user']; ?>">Mostrar todos los avisos</div>
									</div>

								<?php } ?>

							</div>
						</div>
					</div>
				</div>
				<!-- <?php //include("adm_profesor/adm_tablas.php"); ?>
				<?php //include("adm_profesor/adm_ejercicios.php"); ?>
				<?php //include("adm_profesor/adm_hojas.php"); ?>
				<?php //include("adm_profesor/adm_estadisticas.php"); ?>
				<?php //include("adm_profesor/adm_configuracion.php"); ?> -->
			</div> 
		</div>
	<script type="text/javascript" src="../js/functions.js"></script>
	</body>
	<footer class="footer py-3 text-center">
		<span>© 2018</span> <a id="pie" href="index_profesor.php">SQLab</a> 
		
	</footer>
</html>