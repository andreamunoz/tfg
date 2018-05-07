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
?>
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
			<h3 class="text-center" >PERFIL DEL ALUMNO</h3>
			<div class="hrr mb-2"></div>
			<?php 
				include_once '../inc/usuario.php';
				$ejer = new Usuario();
				$result = $ejer->getAllDatosUser("p@p.es");
				while($fila = mysqli_fetch_array($result)){
			?>
  			<form class="jumbotron-propio ">
				<div class="form-row pt-4">
					<div class="form-group col-md-3 pl-4">
						<label for="name" "><strong>Nombre </strong></label>		
					</div>
					<div class="form-group col-md-3 ">
						<p> <?php echo $fila['nombre']; ?> </p>
					</div>
					<div class="form-group col-md-1 offset-5">
						<a class="icon_edit" id="edit" href="#">Editar</a>
					</div>
						
				</div>
				<div class="hrg"></div>
				<div class="form-row">	
					<div class="form-group col-md-3 pl-4">
						<label for="name" "><strong>Nombre de usuario </strong></label>	
					
					</div>
					<div class="form-group col-md-3 ">
						<p> <?php echo $fila['user']; ?> </p>
					</div>
					<div class="form-group col-md-1 offset-5">
						<a class="icon_edit" id="edit" href="#">Editar</a>
					</div>	
				</div>
				<div class="hrg"></div>
				<div class="form-row">
					<div class="form-group col-md-3 pl-4">
						<label for="name" "><strong>Email </strong></label>
					</div>
					<div class="form-group col-md-3 ">
						<p> <?php echo $fila['email']; ?> </p>
					</div>
					<div class="form-group col-md-1 offset-5">
						<a class="icon_edit" id="edit" href="#">Editar</a>
					</div>
				</div>
				<div class="hrg"></div>
				<div class="form-row">
					<div class="form-group col-md-3 pl-4">
						<label for="name" "><strong> Contraseña</strong></label>	
						
					</div>
					<div class="form-group col-md-3 ">
						<p> <?php echo $fila['password']; ?> </p>
					</div>
					<div class="form-group col-md-1 offset-5">
						<a class="icon_edit" id="edit" href="#">Editar</a>
					</div>
				</div>
				<div class="hrg"></div>
				<div class="form-row">
					<div class="form-group col-md-3 pl-4">
						<label for="name" "><strong>Autorizo </strong></label>		
					</div>
					<div class="form-group col-md-3 ">
						<?php if( $fila['autoriza'] == "1"){ ?>
						<p> Sí</p>
						<?php } else if( $fila['autoriza'] == "0"){?>
						<p> No</p>
						<?php } } ?>
					</div>
					<div class="form-group col-md-1 offset-5">
						<a class="icon_edit" id="edit" href="#">Editar</a>
					</div>
				</div>
				<div class="hrg"></div>
		  		<div class="form-row pt-4">	
					<div class="form-group col-md-3 offset-9 ">
						<button class="btn btn-log btn-tertiary btn-block" type="submit" >Guardar Cambios</button>
					</div>
		  		</div>
	  		</form>	
		</div>
	</body>
</html>