adm_tablas.php

<div class="adm-tablas">
	<div class="row ">
		<div class="col-md-11 adjuntar-tablas">	
			<form class="jumbotron-propio" method="post" action="../handler/crear_ejercicio.php">
				<h3>Adjuntar Tablas</h3>
				<p class="pl-5">Insertar un nombre al ejercicio, las tablas a utilizar, la categoría y nivel del ejercicio e insertar un enunciado y la solución.</p>
				<div class="hrr"></div>
				<div class="form-row pt-4 ">
					<div class="form-group col-md-2 pl-4">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="name">Nombre</label>	
							</div>
							<div class="panel-footer">
		  						<input type="text" id="titulo" name="name_ejercicio" class="form-control" placeholder="Nombre" required />
		  					</div>
		  				</div>
					</div>
					<div class="form-group col-md-2">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
		  						<label for="tablas">Descripción Tablas</label>	
		  					</div>
		  					<div class="panel-footer" >
		  						<input type="text" id="tablas" name="descripcion" class="form-control" placeholder="Tablas" required />
		  					</div>
		  				</div>
		  			</div>
		  			<div class="form-group col-md-3">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="categoria">Categoría</label>
							</div>	
							<div class="panel-footer" >
				  				<select type="text" id="categoria" name="categoria" class="form-control" required>
				  					<option value="c1">1.Select-Basico</option>
				  					<option value="c2">2.Select-Join</option>
				  				</select>
				  			</div>
				  		</div>
					</div>
					<div class="form-group col-md-3 pr-4">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="nivel">Nivel</label>
							</div>	
							<div class="panel-footer" >
				  				<select type="text" id="nivel" name="nivel" class="form-control" required>
				  					<option value="Principiante">Principiante</option>
				  					<option value="Intermedio">Intermedio</option>
				  					<option value="Avanzado">Avanzado</option>			  	
				  				</select>
				  			</div>
				  		</div>
					</div>
					<div class="form-group col-md-2">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="deshabilitar">Ejercicio</label>
							</div>	
							<div class="panel-footer" >
				  				<select type="text" id="deshabilitar" name="deshabilitar" class="form-control" required>
				  					<option value="1">Habilitado</option>
				  					<option value="0">Deshabilitado</option>
				  				</select>
				  			</div>
				  		</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6 pl-4">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="enunciado">Enunciado</label>
							</div>	
							<div class="panel-footer" >
		  						<textarea  id="enunciado" name="enunciado" class="form-control" rows="5" placeholder="Escribe el enunciado aquí..." required></textarea>
		  					</div>
		  				</div>
					</div>
					<div class="form-group col-md-6 pr-4">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="solucion">Solución</label>
							</div>	
							<div class="panel-footer" >
		  						<textarea  id="solucion" name="solucion" class="form-control" rows="5" placeholder="Escribe la solución aquí..." required></textarea>
		  					</div>
		  				</div>
					</div>
				</div>
		  		<div class="form-row">	
		  			<div class="form-group col-md-3 offset-6">
						<button class="btn btn-log btn-tertiary-border btn-block" type="submit">Cancelar</button>
					</div>
					<div class="form-group col-md-3 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" type="submit">Guardar</button>
					</div>
		  		</div>
	  		</form>
		</div>
	</div>
</div>