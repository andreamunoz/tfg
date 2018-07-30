<div class="modal fade" id="modalVerEejercicioAgregar" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="modalVerEjercicioAgregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title" id="modalVerEjercicioAgregarLabel"><?php echo trad('Información del ejercicio',$lang) ?></h4>
        </div>
        <div class="hrr"></div>
        <div class="modal-body">  
              <div class="form-row pt-4 ">
                <div class="form-group col-md-4">
                    <div class="panel panel-primary">
                                <div class="panel-heading">
                        <label for="dueno"><?php echo trad('Origen tablas',$lang) ?></label> 
                      </div>
                      <div class="panel-footer user_tablas" >
                        <p id="verADueno"></p>             
                      </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="panel panel-primary">
                                <div class="panel-heading">
                        <label for="tablas"><?php echo trad('Tablas usadas',$lang) ?></label> 
                      </div>
                      <div class="panel-footer columnas-tabla" >
                        <p id="verATablas"></p>             
                      </div>
                    </div>
                </div>
              </div>
          
                <div class="form-row pt-2 ">
                  <div class="form-group col-md-4">
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <label for="categoria"><?php echo trad('Categoría',$lang) ?></label>
                      </div>  
                      <div class="panel-footer" >
                        <p id="verACategoria"></p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <label for="nivel"><?php echo trad('Nivel',$lang) ?></label>
                        </div>  
                        <div class="panel-footer" >
                          <p id="verANivel"></p>
                        </div>
                      </div>
                  </div>
                  <div class="form-group col-md-4">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                            <label for="deshabilitar"><?php echo trad(' Estado del ejercicio',$lang) ?></label>
                          </div>  
                          <div class="panel-footer" >
                            <p id="verADeshabilitar"></p>
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
                      <p id="verADescripcion"></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <label for="enunciado"><?php echo trad( "Enunciado", $lang) ?></label>
                    </div>  
                    <div class="panel-footer" >
                      <p id="verAEnunciado"></p>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <label for="solucion"><?php echo trad( "Solución", $lang) ?></label>
                    </div>  
                    <div class="panel-footer" >
                      <p id="verASolucion"></p>
                    </div>
                  </div>
                </div>
              </div>
        </div>  
        <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal" id="volverAlModal">Volver</button><a data-toggle="modal" href="../templates/prf_editar_ejercicio.php?id=" + <?php echo $_SESSION["editar_hoja"]  ?> ></div>  
      </div>
    </div>
</div>

 