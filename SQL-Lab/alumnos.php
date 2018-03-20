<html>
	<head>
		<meta http-equiv="Content-Type" content="text/php charset=utf-8"/>
		<link href="css/index.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<?php //include("\bbdd_config.php"); ?>
		<title>SQLab</title>
	</head>	
	<body>
		<!--<img id="fondo" src="img/imagen.jpg"  />-->
		<div class="container-fluid">
			<?php include("\inc_header.php"); ?>
	
			<div id="cuerpo">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<div class="saludo">
							<h2>Bienvenido <?php include("\bbdd_config.php"); 
								
							?></h2>
						</div>			
						<div class="tabla_opciones">
							<div class="row">
								<div class="col-md-6">
									<div class="opcion">
										<div class="row">
											<div class="col-md-4">
												<div class="ico">ICONO</div>
											</div>
											<div class="col-md-8">
												<h3>Hoja de ejercicios</h3>
											</div>
										</div>
									</div>
								</div>
								
								<div class=" col-md-6">
									<div class="opcion">
										<div class="row">
											<div class="col-md-4">
												<div class="ico">ICONO</div>
											</div>
											<div class="col-md-8">
												<h3>Ejercicios</h3>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="opcion">
										<div class="row">
											<div class="col-md-4">
												<div class="ico">ICONO</div>
											</div>
											<div class="col-md-8">
												<h3>Mi perfil</h3>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="opcion">
										<div class="row">
											<div class="col-md-4">
												<div class="ico">ICONO</div>
											</div>
											<div class="col-md-8">
												<h3>Estadisticas</h3>
											</div>
										</div>
									</div>
								</div>
								</div>							
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

