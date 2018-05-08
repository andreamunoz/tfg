<div class="modal fade" id="myMoCerrar" tabindex="-1" role="dialog" aria-labelledby="myModalRegLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalRegLabel" ><?php echo trad('¿Desea cerrar la sesión?',$lang) ?></h4>
        </div>
        <div class="hrr"></div>
        <div class="modal-body">
          <form> 
            
              <div class="form-row">
                <div class="form-group col-md-6">
                	<button class="btn btn-log btn-tertiary-border btn-block" data-dismiss="modal" ><?php echo trad('NO',$lang) ?></button>
              	</div>
                <div class="form-group col-md-6">
                  
                  <input type="button" class="btn btn-log btn-tertiary btn-block" value="<?php echo trad('SI',$lang) ?>" name="si" onclick="window.location.href='../handler/validar_logout.php'" />
                </div>
              </div>
           
          </form>
        </div>
      </div>
    </div>
</div>