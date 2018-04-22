<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title" id="myModalLabel">Iniciar Sesión</h4>
        </div>
        <div class="hrr"></div>
        <div class="modal-body">
          <form method="post" action="../handler/validar_login.php">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEmail">Correo Electrónico</label>  
                  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required/>
                </div>
                <div class="form-group col-md-12">
                  <label for="inputPassword">Contraseña</label>
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required />
                </div>
              </div>
              <div class="form-row">
                <a class="col-md-12 text-right" href="#myMoReg" data-toggle="modal">¿Has olvidado la contraseña?</a>
              </div>
              <div class="form-row">
                <a class="col-md-12 text-right" href="#myMoReg" data-toggle="modal">Registrate</a>
              </div>
              <div class="form-row">
                <button  type="submit" class="col-md-4 btn btn-log btn-tertiary btn-block">Sign in</button>
              </div>
            </form>
        </div>    
      </div>
    </div>
</div>

 