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
						<select class="selectpicker" multiple>
						  <option>Mustard</option>
						  <option>Ketchup</option>
						  <option>Barbecue</option>
						</select>
					</div>
					<script type="text/javascript">
						
						$('.selectpicker').selectpicker();
					</script>
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
				<div class="form-row pl-4 pr-4">
					<div class="form-group col-md-3">
						<label for="name">Nombre</label>	
		  				<input type="text" id="titulo" class="form-control" placeholder="Título" required />
					</div>
					<div class="form-group col-md-6 pl-4 pr-4">
		  				<label for="descripcion">Descripción de Noticia</label>	
		  				<input type="text" id="apellido" class="form-control" placeholder="Descripción" required />
		  			</div>
		  			<div class="form-group col-md-3 pl-4 pr-4">
						<label for="categoria">Categoría</label>	
		  				<select type="text" id="categoria" class="form-control" required>
		  					<option>Sport</option>
		  					<option>Economy</option>
		  					<option>Science</option>
		  					<option>Culture</option>
		  				</select>
					</div>
				</div>
				<div class="form-row pl-4 pr-4">
					<div class="form-group col-md-12">
						<label for="texto">Texto de Noticia</label>	
		  				<textarea  id="texto" name="texto" class="form-control" rows="5" placeholder="Escribe el texto aquí..." required></textarea>
					</div>
				</div>
		  		<div class="form-row pl-4 pr-4">	
					<div class="form-group col-md-3 offset-9">
						<button class="btn btn-log btn-primary btn-block" type="submit" onclick="location.href='administrator.html'">Editar Noticia</button>
					</div>
		  		</div>
	  		</form>
		</div>
		<div class="col-md-11 lista-hoja pt-4">
			<h3>Lista de las Hoja de Ejercicio</h3>
			
			<ol>
			  <li class="hojita">
			    <p class="diplome">BAC S</p>
			    <span class="point"></span>
			    <p class="description">
			      Ceci est la description du bac S
			    </p>
			  </li>
			  <li class="hojita">
			    <p class="diplome">BTS / DUT</p>
			    <span class="point"></span>
			    <p class="description">En lien avec la biologie et/ou la zoologie</p>
			  </li >
			  <li class="hojita">
			    <p class="diplome">Licence</p>
			    <span class="point"></span>
			    <p class="description">En lien avec la biologie et/ou la zoologie</p>
			  </li>
			</ol>
		</div>
	</div>
</div>