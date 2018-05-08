<div class="modal fade" id="myMoForgot" tabindex="-1" role="dialog" aria-labelledby="myModalForgotLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalForgotLabel" ><?php echo trad('¿Has olvidado la contraseña?',$lang) ?></h4>
        </div>
        <div class="hrr"></div>
        <div class="modal-body">
          <form> 
            <div class="form-row">
              <div class="form-group col-md-12">
                <input type="email" name="email" class="form-control" placeholder=<?php echo trad('Correo Electrónico',$lang) ?> required>
              </div>
            </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                	<button class="btn btn-log btn-tertiary-border btn-block" data-dismiss="modal" ><?php echo trad('NO',$lang) ?></button>
              	</div>
                <div class="form-group col-md-6">
                  
                  <input type="button" class="btn btn-log btn-tertiary btn-block" value="<?php echo trad('SI',$lang) ?>" name="si" onclick="window.location.href='../handler/validar_olvido_pwd.php'" />
                </div>
              </div>
           
          </form>
        </div>
      </div>
    </div>
</div>