<div class="adm-hojas">
	<div class="row ">
		
		<div class="col-md-11 crear-hoja ">			
			<form class="jumbotron-propio">
				<h3>Crear Hoja de Ejercicio</h3>
				<p class="pl-5">Añadir un nombre y después insertar ejercicios a la hoja.</p>
				<div class="hrr"></div>
				<div class="form-row pl-4 pr-4 pt-4">
					<div class="form-group col-md-12">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="name">Nombre de la Hoja</label>
							</div>
							<div class="panel-footer">	
	  							<input type="text" id="nombre" class="form-control" placeholder="Nombre" required />
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
							<div class="panel-footer">
								<table class="table table-fixed text-center">
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
								      			<a href="#añadir" id="añadir" href="#"><i id="icon_añadir" class="fa fa-plus pr-3" title="añadir" aria-hidden="true"></i></a>
								      		</td>
								      	<?php
										}		
									?>		
									</tbody>
								</table>
	  						</div>
	  					</div>
					</div>
				</div>
		  		<div class="form-row pr-4">	
					<div class="form-group col-md-3 offset-9">
						<button class="btn btn-log btn-tertiary btn-block" type="submit" onclick="location.href='administrator.html'">Crear Hoja</button>
					</div>
		  		</div>
	  		</form>
		  	
		</div>
		<div class="col-md-11 editar-hoja">		
			<form class="jumbotron-propio">
				<h3>Editar Hoja de Ejercicio</h3>
				<p class="pl-5">Se podrá editar el nombre de la hoja y sus respectivos ejercicios.</p>
				<div class="hrr"></div>
				<div class="form-row pl-4 pr-4 pt-4">
					<div class="form-group col-md-12">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="name">Nombre de la Hoja</label>
							</div>
							<div class="panel-footer">	
	  							<input type="text" id="nombre" class="form-control" placeholder="Nombre" required />
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
							<div class="panel-footer">	
	  							<input type="text" id="nombre" class="form-control" placeholder="Nombre" required />
	  						</div>
	  					</div>
					</div>
				</div>
	  		</form>
		</div>
		<div class="col-md-11 lista-hoja">
			<form class="jumbotron-propio">
			<h3>Lista de Hojas</h3>
			<p class="pl-5">Se podrán ver loss ejercicios dentro de sus propias hojas.</p>
			<div class="hrr"></div>
			<div class="form-row pl-4 pr-4 pt-4">
				<div class="form-group col-md-12">
					<div class="panel panel-primary">
                        <div class="panel-heading">
							<label for="lista_hojas">Lista de Hojas</label>
						</div>
						<div class="panel-footer">	
  							<div id="accordion">
							  	<div class="card">

							  		<?php 
									include_once '../inc/hoja_ejercicio.php';
									$ejer = new HojaEjercicio();
									$result = $ejer->getAllHojas();
									
									while($fila = mysqli_fetch_array($result)){
									?>
									<div class="card-header" id="headingOne">
										<h5 class="mb-0">
										<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										<?php	
										echo $fila['nombre'];
										?>
										</button>
							        	<div class="float-right pt-2">
							      			<a id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
											<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true"></i></a>
							      		</div>
							      		</h5>
						      		</div>
							    	<?php } ?>						     													        								      								    	
							    	<!--<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
								      <div class="card-body">
								        	<table class="table text-center">
												<tbody>
												    <tr>
												      <th scope="row">Ejercicio 1</th>
												      <td>Categoría 1</td>
												      <td>Intermedio</td>						  
												      	<td>					    
												      	<a id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
														<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true"></i></a>
												      	</td>
												    </tr>
												    <tr>
												      	<th scope="row">Ejercicio 2</th>
												      	<td>Categoría 2</td>
												      	<td>Avanzado</td>
														<td>
												      	<a id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
														<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true"></i></a>
												      </td>
												    </tr>
												    <tr>
												      	<th scope="row">Ejercicio 2</th>
												      	<td>Categoría 2</td>
												      	<td>Avanzado</td>
														<td>
												      	<a id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
														<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true"></i></a>
												      </td>
												    </tr>
												</tbody>
											</table>	
								      </div>
								    </div>-->
								</div>
  							</div>
  						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>