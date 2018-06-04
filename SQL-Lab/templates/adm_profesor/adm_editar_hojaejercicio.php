<?php 

    require('../languages.php');
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
		<link href="../../css/prueba.css" rel="stylesheet" type="text/css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <!-- <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	 -->
	    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	    <script defer src="https://use.fontawesome.com/releases/[VERSION]/js/all.js"></script>
  		<script defer src="https://use.fontawesome.com/releases/[VERSION]/js/v4-shims.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.js" ></script>
		<title>SQLab</title>
	</head>	
	<body>

		<?php include("../modals/modals_cerrar_sesion.php"); ?>
		<?php include("../navbar/navbar_menu_profesor.php"); ?>
		<?php include("../navbar/navbar_show_message.php"); ?>
		
		<!--CONTENEDOR -->
		<div class="container mt-5"> 
		
			<div class="col-md-12 crear-hoja ">			
				<form class="jumbotron-propio" id="longSelect" method="post" action="../handler/crear_hojaejercicios.php">
					<h3>Editar Hoja de Ejercicio *******EN PROCESO*******</h3>
					<p class="pl-5">Añadir un nombre y después insertar ejercicios a la hoja.</p>
					<div class="hrr"></div>
					<?php if(isset($_SESSION['editar_hoja'])){ 
						$id_hoja = $_SESSION['editar_hoja'];

						include_once '../../inc/hoja_ejercicio.php';
						$he = new HojaEjercicio();
						$resultado = $he->getHojasYEjerciciosById($id_hoja);
						
						foreach ($resultado as $key => $value) {
							$nombre = $value["nombre_hoja"];
						}
					?>
					<div class="form-row pl-4 pr-4 pt-4">
						<div class="form-group col-md-12">
							<div class="panel panel-primary">
		                        <div class="panel-heading">
									<label for="name"> Nombre de la Hoja<span class="red"> *</span></label>
								</div>
								<div class="panel-footer">	
		  							<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required value="<?php echo $nombre ?>" />
		  						</div>
		  					</div>
						</div>
					</div>
					<div class="form-row pl-4 pr-4">
						<div class="form-group col-md-12">
							<div class="panel panel-primary">
		                        <div class="panel-heading">
									<label for="name">Lista de Ejercicios</label>
								</div>
								<div id="accordion ">
					                <div class="card">  
					                    <div class="table-responsive">  
					                     <table id="tabla_crear_hoja_ejercicios" class="table table-striped table-bordered">  
					                        <thead>
					                            <tr>
					                            	<th class="primera"></th>
					                                <th>Nombre Ejercicio</th>
					                                <th>Enunciado</th>
					                                <th>Nivel</th>
					                                <th>Tipo</th>
					                                <th>Creador</th>
					                                <th>Borrar</th>
					                          	</tr>
					                          </thead>
					                          <tbody >
					                            <?php 
					                            
					                               
					                            
					                            while($resultado = mysqli_fetch_array($result)){
					                            	
					                            ?>
					                            	
					                                <tr>
					                                	<?php echo '<td class="primera"><input type="checkbox" class="form-check-input" id="checkbox-crear-hoja" name="seleccionados[]" value='. $fila["id_ejercicio"] .'></td>'?>
					                                  	<?php echo '<td><p>Ejercicio '.$fila['id_ejercicio'].'</p></td>'; ?>
					                                  	<?php echo '<td>'.$fila['enunciado'].'</td>'; ?>
					                                  	<?php echo '<td>'.$fila['nivel'].'</td>'; ?>
					                                  	<?php echo '<td>'.$fila['tipo'].'</td>'; ?>
					                                  	<?php echo '<td>'.$fila['creador_ejercicio'].'</td>'; ?>
														<?php echo '<td></td>'?>
					                                </tr>
														
					                            <?php                                 
					                            }
					                            ?>

					                          </tbody>
					                      </table>
					                    </div>  
					                </div> 
					              </div>
		  					</div>
						</div>
					</div>
			  		<div class="form-row pr-4">	
						<div class="form-group col-md-3">
							<button class="btn btn-log btn-tertiary-border btn-block" type="reset"><a href="../templates/index_profesor.php"><?php echo trad('Cancelar',$lang) ?></a></button>
						</div>
						<div class="form-group col-md-3 offset-6 pr-4">
							<button class="btn btn-log btn-tertiary btn-block" name="crear" type="submit"><?php echo trad('Crear hoja',$lang) ?></button>
						</div>

			  		</div>
			  		<?php } ?>
		  		</form>
			  	
			</div>
		</div> 
		
	<script type="text/javascript" src="../../js/functions.js"></script>
	</body>
	<footer class="footer py-3 text-center">
		© 2018 <a id="pie" href="index_profesor.php">Sqlab</a> 
		
	</footer>
</html>