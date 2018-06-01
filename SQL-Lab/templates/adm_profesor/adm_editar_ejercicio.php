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
			<div class="col-md-12 editar-ejercicio" >
			
				<form class="jumbotron-propio" id="longSelect" method="post" action="../../handler/editar_ejercicio.php">
					<h3><?php echo trad( "Editar Ejercicio", $lang) ?></h3>
					<p class="pl-5"><?php echo trad( "Podrás editar algunos campos del ejercicio", $lang) ?>.</p>
					<div class="hrr"></div>
											
						<?php 
							if(isset($_SESSION['editar'])){
								$id = $_SESSION['editar'];

								include_once '../../inc/ejercicio.php';
								$ejer = new Ejercicio();
								$resul = $ejer->getEjercicioById($id);
								$row = mysqli_fetch_array($resul, MYSQLI_NUM);
								var_dump($row);
								// $raw = mysqli_fetch_array($resul, MYSQLI_ASSOC);
								// var_dump($raw);
								$tablasUsa = $ejer->getTablasUsa($id);						
						 ?>
							<div class="pt-4"><p>Datos permanentes del ejercicio: Nombre, propietario de las tablas y tablas usadas. </p></div>
							<div class="form-row pt-4 ">
								<!-- <div class="form-group col-md-4">
									<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="name">Nombre</label>	
										</div>
										<div class="panel-footer">
											<table id="nombre" class="form-control" >
					  							<tbody>
					  							<?php 
					  								echo "<tr><td>Ejercicio ".$row[0]."</td></tr>";
					  							?>		
					  							</tbody>
					  						</table>
					  					</div>
					  				</div>
								</div> -->
								<div class="form-group col-md-4">
					  				<div class="panel panel-primary">
				                        <div class="panel-heading">
					  						<label for="duenoOld"><?php echo trad('Propietario tablas actual',$lang) ?></label>	
					  					</div>
					  					<div class="panel-footer user_tablas" >
					  						<table id="dueno" class="form-control" >
					  							<tbody>
					  							<?php 
					  								echo "<tr><td>".$row[7]."</td></tr>";
					  							?>		
					  							</tbody>
					  						</table>
					  										  				
					  					</div>
					  				</div>
					  			</div>
					  			<div class="form-group col-md-4">
					  				<div class="panel panel-primary">
				                        <div class="panel-heading">
					  						<label for="tablasOld"><?php echo trad('Tablas usadas actual',$lang) ?></label>	
					  					</div>
					  					<div class="panel-footer columnas-tabla" >
					  						<table id="columnas" class="form-control" >
					  							<tbody>
					  							<?php foreach ($tablasUsa as $key => $value) {
					  								echo "<tr><td>".$value['nombre']."</td></tr>";
					  							} ?>		
					  							</tbody>
					  						</table>
					  										  				
					  					</div>
					  				</div>
					  			</div>
							</div>
					  		<div class="pt-4"><p>Datos que se pueden modificar: Categoría, nivel, estado, descripcion y solución. </p></div>
					  		<div class="form-row pt-2 ">
					  			<div class="form-group col-md-4">
					  				<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="categoria"><?php echo trad('Categoría',$lang) ?></label>
										</div>	
										<div class="panel-footer" >
							  				<select type="text" id="categoria" name="categoria" class="form-control" required>
							  					<?php 
							  						$ejer = new Ejercicio();
											        $resultado = $ejer->getCategorias();
												    foreach ($resultado as $key => $value) { 
												    	$newKey = "c".($key+1);
												    	if($value === $row[5]){ ?>
											    			<option value=<?php echo $newKey?> selected> <?php echo $value ?> </option>
												    	<?php }else{ ?>
												    		<option value=<?php echo $newKey?> > <?php echo $value ?> </option>
												    	<?php }
											    	}
											    ?> 
							  				</select>
							  			</div>
							  		</div>
								</div>
								<div class="form-group col-md-4">
					  				<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="nivel"><?php echo trad('Nivel',$lang) ?></label>
										</div>	
										<div class="panel-footer" >
							  				<select type="text" id="nivel" name="nivel" class="form-control" required>
							  					<?php if($row[1] === "facil"){ ?>
							  						<option value="facil" selected><?php echo trad('Principiante',$lang) ?></option>
							  						<option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
							  						<option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>
							  					<?php } else if($row[1] === "medio"){ ?>
							  						<option value="facil"><?php echo trad('Principiante',$lang) ?></option>
							  						<option value="medio" selected><?php echo trad('Intermedio',$lang) ?></option>
							  						<option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>			  	
							  					<?php } else if($row[1] === "medio"){ ?>
							  						<option value="facil"><?php echo trad('Principiante',$lang) ?></option>
							  						<option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
							  						<option value="dificil" selected><?php echo trad('Avanzado',$lang) ?></option>
							  					<?php } ?>
							  				</select>
							  			</div>
							  		</div>
								</div>
								<div class="form-group col-md-4">
					  				<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="deshabilitar"><?php echo trad(' Estado del ejercicio',$lang) ?></label>
										</div>	
										<div class="panel-footer" >
							  				<select type="text" id="deshabilitar" name="deshabilitar" class="form-control" required>
							  					<?php if($row[4] === "0"){ ?>
							  						<option value="0" selected><?php echo trad('Habilitado',$lang) ?></option>
							  						<option value="1"><?php echo trad('Deshabilitado',$lang) ?></option>
							  					<?php } else { ?>
							  						<option value="0"><?php echo trad('Habilitado',$lang) ?></option>
							  						<option value="1" selected><?php echo trad('Deshabilitado',$lang) ?></option>
							  					<?php } ?>
							  				</select>
							  			</div>
							  		</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="descripcion"><?php echo trad('Descripcion',$lang) ?></label>
										</div>	
										<div class="panel-footer" >
											<input type="text" id="descripcion" name="descripcion" class="form-control" placeholder=<?php echo trad('Descripcion breve aquí...',$lang) ?>  maxlength="50"  value="<?php echo $row[3] ?>" required />
					  					</div>
					  				</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="enunciado"><?php echo trad( "Enunciado", $lang) ?></label>
										</div>	
										<div class="panel-footer" >
					  						<textarea  id="enunciado" name="enunciado" class="form-control" rows="4" placeholder=<?php echo trad( "Escribe el enunciado aquí...", $lang) ?> required><?php echo $row[2] ?></textarea>
					  					</div>
					  				</div>
								</div>
								<div class="form-group col-md-6">
									<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="solucion"><?php echo trad( "Solución", $lang) ?></label>
										</div>	
										<div class="panel-footer" >
					  						<textarea  id="solucion" name="solucion" class="form-control" rows="4" placeholder=<?php echo trad( "Escribe la solución aquí...", $lang) ?> required> <?php echo $row[8] ?> </textarea>
					  					</div>
					  				</div>
								</div>
							</div>
					  		<div class="form-row">	
					  			<div class="form-group col-md-3">
									<button class="btn btn-log btn-tertiary-border btn-block" type="reset" onclick="location.href = '../index_profesor.php'"><?php echo trad( "Cancelar", $lang) ?></button>
								</div>
								<div class="form-group col-md-3 offset-6 pr-4">
									<button class="btn btn-log btn-tertiary btn-block" type="submit"><?php echo trad( "Guardar cambios", $lang) ?></button>
								</div>
					  		</div>
				  		<?php } 
				  		//unset($_SESSION['editar']);
				  		?>
				  	<br>
			  		<br>
			  		<br>
		  		</form>
			</div>
		</div> 
		
	<script type="text/javascript" src="../../js/functions.js"></script>
	</body>
	<footer class="footer py-3 text-center">
		© 2018 <a id="pie" href="index_profesor.php">Sqlab</a> 
		
	</footer>
</html>