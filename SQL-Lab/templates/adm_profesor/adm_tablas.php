<div class="adm-tablas">
	<div class="row ">
		<div class="col-md-11 adjuntar-tablas">	
			<!--<form class="jumbotron-propio" method="post" action="../handler/crear_tablas.php">-->
				<h3>Crear Tablas</h3>
				<p class="pl-5">Introduzca el código para crear las tablas e introducir los datos.</p>
				<div class="hrr"></div>
				<div class="form-row pt-4 ">
					<div class="form-group col-md-12 pl-4">
					<form class="jumbotron-propio" method="post" action="../handler/crear_tablas_texto.php">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="enunciado">Crear Tabla</label>
							</div>	
							<div class="panel-footer" >
		  						<textarea  id="crea_tabla" name="crea_tabla" class="form-control" rows="5" placeholder="CREATE TABLE coches..."></textarea>
		  					</div>
		  					
		  				</div>	
		  			<div class="form-group col-md-3 offset-9 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" type="submit">Guardar</button>
					</div>
					</form>
					<div class="hrr mb-4"></div>
					<form class="jumbotron-propio" method="post" action="../handler/crear_tablas_fichero.php" enctype="multipart/form-data">
						<div class="panel panel-primary">
	                        <p>Seleccione un fichero con el código para crear las tablas e introducir en ellas los datos.</p>	
							<div class="input-group">
						  		<div class="custom-file">
						  			Seleccionar archivo
						    		<input type="file" name="fileToUpload" id="fileToUpload" value="Examinar...">
						    		
						    		<!-- <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload" value="Examinar..."> -->
						    		<!-- <label class="custom-file-label" for="fileToUpload">Seleccionar archivo</label> -->
						    		
						    			
						    		
						  		</div>
						  		<div class="input-group-append">
						    		<!-- <button class="btn btn-outline-secondary" type="button">Adjuntar</button> -->
						    		<input type="submit" class="btn btn-outline-secondary" name="submit" value="Adjuntar">
						  		</div>	
							</div>
		  				</div>
		  			</form>
					</div>
				</div>
	  		<!--</form>-->
		</div>
	</div>
</div>