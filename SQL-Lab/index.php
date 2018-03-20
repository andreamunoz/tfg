<html>
	<head>
		<meta http-equiv="Content-Type" content="text/php charset=utf-8"/>
		<link href="css/index.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<?php include("/inc/functions.php"); ?>
		<title>SQLab</title>
	</head>	
	<body>
		<!--<img id="fondo" src="img/imagen.jpg"  />-->
		<div class="container-fluid">
			<?php include("\inc_header.php"); ?>
			<?php 
				$usuarios = new Usuario();
				//print_r($usuarios->getAllInfo());
				print_r($usuarios->getRol("a@a.es"));
			?>
			<div id="cuerpo">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">			
						<div class="form_is">
							<table>
								<tr>
									<td>Usuario: </td>
								</tr>
								<tr>
									<td><input placeholder="correo electrónico" type="text" name="usuario"></td>
								</tr>
								<tr>
									<td>Contraseña: </td>
								</tr>
								<tr>
									<td><input placeholder="contraseña" type="password" name="contraseña"></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			<footer>
				Todos los derechos reservados.
			</footer>
		</div>
	</body>
</html>

