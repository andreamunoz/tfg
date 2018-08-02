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
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

				<div class="adm-tablas">
					<div class="row ">
						<div class="col-md-11 adjuntar-tablas">	

							<h3><?php echo trad( "Añadir Datos", $lang) ?></h3>
							<p class="pl-5"><?php echo trad( "Introduzca el código para crear las tablas e introducir los datos. Sólo se permiten las sentencias CREATE TABLE, INSERT INTO, DROP TABLE y ALTER TABLE.", $lang) ?></p>
							<div class="hrr"></div>
							<div class="form-row pt-4 ">
								<div class="form-group col-md-12 pl-4">
								<form class="jumbotron-propio" method="post" action="../handler/crear_tablas_texto.php">
									<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="enunciado"><?php echo trad( "Inserte el código aquí", $lang) ?></label>
										</div>	
										<div class="panel-footer" >
					  						<?php
					  							if (isset($_SESSION['guardarDatosTablas'])){ ?>
												<textarea  id="crea_tabla" name="crea_tabla" class="form-control" rows="10" placeholder="<?php echo trad( "CREATE TABLE coches...", $lang) ?>" required><?php echo $_SESSION['guardarDatosTablas']; ?></textarea>
					  						<?php } else { ?> 
												<textarea  id="crea_tabla" name="crea_tabla" class="form-control" rows="10" placeholder="<?php echo trad( "CREATE TABLE coches...", $lang) ?>" required></textarea>
					  						<?php } ?>
					  					</div>
					  					
					  				</div>	
						  			<div class="form-group col-md-3 offset-9 pr-4">
										<button class="btn btn-log btn-tertiary btn-block" type="submit"><?php echo trad( "Ejecutar", $lang) ?></button>
									</div>
								</form>
								<!-- <div class="hrr mb-4"></div> -->
								<!-- <form class="jumbotron-propio" method="post" action="../handler/crear_tablas_fichero.php" enctype="multipart/form-data">
									<div class="panel panel-primary">
				                        <p><?php // echo trad( "Seleccione un fichero con el código para crear las tablas e introducir en ellas los datos. ", $lang) ?></p>	
										<div class="input-group">
									  		<div class="custom-file">
									    		<input type="file" name="fileToUpload" id="fileToUpload" value=<?php // echo trad( "Examinar...", $lang) ?>>
									  		</div>
									  		<div class="input-group-append">
									    		<input type="submit" class="btn btn-outline-secondary" name="submit" value=<?php // echo trad( "Adjuntar", $lang) ?>>
									  		</div>	
										</div>
					  				</div>
					  			</form> -->
								<br><br><br>
								</div>				
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>
	<script type="text/javascript" src="../js/functions.js"></script>
	</body>
	<footer class="footer py-3 text-center">
		<span>© 2018</span> <a id="pie" href="index_profesor.php">SQLab</a> 
		
	</footer>
</html>