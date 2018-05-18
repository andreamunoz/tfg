<div class="adm-tablas">
	<div class="row ">
		<div class="col-md-11 adjuntar-tablas">	

			<h3><?php echo trad( "Añadir Datos", $lang) ?></h3>
			<p class="pl-5"><?php echo trad( "Introduzca el código para crear las tablas e introducir los datos. Sólo se permiten las sentencias CREATE TABLE e INSERT INTO.", $lang) ?></p>
			<div class="hrr"></div>
			<div class="form-row pt-4 ">
				<div class="form-group col-md-12 pl-4">
				<form class="jumbotron-propio" method="post" action="../handler/crear_tablas_texto.php">
					<div class="panel panel-primary">
                        <div class="panel-heading">
							<label for="enunciado"><?php echo trad( "Inserte el código aquí", $lang) ?></label>
						</div>	
						<div class="panel-footer" >
	  						<textarea  id="crea_tabla" name="crea_tabla" class="form-control" rows="5" placeholder=<?php echo trad( "CREATE TABLE coches...", $lang) ?> ></textarea>
	  					</div>
	  					
	  				</div>	
		  			<div class="form-group col-md-3 offset-9 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" type="submit"><?php echo trad( "Guardar", $lang) ?></button>
					</div>
				</form>
				<!-- <div class="hrr mb-4"></div> -->
				<!-- <form class="jumbotron-propio" method="post" action="../handler/crear_tablas_fichero.php" enctype="multipart/form-data">
					<div class="panel panel-primary">
                        <p><?php echo trad( "Seleccione un fichero con el código para crear las tablas e introducir en ellas los datos. ", $lang) ?></p>	
						<div class="input-group">
					  		<div class="custom-file">
					    		<input type="file" name="fileToUpload" id="fileToUpload" value=<?php echo trad( "Examinar...", $lang) ?>>
					  		</div>
					  		<div class="input-group-append">
					    		<input type="submit" class="btn btn-outline-secondary" name="submit" value=<?php echo trad( "Adjuntar", $lang) ?>>
					  		</div>	
						</div>
	  				</div>
	  			</form> -->
				
				</div>				
			</div>
		</div>


		<div class="col-md-11 mostrar-tablas">
			<h3><?php echo trad( "Mostrar la estructura de las tablas", $lang) ?></h3>
			<p class="pl-5"><?php echo trad( "Seleccione una tabla y pulse el boton para obtener sus columnas.", $lang) ?></p>
			<div class="hrr"></div>
			<div class="form-row pt-4 ">
				<div class="form-group col-md-10 offset-1 pl-4 center">
				<form class="jumbotron-propio" method="post" action="../handler/obtener_columnas_tabla.php">
					<div class="panel panel-primary">
                        <div class="panel-heading">
	  						<label for="tablas"><?php echo trad('Tablas Disponibles',$lang) ?></label>	
	  					</div>
	  					<div class="panel-footer" >
	  						<select multiple type="text" id="tablas" name="tablas[]" class="form-control" required>
	  						<?php include_once '../inc/ejercicio.php';
		  						$ejer = new Ejercicio();
		  						$resultado = $ejer->getTablasDisponibles();
		  					
								while ($fila = $resultado->fetch_assoc()) {
							?>
								<option value=<?php echo '"'.$fila["nombre"].'
								"'?>> <?php echo $fila["nombre"] ?> </option> 
						    <?php  } ?>

			  				</select>
	  					</div>
	  				</div>	
		  			<div class="form-group col-md-3 offset-9 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" type="submit"><?php echo trad( "Guardar", $lang) ?></button>
					</div>
				</form>
				<div class="">
				</div>				
			</div>
		</div>
	</div>
</div>