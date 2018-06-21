<div class="adm-hojas">
	<div class="row ">
		
		<div class="col-md-11 crear-hoja ">			
			<form class="jumbotron-propio" id="longSelect" method="post" action="../handler/crear_hojaejercicios.php">
				<h3>Crear Hoja de Ejercicio</h3>
				<p class="pl-5">Añadir un nombre y después insertar ejercicios a la hoja.</p>
				<div class="hrr"></div>
				<div class="form-row pl-4 pr-4 pt-4">
					<div class="form-group col-md-12">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="name">Nombre de la Hoja<span class="red"> *</span></label>
							</div>
							<div class="panel-footer">	
	  							<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required />
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
							<div id="accordion ">
				                <div class="card">  
				                    <div class="table-responsive">  
				                     <table id="tabla_crear_hoja_ejercicios" class="table table-striped table-bordered">  
				                        <thead>
				                            <tr>
				                            	<th class="primera"></th>
				                                <th>Descripción</th>
				                                <th>Nivel</th>
				                                <th>Tipo</th>
				                                <th>Creador</th>
				                                <th>Ver</th>
				                          	</tr>
				                          </thead>
				                          <tbody >
				                            <?php 
				                            include_once '../inc/ejercicio.php';
				                            $ejer = new Ejercicio();
				                            $result = $ejer->getAllEjerciciosAutorizados();    
				                            
				                            while($fila = mysqli_fetch_array($result)){
				                            	
				                            ?>
				                            <?php if($fila['deshabilitar'] === "0"){ ?>	
				                                <tr >
				                                	<?php echo '<td class="primera"><input type="checkbox" class="form-check-input" id="checkbox-crear-hoja" name="seleccionados[]" value='. $fila["id_ejercicio"] .'></td>'?>
				                                  	<?php echo '<td>'.$fila['descripcion'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['nivel'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['tipo'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['creador_ejercicio'].'</td>'; ?>
													<?php echo '<td id="rowVer" class="boton_ver_ejercicio" data-number='. $fila["id_ejercicio"] .'><a data-toggle="modal" href="#modalVerEejercicio"><i id="icon_ver" class="fa fa-eye" title="ver" aria-hidden="true"></i></a></td>'; ?>

				                                </tr>
												<?php } ?>	
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
		  		<div class="form-row pr-4">	
					<div class="form-group col-md-3">
						<button class="btn btn-log btn-tertiary-border btn-block" type="reset"><?php echo trad('Cancelar',$lang) ?></button>
					</div>
					<div class="form-group col-md-3 offset-6 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" name="crear" type="submit"><?php echo trad('Crear hoja',$lang) ?></button>
					</div>

		  		</div>
	  		</form>
		  	<br>
		  	<br>
		  	<br>
		</div>
			
		<div class="col-md-11 editar-hoja" id="editarHojaEjercicio">			
			<form class="jumbotron-propio" id="longSelect" method="post"> <!--action="../handler/editar_hojaejercicios.php">-->

				<h3>Editar Hoja de Ejercicio</h3>
				<p class="pl-5">Puede insertar nuevos ejercicios a la hoja o borrar los que seleccione.</p>
				<div class="hrr"></div>
				
				<input type="text" name="h_id" id="editaHojaId" style="display: none">
				<div class="form-row pt-4">
					<div class="form-group col-md-12">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="name"> Nombre de la Hoja</label>
							</div>
							<div class="panel-footer">	
	  							<input type="text" id="editaHojaNombre" name="nombre" class="form-control" disabled />
	  						</div>
	  					</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<div class="panel panel-primary">
	                        <div class="panel-heading">
								<label for="name">Lista de Ejercicios</label>
							</div>
							<div id="accordion ">
				                <div class="card">  
				                    <div class="table-responsive">  
				                     <table id="tabla_editar_hoja_ejercicios" class="table table-striped table-bordered tablaEditarHoja" style="text-align: center">  
				                        <thead>
				                            <tr>
				                            	<th class="primera"></th>
				                                <th>Descripción</th>
				                                <th>Nivel</th>
				                                <th>Tipo</th>
				                                <th>Creador</th>
				                                <th>Ver</th>
				                                
				                          	</tr>
				                          </thead>
				                          <tbody >

				                          </tbody>
				                      </table>
				                    </div>  
				                </div> 
				              </div>
	  					</div>
					</div>
				</div>
				<br>
				<div class="form-row pr-4">	
					<div class="form-group col-md-3">
						<button class="btn btn-log btn-tertiary-border btn-block" type="reset" id="cancelar-editar-hoja"><?php echo trad( "Cancelar", $lang) ?></button>
					</div>
					<div class="form-group col-md-4 offset-1">
						<button class="btn btn-log btn-tertiary btn-block" name="borrar" id="borrarEjerDeHoja"><?php echo trad( "Borrar seleccionados", $lang) ?></button>
					</div>
					<div class="form-group col-md-4">
						<div class="btn btn-log btn-tertiary btn-block" name="agregar" id="agregarEjerAHoja"><a data-toggle="modal" href="#modalAgregarEjerAHoja" ><?php echo trad('Agregar nuevos',$lang) ?></a></div>
					</div>

		  		</div>
				<br>
				<br>
				<br>
		  		<!-- <div class="form-row pr-4">	
					<div class="form-group col-md-3">
						<button class="btn btn-log btn-tertiary-border btn-block" type="reset" onclick="location.href = '../templates/index_profesor.php'"><?php echo trad( "Cancelar", $lang) ?></button>
					</div>
					<div class="form-group col-md-3 offset-6 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" name="crear" type="submit"><?php echo trad('Guardar cambios',$lang) ?></button>
					</div>

		  		</div> -->
	  		</form>
		  	
		</div>	

		<div class="col-md-11 lista-hoja" id="listarHojaEjercicios">
			<form class="jumbotron-propio" id="longSelect" method="post" action="../handler/listar_hojasejercicios.php">
				<h3>Gestión de Hojas</h3>
				<p class="pl-5">Se podrán ver los ejercicios dentro de sus propias hojas.</p>
				<div class="hrr"></div><br>
  				<div id="accordion ">
	                <div class="card">  
	                    <div class="table-responsive">  
	                     <table id="table-listar-hojas" class="table table-striped table-bordered">  
	                        <thead>
	                            <tr>
	                              <th style="width: 30%">Nombre Hoja</th>
	                              <th class="nombreProfListar" style="width: 27%"><span class="cursorChange">Nombre Profesor  <i class="fa fa-sort"></i></span></th>
	                              <th style="width: 13%">N. Ejercicios </th>
	                              <th style="width: 10%; text-align: center"></th>
	                              <th style="width: 10%; text-align: center"></th>
	                              <th style="width: 10%; text-align: center"></th>
	                            </tr>
	                          </thead>
	                          <tbody >
	                            <!-- <?php 
	                            include_once '../inc/hoja_ejercicio.php';
	                            include_once '../inc/esta_contenido.php';
	                            $hojaejer = new HojaEjercicio();
	                            $result = $hojaejer->getAllHojas();
	                            if(isset($result)){

	                              while($fila_hoja = mysqli_fetch_array($result)){  
	                            ?>
	                            
	                              <tr class="accordion-toggle" id="show-accordion" >
	                              <?php echo '<td data-toggle="collapse" data-target="#collapse_'.$fila_hoja['id_hoja'].'">'.$fila_hoja['nombre_hoja'].'</td>'; ?>
	                             
	                              <?php echo '<td data-toggle="collapse" data-target="#collapse_'.$fila_hoja['id_hoja'].'">'.$fila_hoja['creador_hoja'].'</td>'; ?>
	                              <?php $number = new EstaContenido();
	                              $id_hoja = $fila_hoja['id_hoja'];
	                              $row_number = $number->getNumberEjerciciosByHoja($id_hoja); 
	                              echo '<td data-toggle="collapse" data-target="#collapse_'.$fila_hoja['id_hoja'].'">'.$row_number["COUNT(id_ejercicio)"].'</td>'; ?>
	                              <?php echo '<td  id="rowInfoHoja" class="boton_info_hoja" data-number='. $fila_hoja["id_hoja"] .'><a href="#">+Info</a></td>'; ?>
	                              <?php if ($fila_hoja['creador_hoja'] === $_SESSION['user']){
	                               		echo '<td id="rowEditarHoja" data-number="'.$fila_hoja['id_hoja'].'"><a href="#editar-hoja-'.$fila_hoja['id_hoja'].'">Editar</a></td>'; 
	                               		echo '<td id="rowBorrarHoja" data-number="'.$fila_hoja['id_hoja'].'"><a href="#borrar-hoja-'.$fila_hoja['id_hoja'].'">Borrar</a></td>';	
	                               }else{
	                               		echo '<td></td>';
	                               		echo '<td></td>';
	                               }?>
	                            </tr>
	                            
	                            <?php }                                   
	                            }
	                            ?> -->

	                          </tbody>
	                      </table>
	                    </div>  
	                </div> 
              	</div>
			</form>
		</div>

	</div>
</div>