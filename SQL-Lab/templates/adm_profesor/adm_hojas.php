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
								<label for="name">Nombre de la Hoja</label>
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
				                                <th>Nombre Ejercicio</th>
				                                <th>Enunciado</th>
				                                <th>Nivel</th>
				                                <th>Tipo</th>
				                                <th>Creador</th>
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
				                                <tr>
				                                	<?php echo '<td class="primera"><input type="checkbox" class="form-check-input" id="checkbox-crear-hoja" name="seleccionados[]" value='. $fila["id_ejercicio"] .'></td>'?>
				                                  	<?php echo '<td><p>Ejercicio '.$fila['id_ejercicio'].'</p></td>'; ?>
				                                  	<?php echo '<td>'.$fila['enunciado'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['nivel'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['tipo'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['creador_ejercicio'].'</td>'; ?>

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
		  	
		</div>
				

		<div class="col-md-11 lista-hoja">
			<form class="jumbotron-propio" id="longSelect" method="post" action="../handler/listar_hojasejercicios.php">
			<h3>Lista de Hojas</h3>
			<p class="pl-5">Se podrán ver los ejercicios dentro de sus propias hojas.</p>
			<div class="hrr"></div>
			<div class="form-row pl-4 pr-4 pt-4">
				<div class="form-group col-md-12">
					<div class="panel panel-primary">
                        <div class="panel-heading">
							<label for="lista_hojas">Lista de Hojas</label>
						</div>
						<div class="panel-footer">	
  							<div id="accordion ">
                <div class="card">  
                    <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                        <thead>
                            <tr>
                              <th style="width: 40%">Nombre Hoja</th>
                              <th style="width: 20%">Nombre Profesor</th>
                              <th style="width: 20%">N. Ejercicios</th>
                              <th style="width: 10%"></th>
                              <th style="width: 10%"></th>
                            </tr>
                          </thead>
                          <tbody >
                            <?php 
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
                              <?php echo '<td><a href="hoja_ejercicio.php?hoja='.$fila_hoja['id_hoja'].'">+Info</a></td>'; ?>
                              <?php if ($fila_hoja['creador_hoja'] === $_SESSION['user']){
                               		echo '<td class="boton_editar_hojaejercicio" data-number="'.$fila_hoja['id_hoja'].'"><a href="#">Editar</a></td>'; 	
                               }else{
                               		echo '<td></td>';
                               }?>
                            </tr>
                            
                            <?php }                                   
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
			</div>
			</form>
		</div>
	</div>
</div>