<div class="modal fade" id="myMoReg" tabindex="-1" role="dialog" aria-labelledby="myModalRegLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalRegLabel" ><?php echo trad('Registro de usuario',$lang) ?></h4>
        </div>
        <div class="hrr"></div>
        <div class="modal-body">
          <form method="post" action="../handler/validar_registro.php">
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="name"><?php echo trad('Nombre',$lang) ?></label>  
                  <input type="text" id="name" name="nombre" class="form-control" required />
              </div>
              <div class="form-group col-md-7">
                  <label for="apellido"><?php echo trad('Apellidos',$lang) ?></label> 
                  <input type="text" id="apellido" name="apellidos" class="form-control" required />
                </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-8">
                <label for="nom_usuario"><?php echo trad('Nombre de usuario',$lang) ?></label> 
                  <input type="text" id="nom_usuario" name="nombre_usuario" class="form-control" required />
              </div>
              <div class="form-group col-md-4">
                  <label for="profe_alumno" required><?php echo trad('Rol',$lang) ?></label> 
                  <select type="text" id="profe_alumno" name="profe_alumno" class="form-control" onclick="cambiaRol()">
                  		<option value="alumno"><?php echo trad('Alumno',$lang) ?></option>
                      <option value="profe"><?php echo trad('Profesor',$lang) ?></option>
                  </select> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                  <input type="checkbox" id="myCheck" name="checkAutoriza" style="display: none;" value="1">
                  <span id="myCheckText" style="display: none"> <?php echo trad('Permito a otros profesores usar las tablas creadas por mí',$lang) ?>.</span>
                </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail"><?php echo trad('Correo Electrónico',$lang) ?></label>
                  <input type="email" id="inputEmail" name="email" class="form-control" required />
                </div>
                <div class="form-group col-md-12">
                  <label for="inputPassword"><?php echo trad('Contraseña',$lang) ?></label>
                  <input type="password" id="inputPassword" name="password" class="form-control" required />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                <button class="btn btn-log btn-tertiary-border btn-block" data-dismiss="modal" ><?php echo trad('Cancelar',$lang) ?></button>
              </div>
                <div class="form-group col-md-6">
                  <button class="btn btn-log btn-tertiary btn-block" type="submit"><?php echo trad('Crear Cuenta',$lang) ?></button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
</div>
<script>
function cambiaRol() {
    var rol = document.getElementById("profe_alumno");
    var myCheck = document.getElementById("myCheck");
    if (rol.value == "profe"){
        myCheck.style.display = "inline-block";
        myCheckText.style.display = "inline-block";
    } else {
       myCheck.style.display = "none";
       myCheckText.style.display = "none";
    }
}
</script>


