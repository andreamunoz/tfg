<div class="adm-tablas">
	<div class="row ">
		<div class="col-md-11 adjuntar-tablas">	
			<form class="jumbotron-propio" method="post" action="../handler/crear_ejercicio.php">
				<h3>Crear Tablas</h3>
				<p class="pl-5">Introduzca el código para crear las tablas e introducir los datos.</p>
				<div class="hrr"></div>
				<div class="form-row pt-4 ">
					<div class="form-group col-md-12 pl-4">
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
						<div class="hrr mb-4"></div>
						<div class="panel panel-primary">
	                        <p>Seleccione un fichero con el código para crear las tablas e introducir en ella los datos.</p>	
							<div class="input-group">
						  		<div class="custom-file">
						    		<input type="file" class="custom-file-input" id="inputGroupFile04">
						    		<label class="custom-file-label" for="inputGroupFile04">Seleccionar archivo</label>
						  		</div>
						  		<div class="input-group-append">
						    		<button class="btn btn-outline-secondary" type="button">Adjuntar</button>
						  		</div>
							</div>
		  				</div>
					</div>
				</div>
	  		</form>
		</div>
	</div>
</div>