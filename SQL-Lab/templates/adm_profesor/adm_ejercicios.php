<div class="adm-ejercicios">
	<div class="row ">
		<div class="col-md-11 crear-ejercicio">	
			<form class="jumbotron-propio" method="post" action="../handler/crear_ejercicio.php">
				<h3>Crear Ejercicio</h3>
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






		<div class="col-md-11 editar-ejercicio">
			
			<form class="jumbotron-propio">
				<h3>Editar Ejercicio</h3>
				<p class="pl-5">Podrás editar todos los campos del ejercicio.</p>
				<div class="hrr"></div>
				<div class="form-row pt-4 ">
					<div class="form-group col-md-3 pl-4">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="name">Nombre del Ejercicio</label>	
							</div>
							<div class="panel-footer">
		  						<input type="text" id="titulo" class="form-control" placeholder="Nombre" required />
		  					</div>
		  				</div>
					</div>
					<div class="form-group col-md-3">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
		  						<label for="tablas">Tablas</label>	
		  					</div>
		  					<div class="panel-footer" >
		  						<select type="text" id="tablas" class="form-control" required>
		  							<option>Tabla 1</option>
		  							<option>Tabla 2</option>
		  							<option>Tabla 3</option>
		  							<option>Tabla 4</option>
		  						</select>
		  					</div>
		  				</div>
		  			</div>
		  			<div class="form-group col-md-3">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="categoria">Categoría</label>
							</div>	
							<div class="panel-footer" >
				  				<select type="text" id="categoria" class="form-control" required>
				  					<option>Categoría 1</option>
				  					<option>Categoría 2</option>
				  					<option>Categoría 3</option>
				  					<option>Categoría 4</option>
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
				  				<select type="text" id="nivel" class="form-control" required>
				  					<option>Principiante</option>
				  					<option>Intermedio</option>
				  					<option>Avanzado</option>			  	
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
						<button class="btn btn-log btn-tertiary-border btn-block" type="submit" onclick="location.href='administrator.html'">Cancelar</button>
					</div>
					<div class="form-group col-md-3 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" type="submit" onclick="location.href='administrator.html'">Guardar</button>
					</div>
		  		</div>
	  		</form>
		</div>
		<!-- BUSQUEDA AVANZADA -->
		<div class="busqueda_avanzada col-md-4 offset-8 jumbotron-filtro float-right">
			<div class="col-md-1 offset-11">
				<i style="color: #fc6502" id="cerrar" class="fa fa-times-circle pt-3 pr-3 " title="cerrar" aria-hidden="true"></i>
			</div>
			<div class="col-md-12 ">
	  			<h4 class="pt-4" style="color: #fff">Búsqueda Avanzada </h4>
	  			<p style="color: #fff">Realiza una búsqueda detalla por campos. </p>
	  		</div>
	  		<div class="hrb"></div>
	  		<div class="col-md-12 ">
	  			<p>Nombre del Ejercicio </p>
	  			<input class="input_busqueda" type=”text” value="" />
	  		</div>
	  		<div class="col-md-12 pt-2">
	  			<p>Categoría </p>
		  		<select type="text" id="categoria" class="form-control" required>
					<option>Categoría 1</option>
					<option>Categoría 2</option>
					<option>Categoría 3</option>
					<option>Categoría 4</option>
				</select>
			</div>
			<div class="col-md-12 pt-2">
		  		<p>Nivel </p>
		  		<select type="text" id="nivel" class="form-control" required>
					<option>Principiante</option>
					<option>Intermedio</option>
					<option>Avanzado</option>			  	
				</select>
			</div>
			<div class="col-md-12 pt-4">
				
				<button class="btn btn-log btn-tertiary btn-block " type="submit" >Buscar</button>
			</div>
			<div class="col-md-12 pt-4 text-center pb-4">
				<a style="color: #fff" id="limpiar" href="#">Limpiar</a>
			</div>

	  	</div>






	  	
		<div class="col-md-11 jumbotron-propio lista-ejercicio">
			
			<form class="jumbotron-propio ">
				<h3>Lista de Ejercicios</h3>
				<p class="pl-5">Podrás editar y eliminar un ejercicio de la lista, además podrás filtar por el/los campo/s que quieras.</p>
				<div class="hrr"></div>
				<div class="form-row pt-3">
					<div class="form-group col-md-3 offset-9 pr-4">
						<button class="btn btn-log btn-tertiary-border btn-block filtrar" >Filtrar</button>
					</div>
					<div class="form-group col-md-12 ">
						<table class="table text-center">
							<thead class="thead-dark">
							    <tr>
							      <th scope="col">Nombre</th>
							      <th scope="col">Categoría</th>
							      <th scope="col">Nivel</th>			
							      <th scope="col"></th>
							    </tr>
							</thead>
							<tbody>
								<?php 
									include_once '../inc/ejercicio.php';
									$ejer = new Ejercicio();
									$result = $ejer->getNCNEjercicio();
									
									while($fila = mysqli_fetch_array($result)){
										echo "<tr><th scope='row'>";
										echo $fila['nombre'];
										echo "</th><td>";
										echo $fila['tipo'];
										echo "</td><td>";
										echo $fila['nivel'];
										echo "</td>";
										?>
										<td>							    
							      			<a id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
							      			
											<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true"></i></a>
							      		</td>
							      	<?php
									}
									
								?>
							    <!--<tr>
							      <th scope="row">Ejercicio 1</th>
							      <td>Categoría 1</td>
							      <td>Intermedio</td>						  
							      	<td>							    
							      	<a id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
									<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true"></i></a>
							      	</td>
							    </tr>-->
							    
							</tbody>
						</table>	
		  			</div>

				</div>
				<div class="form-row">
					<div class="form-group col-md-3 offset-3">
						<button class="btn btn-log btn-tertiary-border btn-block" type="submit" onclick="location.href='administrator.html'"><i class="fa fa-arrow-left pr-4" aria-hidden="true"></i>Anterior</button>
					</div>
					<div class="form-group col-md-3 ">
						<button class="btn btn-log btn-tertiary btn-block" type="submit" onclick="location.href='administrator.html'">Siguiente <i class="fa fa-arrow-right pl-4" aria-hidden="true"></i></button>
					</div>
				</div>
		  		
	  		</form>	
		</div>
	</div>
</div>