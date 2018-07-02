<div class="adm-ejercicios">
	<div class="row ">
		<div class="col-md-11 crear-ejercicio">	
			<form class="jumbotron-propio" id="longSelect" method="post" action="../handler/crear_ejercicio.php">
				<h3><?php echo trad('Crear Ejercicio',$lang) ?></h3>
				<p class="pl-5"><?php echo trad('Indicar el propietario de las tablas que se desean utilizar así como la categoría y nivel del ejercicio, una descripción que sirva de ayuda al alumno, elenunciado y una solución.',$lang) ?></p>
				<div class="hrr"></div>
				<div class="form-row pt-4 ">
					<div class="form-group col-md-4">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
		  						<label for="user_tablas"><?php echo trad('Origen tablas',$lang) ?><span class="red"> *</span></label>	
		  					</div>
		  					<div class="panel-footer selector-user" >
								
		  						<select id="user_tablas" name="user_tablas" class="form-control" required></select>
				  				
		  					</div>
		  				</div>
		  			</div>
		  			<div class="form-group col-md-4" style="margin-bottom: 0 !important">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
		  						<label for="tablas"><?php echo trad('Tablas',$lang) ?></label>	
		  					</div>
		  					<div class="panel-footer selector-tabla" >
		  						<select multiple="" type="text" id="tablas" name="tablas[]" size="4" class="form-control"></select>				  				
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
		  					</div>
		  				</div>
		  			</div>
		  		</div>
		  		<div class="form-row pt-2 ">
		  			<div class="form-group col-md-4">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="categoria"><?php echo trad('Categoría',$lang) ?><span class="red"> *</span></label>
							</div>	
							<div class="panel-footer" >
				  				<select type="text" id="categoria" name="categoria" class="form-control" required>
				  					<?php 
				  						include_once '../inc/ejercicio.php';
				  						$ejer = new Ejercicio();
								        $resultado = $ejer->getCategorias();
									    foreach ($resultado as $key => $value) { 
									    	$newKey = "c".($key+1);
									    	if (isset($_SESSION['guardarDatos'])) {
											    if($newKey === $_SESSION['guardarDatos'][1]){ ?>
											    	<option value=<?php echo $newKey ?> selected="selected"> <?php echo $value ?> </option>
											    <?php } else{ ?>
													<option value=<?php echo $newKey ?> > <?php echo $value ?> </option>
											    <?php } 
											} else { ?>
												<option value=<?php echo $newKey ?> > <?php echo $value ?> </option>
											<?php }	
									 	} ?> 
				  				</select>
				  			</div>
				  		</div>
					</div>
					<div class="form-group col-md-4">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="nivel"><?php echo trad('Nivel',$lang) ?><span class="red"> *</span></label>
							</div>	
							<div class="panel-footer" >
				  				<select type="text" id="nivel" name="nivel" class="form-control" required>
				  					<?php if (isset($_SESSION['guardarDatos'])) { 
				  						if( $_SESSION['guardarDatos'][2] === "facil"){ ?>
				  							<option value="facil" selected="selected"><?php echo trad('Principiante',$lang) ?></option>
					  						<option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
					  						<option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>
									<?php } else if( $_SESSION['guardarDatos'][2] === "medio"){ ?>
											<option value="facil"><?php echo trad('Principiante',$lang) ?></option>
					  						<option value="medio" selected="selected"><?php echo trad('Intermedio',$lang) ?></option>
					  						<option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>
									<?php } else if( $_SESSION['guardarDatos'][2] === "dificil"){ ?>
											<option value="facil"><?php echo trad('Principiante',$lang) ?></option>
						  					<option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
						  					<option value="dificil" selected="selected"><?php echo trad('Avanzado',$lang) ?></option>
				  					<?php } 
				  					}else { ?>
					  					<option value="facil"><?php echo trad('Principiante',$lang) ?></option>
					  					<option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
					  					<option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>
				  					<?php 	} ?>			  	
				  				</select>
				  			</div>
				  		</div>
					</div>
					<div class="form-group col-md-4">
		  				<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="deshabilitar"><?php echo trad('Ejercicio',$lang) ?><span class="red"> *</span></label>
							</div>	
							<div class="panel-footer" >
				  				<select type="text" id="deshabilitar" name="deshabilitar" class="form-control" required>
				  					<?php if (isset($_SESSION['guardarDatos'])) { 
				  						if( intval($_SESSION['guardarDatos'][3]) === 0){ ?>
											<option value="0" selected="selected"><?php echo trad('Habilitado',$lang) ?></option>
				  							<option value="1"><?php echo trad('Deshabilitado',$lang) ?></option>
									<?php } else { ?>
											<option value="0"><?php echo trad('Habilitado',$lang) ?></option>
				  							<option value="1" selected="selected"><?php echo trad('Deshabilitado',$lang) ?></option>
				  					<?php }
				  					} else { ?>
					  					<option value="0"><?php echo trad('Habilitado',$lang) ?></option>
				  						<option value="1"><?php echo trad('Deshabilitado',$lang) ?></option>
				  					<?php } ?>
				  					
				  				</select>
				  			</div>
				  		</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="descripcion"><?php echo trad('Descripcion',$lang) ?><span class="red"> *</span></label>
							</div>	
							<div class="panel-footer" >
								<?php if (isset($_SESSION['guardarDatos'])) { ?>
									<input type="text" id="descripcion" name="descripcion" class="form-control" maxlength="50" required value="<?php echo $_SESSION['guardarDatos'][4] ?>" />
								<?php } else {?>
									<input type="text" id="descripcion" name="descripcion" class="form-control" maxlength="50" required />
								<?php } ?>
		  					</div>
		  				</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="enunciado"><?php echo trad('Enunciado',$lang) ?><span class="red"> *</span></label>
							</div>	
							<div class="panel-footer" >
								<?php if (isset($_SESSION['guardarDatos'])) { ?>
		  							<textarea  id="enunciado" name="enunciado" class="form-control" rows="5" required><?php echo $_SESSION['guardarDatos'][5] ?></textarea>
		  						<?php } else { ?>
		  							<textarea  id="enunciado" name="enunciado" class="form-control" rows="5" required></textarea>
		  						<?php } ?>
		  					</div>
		  				</div>
					</div>
					<div class="form-group col-md-6">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="solucion"><?php echo trad('Solución',$lang) ?><span class="red"> *</span></label>
							</div>	
							<div class="panel-footer" >
								<?php if (isset($_SESSION['guardarDatos'])) { ?>
		  							<textarea  id="solucion" name="solucion" class="form-control" rows="5" required><?php echo $_SESSION['guardarDatos'][6] ?></textarea>
								<?php }else { ?>
		  							<textarea  id="solucion" name="solucion" class="form-control" rows="5" required></textarea>
		  						<?php } ?>
		  					</div>
		  				</div>
					</div>
				</div>
		  		<div class="form-row">	
		  			<!-- <div class="form-group col-md-3">
						<button class="btn btn-log btn-tertiary-border btn-block" type="reset"><?php echo trad('Cancelar',$lang) ?></button>
					</div> -->
					<div class="form-group col-md-3 offset-9 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" name="crear" type="submit"><?php echo trad('Crear ejercicio',$lang) ?></button>
					</div>
		  		</div>
		  		<br>
		  		<br>
		  		<br>
	  		</form>
		</div>


	


		<div class="col-md-11 editar-ejercicio" id="editarEjercicio" >
			
				<form class="jumbotron-propio" id="longSelect" method="post" action="../handler/editar_ejercicio.php">
					<h3><?php echo trad( "Editar Ejercicio", $lang) ?></h3>
					<p class="pl-5"><?php echo trad( "Podrás editar algunos campos del ejercicio", $lang) ?>.</p>
					<div class="hrr"></div>
											
							<!-- <div class="pt-4"><p>Datos permanentes del ejercicio: Nombre, propietario de las tablas y tablas usadas. </p></div> -->
							<div class="form-row pt-4 ">
								<input type="text" name="e_id" id="editaId" style="display: none">
								<div class="form-group col-md-4">
					  				<div class="panel panel-primary">
				                        <div class="panel-heading">
					  						<label for="duenoOld"><?php echo trad('Origen tablas',$lang) ?></label>	
					  					</div>
					  					<div class="panel-footer user_tablas" >	
					  						<input type="text" class="form-control" name="dueno" id="editaDueno" value="" readonly="readonly">
				  				
					  					</div>
					  				</div>
					  			</div>
					  			<div class="form-group col-md-4">
					  				<div class="panel panel-primary">
				                        <div class="panel-heading">
					  						<label for="tablasOld"><?php echo trad('Tablas usadas',$lang) ?></label>	
					  					</div>
					  					<div class="panel-footer columnas-tabla" >
					  						
					  						<input type="text" class="form-control" name="tablas" id="editaTablas" value="" readonly="readonly">					  				
					  					</div>
					  				</div>
					  			</div>
							</div>
					  		<!-- <div class="pt-4"><p>Datos que se pueden modificar: Categoría, nivel, estado, descripcion y solución. </p></div> -->
					  		<div class="form-row pt-2 ">
					  			<div class="form-group col-md-4">
					  				<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="categoria"><?php echo trad('Categoría',$lang) ?><span class="red"> *</span></label>
										</div>	
										<div class="panel-footer" >
							  				<select type="text" id="editaCategoria" name="categoria" class="form-control" required>
							  					
							  				</select>
							  			</div>
							  		</div>
								</div>
								<div class="form-group col-md-4">
					  				<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="nivel"><?php echo trad('Nivel',$lang) ?><span class="red"> *</span></label>
										</div>	
										<div class="panel-footer" >
							  				<select type="text" id="editaNivel" name="nivel" class="form-control" required>
							  					
							  				</select>
							  			</div>
							  		</div>
								</div>
								<div class="form-group col-md-4">
					  				<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="deshabilitar"><?php echo trad(' Estado del ejercicio',$lang) ?><span class="red"> *</span></label>
										</div>	
										<div class="panel-footer" >
							  				<select type="text" id="editaDeshabilitar" name="deshabilitar" class="form-control" required>
							  					
							  				</select>
							  			</div>
							  		</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="descripcion"><?php echo trad('Descripcion',$lang) ?><span class="red"> *</span></label>
										</div>	
										<div class="panel-footer" >
											<input type="text" id="editaDescripcion" name="descripcion" class="form-control" placeholder=<?php echo trad('Descripcion breve aquí...',$lang) ?>  maxlength="50"  value="" required />
					  					</div>
					  				</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="enunciado"><?php echo trad( "Enunciado", $lang) ?><span class="red"> *</span></label>
										</div>	
										<div class="panel-footer" >
					  						<textarea  id="editaEnunciado" name="enunciado" class="form-control" rows="4" placeholder=<?php echo trad( "Escribe el enunciado aquí...", $lang) ?> required></textarea>
					  					</div>
					  				</div>
								</div>
								<div class="form-group col-md-6">
									<div class="panel panel-primary">
				                        <div class="panel-heading">
											<label for="solucion"><?php echo trad( "Solución", $lang) ?><span class="red"> *</span></label>
										</div>	
										<div class="panel-footer" >
					  						<textarea  id="editaSolucion" name="solucion" class="form-control" rows="4" placeholder=<?php echo trad( "Escribe la solución aquí...", $lang) ?> required></textarea>
					  					</div>
					  				</div>
								</div>
							</div>
					  		<div class="form-row">	
					  			<div class="form-group col-md-3">
									<button class="btn btn-log btn-tertiary-border btn-block" type="reset" onclick="location.href = '../templates/index_profesor.php'"><?php echo trad( "Cancelar", $lang) ?></button>
								</div>
								<div class="form-group col-md-3 offset-6 pr-4">
									<button class="btn btn-log btn-tertiary btn-block" type="submit"><?php echo trad( "Guardar cambios", $lang) ?></button>
								</div>
					  		</div>
				  		<!-- <?php //} 
				  		//unset($_SESSION['editar']);
				  		?> -->
				  	<br>
			  		<br>
			  		<br>
		  		</form>
			</div>






	  	
		<div class="col-md-11 jumbotron-propio lista-ejercicio" id="listarEjercicios">
			<h3><?php echo trad( "Gestión de Ejercicios", $lang) ?></h3>
			<p class="pl-5"><?php echo trad( "Aquí se muestran todos los ejercicios almacenados.", $lang); unset($_SESSION['editar']); ?></p>
			<div class="hrr"></div><br>
			<div class="selector-user-gestion">
				<div class="row">
					<div class="col-md-4">
						<p> Consultar ejercicios de: </p>
					</div>
					<div class="col-md-8">
						<select class="user-tablas-gestion form-control"></select>
					</div>
					<div style="color: red; font-weight: bold">TODAVIA NO FUNCIONA EL FILTRADO. SE VEN LOS EJERCICIOS CREADOS POR EL USUARIO LOGUEADO</div>
				</div>
			</div>
			<div id="accordion ">
              <div class="card">  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered tablaListarEjercicios" style="text-align: center">  
                        <thead>
                          <tr>
                              <th>Descripcion</th>
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
                            $result = $ejer->getAllMisEjercicios($_SESSION['user']);    
                            include_once '../inc/solucion.php';
                            $sol = new Solucion();
                            while($fila = mysqli_fetch_array($result)){
                            	$resul_sol = $sol->getCuantosEjerciciosByName($fila['id_ejercicio']);
                            	$fila_sol = $resul_sol->fetch_array(MYSQLI_ASSOC);
                            ?>
                                <tr data-number="<?php echo $fila["id_ejercicio"] ?>">
                                  	<?php echo '<td>'.$fila['descripcion'].'</td>'; ?>
                                  	<?php echo '<td>'.$fila['nivel'].'</td>'; ?>
                                  	<?php echo '<td>'.$fila['tipo'].'</td>'; ?>
                                  	<?php echo '<td>'.$fila['creador_ejercicio'].'</td>'; ?>
                                  	<?php echo '<td id="rowVer" class="boton_ver_ejercicio" data-number='. $fila["id_ejercicio"] .'><a data-toggle="modal" href="#modalVerEejercicio"><i id="icon_ver" class="fa fa-eye" title="ver" aria-hidden="true"></i></a></td>'; ?>
									<?php if($fila['creador_ejercicio'] === $_SESSION['user']) {
											if( $fila_sol["cantidad"] === "0"){ ?>	
		                                  		<?php echo '<td id="rowEditarEjer" class="boton_editar_ejercicio" data-number='. $fila["id_ejercicio"] .'><a href="#editarEjercicio"><i id="icon_edit" class="fa fa-edit" title="editar" aria-hidden="true"></i></a></td>'; ?>
												<?php echo '<td  class="boton_borrar_ejercicio" data-number='. $fila['id_ejercicio'] .'><a href="#"><i id="icon_delete" class="fa fa-times" title="eliminar" aria-hidden="true"></i></a></td>'; ?>
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
			<br>
	  		<br>
	  		<br>	
		</div>
	</div>
</div>