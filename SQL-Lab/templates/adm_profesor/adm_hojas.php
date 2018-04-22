<div class="adm-hojas">
	<div class="row ">
		<!--<div class="col-md-11">
			<h2>Administrador de Hojas</h2>
			<div class="hrr"></div>
		</div> -->
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
	  							<input type="text" id="nombre" class="form-control" placeholder="Nombre" required />
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
							    	<div class="card-header" id="headingOne">
							      		<h5 class="mb-0">
							        	<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Hoja 1
							        	</button>
							        	<div class="float-right pt-2">
							      			<a id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
											<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true"></i></a>
							      		</div>
							      		</h5>
							      		
							    	</div>
							    	<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
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
								    </div>
								</div>
								<div class="card">
							    	<div class="card-header" id="headingTwo">
							      		<h5 class="mb-0">
							        	<button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Hoja 2
							        	</button>
							        	<div class="float-right pt-2">
							      			<a id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
											<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true"></i></a>
							      		</div>
							      		</h5>
							    	</div>
							    	<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								      <div class="card-body">
								        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
								      </div>
								    </div>
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