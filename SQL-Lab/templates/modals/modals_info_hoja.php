<div class="modal fade" id="modalInfoHoja" tabindex="-1" role="dialog" aria-labelledby="modalInfoHojaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title" id="modalInfoHojaLabel"><?php echo trad('Información del ejercicio',$lang) ?></h4>
        </div>
        <div class="hrr"></div>
        <div class="modal-body">
        	<div class="form-row pt-4 ">
				<div class="col-md-12 info-hoja">

					<input type="text" name="h_id" id="infoHojaId" style="display: none">
					<div class="form-row pt-4">
						<div class="form-group col-md-12">
							<div class="panel panel-primary">
		                        <div class="panel-heading">
									<label for="name"> Nombre de la Hoja</label>
								</div>
								<div class="panel-footer">	
		  							<input type="text" id="infoHojaNombre" name="nombre" class="form-control" disabled />
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
					                     <table id="tabla_info_hoja_ejercicios" class="table table-striped table-bordered tablaInfoHoja" style="text-align: center">  
					                        <thead>
					                            <tr>
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
					<br>

				</div>

        	</div>	
    	</div>  
        <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Volver</button></div>  
      </div>
    </div>
</div>