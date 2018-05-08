<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title" id="myModalLabel"><?php echo trad('Iniciar Sesión',$lang) ?></h4>
        </div>
        <div class="hrr"></div>
        <div class="modal-body">
          <form method="post" action="../handler/validar_login.php">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEmail"><?php echo trad('Correo Electrónico',$lang) ?></label>  
                  <input type="email" name="email" id="inputEmail" class="form-control" placeholder=<?php echo trad('Correo Electrónico',$lang) ?> required/>
                </div>
                <div class="form-group col-md-12">
                  <label for="inputPassword"><?php echo trad('Contraseña',$lang) ?></label>
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder=<?php echo trad('Contraseña',$lang) ?> required />
                </div>
              </div>
              <div class="form-row">
                <a class="col-md-12 text-right" href="#myMoForgot" data-toggle="modal"><?php echo trad('¿Has olvidado la contraseña?',$lang) ?></a>
              </div>
              <div class="form-row">
                <a class="col-md-12 text-right" href="#myMoReg" data-toggle="modal"><?php echo trad('Regístrate',$lang) ?></a>
              </div>
              <div class="form-row">
                <button  type="submit" class="col-md-4 btn btn-log btn-tertiary btn-block"><?php echo trad('Entrar',$lang) ?></button>
              </div>
            </form>
        </div>    
      </div>
    </div>
</div>

 