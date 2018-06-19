<div class="modal fade" id="modalVerEjercicioInfo" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="modalVerEjercicioInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title" id="modalVerEjercicioInfoLabel"><?php echo trad('Información del ejercicio',$lang) ?></h4>
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
                        <p id="verIDueno"></p>             
                      </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="panel panel-primary">
                                <div class="panel-heading">
                        <label for="tablas"><?php echo trad('Tablas usadas',$lang) ?></label> 
                      </div>
                      <div class="panel-footer columnas-tabla" >
                        <p id="verITablas"></p>             
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
                        <p id="verICategoria"></p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <label for="nivel"><?php echo trad('Nivel',$lang) ?></label>
                        </div>  
                        <div class="panel-footer" >
                          <p id="verINivel"></p>
                        </div>
                      </div>
                  </div>
                  <div class="form-group col-md-4">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                            <label for="deshabilitar"><?php echo trad(' Estado del ejercicio',$lang) ?></label>
                          </div>  
                          <div class="panel-footer" >
                            <p id="verIDeshabilitar"></p>
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
                      <p id="verIDescripcion"></p>
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
                      <p id="verIEnunciado"></p>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <label for="solucion"><?php echo trad( "Solución", $lang) ?></label>
                    </div>  
                    <div class="panel-footer" >
                      <p id="verISolucion"></p>
                    </div>
                  </div>
                </div>
              </div>
        </div>  
        <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal" id="volverAlModalI">Volver</button></div>  
      </div>
    </div>
</div>

 