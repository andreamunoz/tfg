<div class="adm-ejercicios">
	<div class="row ">
		<div class="col-md-11 crear-ejercicio">	
			<form class="jumbotron-propio" id="longSelect" method="post" action="../handler/crear_ejercicio.php">
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
				  						include_once '../inc/ejercicio.php';
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
					<div class="form-group col-md-3 offset-6 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" name="crear" type="submit"><?php echo trad('Crear ejercicio',$lang) ?></button>
					</div>
		  		</div>
		  		<br>
		  		<br>
		  		<br>
	  		</form>
		</div>


	

	  	
		<div class="col-md-11 jumbotron-propio lista-ejercicio">
			<h3><?php echo trad( "Listar Ejercicios", $lang) ?></h3>
			<p class="pl-5"><?php echo trad( "Aquí se muestran todos los ejercicios almacenados.", $lang); unset($_SESSION['editar']); ?>.</p>
			<div class="hrr"></div><br>
			<div id="accordion ">
              <div class="card">  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered" style="text-align: center">  
                        <thead>
                          <tr>
                              <th>Nombre Ejercicio</th>
                              
                              <th>Enunciado</th>
                              <th>Nivel</th>
                              <th>Tipo</th>
                              <th>Creador</th>
                              <th>Ver</th>
                              <th></th>
                              <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                            include_once '../inc/ejercicio.php';
                            $ejer = new Ejercicio();
                            $result = $ejer->getAllEjercicios();    
                            include_once '../inc/solucion.php';
                            $sol = new Solucion();
                            while($fila = mysqli_fetch_array($result)){
                            	$resul_sol = $sol->getCuantosEjerciciosByName($fila['id_ejercicio']);
                            	$fila_sol = $resul_sol->fetch_array(MYSQLI_ASSOC);
                            ?>
                                <tr>
                                  	<?php echo '<td><p>Ejercicio '.$fila['id_ejercicio'].'</p></td>'; ?>
                                  	<?php echo '<td>'.$fila['enunciado'].'</td>'; ?>
                                  	<?php echo '<td>'.$fila['nivel'].'</td>'; ?>
                                  	<?php echo '<td>'.$fila['tipo'].'</td>'; ?>
                                  	<?php echo '<td>'.$fila['creador_ejercicio'].'</td>'; ?>
                                  	 <?php echo '<td class="boton_ver_ejercicio" data-number='. $fila["id_ejercicio"] .'><a href="#"><i id="icon_ver" class="fa fa-eye" title="editar" aria-hidden="true"></i></a></td>'; ?>
									<?php if($fila['creador_ejercicio'] === $_SESSION['user']) {
											if( $fila_sol["cantidad"] === "0"){ ?>	
		                                  		<?php echo '<td class="boton_editar_ejercicio" data-number='. $fila["id_ejercicio"] .'><a href="#"><i id="icon_edit" class="fa fa-edit" title="editar" aria-hidden="true"></i></a></td>'; ?>
												<?php echo '<td class="boton_borrar_ejercicio" data-number='. $fila['id_ejercicio'] .'><a href="#"><i id="icon_delete" class="fa fa-times" title="eliminar" aria-hidden="true"></i></a></td>'; ?>
											<?php }else{ 
												if($fila['deshabilitar'] === "0"){ ?>
													<?php echo '<td colspan="2" class="boton_deshabilitar_ejercicio" data-number='. $fila["id_ejercicio"] .'><a href="#">Deshabilitar</a></td>'; ?>
												<?php }else{ ?>
													<?php echo '<td colspan="2" class="boton_habilitar_ejercicio" data-number='. $fila["id_ejercicio"] .'><a href="#">Habilitar</a></td>'; ?>
												<?php } ?>
											<?php } ?>
									<?php } else{?>
										<td colspan="2"></td>
									<?php } ?>	

                                </tr>
                            <?php                                 
                            }
                            ?>
                        </tbody>
                      </table>
                    </div>  
                </div> 
            </div> 	
			
		</div>
	</div>
</div>