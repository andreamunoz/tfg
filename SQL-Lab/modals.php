


<!-- MODAL INICIAR SESION-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title" id="myModalLabel">Iniciar Sesión</h4>
        </div>
        <div class="hrr"></div>
        <div class="modal-body">
          <form method="post" action="inc/validar_login.php">
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

 <!-- MODAL REGISTRO USUARIO-->
<div class="modal fade" id="myMoReg" tabindex="-1" role="dialog" aria-labelledby="myModalRegLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalRegLabel" >Registro de usuario</h4>
        </div>
        <div class="hrr"></div>
        <div class="modal-body">
          <form >
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="name">Nombre</label>  
                  <input type="text" id="name" class="form-control" required />
              </div>
              <div class="form-group col-md-7">
                  <label for="apellido">Apellidos</label> 
                  <input type="text" id="apellido" class="form-control" required />
                </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-8">
                <label for="nom_usuario">Nombre de usuario</label> 
                  <input type="text" id="nom_usuario" class="form-control" required />
              </div>
              <div class="form-group col-md-4">
                  <label for="profe_alumno" required>Rol</label> 
                  <select type="text" id="profe_alumno" class="form-control" >
                  		<option value="profe">Profesor</option>
                  		<option value="alumno">Alumno</option>
                  </select> 
                </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail">Correo Electrónico</label>
                  <input type="email" id="inputEmail" class="form-control" required />
                </div>
                <div class="form-group col-md-12">
                  <label for="inputPassword">Contraseña</label>
                  <input type="password" id="inputPassword" class="form-control" required />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                <button class="btn btn-log btn-tertiary-border btn-block" data-dismiss="modal" >Cancelar</button>
              </div>
                <div class="form-group col-md-6">
                  <button class="btn btn-log btn-tertiary btn-block" type="submit" onclick="location.href='index_profesor.php'">Crear Cuenta</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
</div>

<!-- MODAL CERRAR SESION -->

<div class="modal fade" id="myMoCerrar" tabindex="-1" role="dialog" aria-labelledby="myModalRegLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalRegLabel" >¿Desea cerrar la sesión?</h4>
        </div>
        <div class="hrr"></div>
        <div class="modal-body">
          <form >
            
              <div class="form-row">
                <div class="form-group col-md-6">
                	<button class="btn btn-log btn-tertiary-border btn-block" data-dismiss="modal" >NO</button>
              	</div>
                <div class="form-group col-md-6">
                  <button class="btn btn-log btn-tertiary btn-block" type="submit" onclick="location.href='index_profesor.php'">SI</button>
                </div>
              </div>
           
          </form>
        </div>
      </div>
    </div>
</div>

