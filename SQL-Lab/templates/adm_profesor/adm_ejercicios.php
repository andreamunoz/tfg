<div class="adm-ejercicios">
	<div class="row ">
		<div class="col-md-11 crear-ejercicio">	
			<form class="jumbotron-propio" method="post" action="../handler/crear_ejercicio.php">
				<h3><?php echo trad('Crear Ejercicio',$lang) ?></h3>
				<p class="pl-5"><?php echo trad('Insertar las tablas sobre las que ejecutar la consulta, la categoría, el nivel del ejercicio, una descripción que sirva de ayuda al alumno, un enunciado y la solución. Si se va a utilizar más de una tabla, asegúrese de que están relacionadas.',$lang) ?></p>
				<div class="hrr"></div>
				<div class="form-row pt-4 ">
					<div class="form-group col-md-4">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
		  						<label for="user_tablas"><?php echo trad('Creador de las tablas',$lang) ?></label>	
		  					</div>
		  					<div class="panel-footer selector-user" >

		  						<select id="user_tablas" name="user_tablas" class="form-control" required></select>								
								<script type="text/javascript">
		  							$(document).ready(function(){
		  								$.ajax({
		  									type: "POST",
		  									url: "adm_profesor/getUser.php",
		  									success: function(response)
		  									{
		  										$(".selector-user select").html(response).fadeIn();
		  									}
		  								});
		  							});

		  						</script>
				  				
		  					</div>
		  				</div>
		  			</div>
		  			<div class="form-group col-md-4">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
		  						<label for="tablas"><?php echo trad('Tablas usadas',$lang) ?></label>	
		  					</div>
		  					<div class="panel-footer selector-tabla" >
		  						<select multiple="" type="text" id="tablas" name="tablas[]" class="form-control" required></select>
		  						<script type="text/javascript">
					                $(document).ready(function() {
					                    $(".selector-user select").change(function() {
					                        var form_data = {
					                                is_ajax: 1,
					                                dueno: $(".selector-user select option:checked").val()
					                        };
					                        $.ajax({
					                                type: "POST",
					                                url: "adm_profesor/getTablas.php",
					                                data: form_data,
					                                success: function(response)
					                                {	
					                                    $('.selector-tabla select').html(response).fadeIn();
					                                }
					                        });
					                    });

					                });
					            </script>				  				
		  					</div>
		  				</div>
		  			</div>
		  			<div class="form-group col-md-4">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
		  						<label for="tablas"><?php echo trad('Columnas tabla',$lang) ?></label>	
		  					</div>
		  					<div class="panel-footer columnas-tabla" >
		  						<table id="columnas" class="form-control" ><tbody></tbody></table>
		  						<script type="text/javascript">
					                $(document).ready(function() {
					                    $(".selector-tabla select").change(function() {
					                        var form_data = {
					                                is_ajax: 1,
					                                tabla: $(".selector-tabla select option:checked").val()
					                        };
					                        $.ajax({
					                                type: "POST",
					                                url: "adm_profesor/getColumns.php",
					                                data: form_data,
					                                success: function(response)
					                                {	
					                                    $('.columnas-tabla #columnas tbody').html(response).fadeIn();
					                                }
					                        });
					                    });

					                });
					            </script>				  				
		  					</div>
		  				</div>
		  			</div>
		  		</div>
		  		<div class="form-row pt-4 ">
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
									?>
								        <option value=<?php echo $newKey?> > <?php echo $value ?> </option>

								    <?php  } ?> 
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
				  					<option value="facil"><?php echo trad('Principiante',$lang) ?></option>
				  					<option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
				  					<option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>			  	
				  				</select>
				  			</div>
				  		</div>
					</div>
					<div class="form-group col-md-4">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="deshabilitar"><?php echo trad('Ejercicio',$lang) ?></label>
							</div>	
							<div class="panel-footer" >
				  				<select type="text" id="deshabilitar" name="deshabilitar" class="form-control" required>
				  					<option value="0"><?php echo trad('Habilitado',$lang) ?></option>
				  					<option value="1"><?php echo trad('Deshabilitado',$lang) ?></option>
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
								<input type="text" id="descripcion" name="descripcion" class="form-control" placeholder=<?php echo trad('Descripcion breve aquí...',$lang) ?>  maxlength="200" required />
		  						<!-- <textarea  id="descripcion" name="descripcion" class="form-control" rows="5" placeholder=<?php echo trad('',$lang) ?> required></textarea> -->
		  					</div>
		  				</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="enunciado"><?php echo trad('Enunciado',$lang) ?></label>
							</div>	
							<div class="panel-footer" >
		  						<textarea  id="enunciado" name="enunciado" class="form-control" rows="5" placeholder=<?php echo trad('Escribe el enunciado aquí...',$lang) ?> required></textarea>
		  					</div>
		  				</div>
					</div>
					<div class="form-group col-md-6">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="solucion"><?php echo trad('Solución',$lang) ?></label>
							</div>	
							<div class="panel-footer" >
		  						<textarea  id="solucion" name="solucion" class="form-control" rows="5" placeholder=<?php echo trad('Escribe la solución aquí...',$lang) ?> required></textarea>
		  					</div>
		  				</div>
					</div>
				</div>
		  		<div class="form-row">	
		  			<div class="form-group col-md-3">
						<button class="btn btn-log btn-tertiary-border btn-block" type="reset"><?php echo trad('Cancelar',$lang) ?></button>
					</div>
		  			<!-- <div class="form-group col-md-3 offset-3">
						<button class="btn btn-log btn-tertiary-border btn-block" type="submit" name="visualizar"><?php echo trad('Visualizar resultado',$lang) ?></button>
					</div> -->
					<div class="form-group col-md-3 offset-6 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" name="crear" type="submit"><?php echo trad('Crear ejercicio',$lang) ?></button>
					</div>
		  		</div>
		  		<br>
		  		<br>
		  		<br>
	  		</form>
		</div>






		<div class="col-md-11 editar-ejercicio">
			
			<form class="jumbotron-propio">
				<h3><?php echo trad( "Editar Ejercicio", $lang) ?></h3>
				<p class="pl-5"><?php echo trad( "Podrás editar algunos campos del ejercicio", $lang) ?>.</p>
				<div class="hrr"></div>
				<div class="form-row pt-4 ">
					<!-- 
						El nombre no se va a poder cambiar 
					-->
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

					<!-- 
						El nombre no se va a poder cambiar 
					-->

					<div class="form-group col-md-2">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
		  						<label for="tablas"><?php echo trad( "Tablas usadas", $lang) ?></label>	
		  					</div>
		  					<div class="panel-footer" >
		  						<input type="text" id="tablas" name="descripcion" class="form-control" placeholder="Tablas" required />
		  					</div>
		  				</div>
		  			</div>
		  			<div class="form-group col-md-3">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="categoria"><?php echo trad( "Categoría", $lang) ?></label>
							</div>	
							<div class="panel-footer" >
				  				<select type="text" id="categoria" name="categoria" class="form-control" required>
				  					<option value="c1">1.Select-Basico</option>
				  					<option value="c2">2.Select-Join</option>
				  				</select>
				  			</div>
				  		</div>
					</div>
					<div class="form-group col-md-2">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="nivel"><?php echo trad( "Nivel", $lang) ?></label>
							</div>	
							<div class="panel-footer" >
				  				<select type="text" id="nivel" name="nivel" class="form-control" required>
				  					<option value="Principiante"><?php echo trad( "Principiante", $lang) ?></option>
				  					<option value="Intermedio"><?php echo trad( "Intermedio", $lang) ?></option>
				  					<option value="Avanzado"><?php echo trad( "Avanzado", $lang) ?></option>			  	
				  				</select>
				  			</div>
				  		</div>
					</div>
					<div class="form-group col-md-3 pr-4">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="deshabilitar"><?php echo trad( "Ejercicio", $lang) ?></label>
							</div>	
							<div class="panel-footer" >
				  				<select type="text" id="deshabilitar" name="deshabilitar" class="form-control" required>
				  					<option value="1"><?php echo trad( "Habilitado", $lang) ?></option>
				  					<option value="0"><?php echo trad( "Deshabilitado", $lang) ?></option>
				  				</select>
				  			</div>
				  		</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6 pl-4">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="enunciado"><?php echo trad( "Enunciado", $lang) ?></label>
							</div>	
							<div class="panel-footer" >
		  						<textarea  id="enunciado" name="enunciado" class="form-control" rows="5" placeholder=<?php echo trad( "Escribe el enunciado aquí...", $lang) ?> required></textarea>
		  					</div>
		  				</div>
					</div>
					<div class="form-group col-md-6 pr-4">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="solucion"><?php echo trad( "Solución", $lang) ?></label>
							</div>	
							<div class="panel-footer" >
		  						<textarea  id="solucion" name="solucion" class="form-control" rows="5" placeholder=<?php echo trad( "Escribe la solución aquí...", $lang) ?> required></textarea>
		  					</div>
		  				</div>
					</div>
				</div>
		  		<div class="form-row">	
		  			<div class="form-group col-md-3 offset-6">
						<button class="btn btn-log btn-tertiary-border btn-block" type="submit"><?php echo trad( "Cancelar", $lang) ?></button>
					</div>
					<div class="form-group col-md-3 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" type="submit"><?php echo trad( "Guardar cambios", $lang) ?></button>
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
	  			<h4 class="pt-4" style="color: #fff"><?php echo trad( "Búsqueda Avanzada", $lang) ?> </h4>
	  			<p style="color: #fff"><?php echo trad( "Realiza una búsqueda detalla por campos", $lang) ?>. </p>
	  		</div>
	  		<div class="hrb"></div>
	  		<!-- 
	  			Mejor no hacer busqueda por nombre, porque no es descriptivo 
	  		-->
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
					<option><?php echo trad( "Principiante", $lang) ?></option>
					<option><?php echo trad( "Intermedio", $lang) ?></option>
					<option><?php echo trad( "Avanzado", $lang) ?></option>			  	
				</select>
			</div>
			<div class="col-md-12 pt-4">
				
				<button class="btn btn-log btn-tertiary btn-block " type="submit" ><?php echo trad( "Buscar", $lang) ?></button>
			</div>
			<div class="col-md-12 pt-4 text-center pb-4">
				<a style="color: #fff" id="limpiar" href="#"><?php echo trad( "Limpiar filtros", $lang) ?></a>
			</div>

	  	</div>






	  	
		<div class="col-md-11 jumbotron-propio lista-ejercicio">
			
			<form class="jumbotron-propio ">
				<h3><?php echo trad( "Listar Ejercicios", $lang) ?></h3>
				<p class="pl-5"><?php echo trad( "Podrás editar y eliminar un ejercicio de la lista, además podrás filtar por el/los campo/s que quieras", $lang) ?>.</p>
				<div class="hrr"></div>
				<div class="form-row pt-3">
					<div class="form-group col-md-3 offset-9 pr-4">
						<button class="btn btn-log btn-tertiary-border btn-block filtrar" ><?php echo trad( "Filtrar", $lang) ?></button>
					</div>
					<div class="form-group col-md-12 ">
						<table class="table table-fixed text-center">
							<thead class="thead-dark">
							    <tr>
							      <!-- <th scope="col"><?php echo trad( "Nombre", $lang) ?></th> -->
							      <th scope="col"><?php echo trad( "Categoría", $lang) ?></th>
							      <th scope="col"><?php echo trad( "Nivel", $lang) ?></th>			
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
							      			<a href="#editar"id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
											<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true" onclick="eliminar_Ejercicio()"></i></a>

							      		</td>
							      	<?php
									}		
								?>					    
							</tbody>
						</table>	
		  			</div>

				</div>
				<div class="form-row">
					<div class="form-group col-md-3 offset-3">
						<button class="btn btn-log btn-tertiary-border btn-block" type="submit" onclick="location.href='administrator.html'"><i class="fa fa-arrow-left pr-4" aria-hidden="true"></i><?php echo trad( "Anterior", $lang) ?></button>
					</div>
					<div class="form-group col-md-3 ">
						<button class="btn btn-log btn-tertiary btn-block" type="submit" onclick="location.href='administrator.html'"><?php echo trad( "Siguiente", $lang) ?> <i class="fa fa-arrow-right pl-4" aria-hidden="true"></i></button>
					</div>
				</div>
		  		
	  		</form>	
		</div>
	</div>
</div>