<div class="modal fade" id="myMoReg" tabindex="-1" role="dialog" aria-labelledby="myModalRegLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalRegLabel" >Registro de usuario</h4>
        </div>
        <div class="hrr"></div>
        <div class="modal-body">
          <form method="post" action="../handler/validar_registro.php">
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="name">Nombre</label>  
                  <input type="text" id="name" name="nombre" class="form-control" required />
              </div>
              <div class="form-group col-md-7">
                  <label for="apellido">Apellidos</label> 
                  <input type="text" id="apellido" name="apellidos" class="form-control" required />
                </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-8">
                <label for="nom_usuario">Nombre de usuario</label> 
                  <input type="text" id="nom_usuario" name="nombre_usuario" class="form-control" required />
              </div>
              <div class="form-group col-md-4">
                  <label for="profe_alumno" required>Rol</label> 
                  <select type="text" id="profe_alumno" name="profe_alumno" class="form-control" >
                  		<option value="profe">Profesor</option>
                  		<option value="alumno">Alumno</option>
                  </select> 
                </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail">Correo Electrónico</label>
                  <input type="email" id="inputEmail" name="email" class="form-control" required />
                </div>
                <div class="form-group col-md-12">
                  <label for="inputPassword">Contraseña</label>
                  <input type="password" id="inputPassword" name="password" class="form-control" required />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                <button class="btn btn-log btn-tertiary-border btn-block" data-dismiss="modal" >Cancelar</button>
              </div>
                <div class="form-group col-md-6">
                  <button class="btn btn-log btn-tertiary btn-block" type="submit">Crear Cuenta</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
</div>


