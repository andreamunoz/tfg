<div class="modal fade" id="modalAgregarEjerAHoja" tabindex="-1" role="dialog" aria-labelledby="modalAgregarEjercicioHojaLabel" aria-hidden="true" style="overflow-y: scroll;" >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title" id="modalAgregarEjerAHojaLabel"><?php echo trad('Agregar ejercicios a la hoja',$lang) ?></h4>
        </div>
        
        <div class="hrr" style="border: 2px solid #24609d"></div>
        <div class="modal-body"> 
        	<form method="post" action="../handler/agregar_ejercicio_a_hoja.php"> 
				<div class="form-row pl-4">
					<div class="form-group col-md-12">
						<div class="panel panel-primary">
							<div id="accordion ">
				                <div class="card">  
				                    <div class="table-responsive">  
				                     <table id="tabla_agregar_ejer_hoja_ejercicios" class="table table-striped table-bordered">  
				                        <thead>
				                            <tr>
				                            	<th class="primera"></th>
				                                <th>Descripción</th>
				                                <th class="nivelAgregarEjer"><span class="cursorChange">Nivel <i class="fa fa-sort"></i></span></th>
				                                <th class="tipoAgregarEjer"><span class="cursorChange">Tipo <i class="fa fa-sort"></i></span></th>
				                                <th class="creadorAgregarEjer"><span class="cursorChange">Creador <i class="fa fa-sort"></i></span></th>
				                                <th>Ver</th>
				                          	</tr>
				                          </thead>
				                          <tbody >
				                            <?php 
				                            $id_hoja = $_SESSION['editar_hoja'];
				                            include_once '../inc/ejercicio.php';
				                            include_once '../inc/hoja_ejercicio.php';
				                            $he = new HojaEjercicio();
				                            $seleccionados = $he->getTodosIdEjerDeHoja($id_hoja);
				                            // var_dump($seleccionados);
				                            $ejer = new Ejercicio();
				                            $result = $ejer->getAllEjerciciosAutorizados();    
				                            
				                            while($fila = mysqli_fetch_array($result)){
				                            	// var_dump(intval($fila['id_ejercicio']));
				                            ?>
				                            <?php if($fila['deshabilitar'] === "0" && !in_array(intval($fila['id_ejercicio']), $seleccionados)){ ?>	
				                                <tr >
				                                	<?php echo '<td class="primera"><input type="checkbox" class="form-check-input" id="checkbox-editar-hoja" name="seleccionados[]" value='. $fila["id_ejercicio"] .'></td>'?>
				                                  	<?php echo '<td>'.$fila['descripcion'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['nivel'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['tipo'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['creador_ejercicio'].'</td>'; ?>
													<?php echo '<td id="rowVerEjerAgregar" class="boton_ver_ejercicio" data-number='. $fila["id_ejercicio"] .'><a data-toggle="modal" href="#modalVerEejercicioAgregar"><i id="icon_ver" class="fa fa-eye" title="ver" aria-hidden="true"></i></a></td>'; ?>

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
					<div class="form-group col-md-3 pl-4">
						<!-- <button class="btn btn-log btn-tertiary-border btn-block" type="reset"><?php echo trad('Cancelar',$lang) ?></button> -->
						<button type="button" class="btn btn-log btn-tertiary-border btn-block" data-dismiss="modal">Volver</button>
					</div>
					<div class="form-group col-md-4 offset-5 pr-4">
						<button class="btn btn-log btn-tertiary btn-block" name="agregar" type="submit"><?php echo trad('Agregar seleccionados',$lang) ?></button>
					</div>

		  		</div>
			</form>
        </div>  
        <!-- <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Volver</button></div>   -->
      </div>
    </div>
</div>