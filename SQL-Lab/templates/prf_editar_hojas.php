<?php 

    require('languages.php');
    session_start();

    $lang = null;
    if(isset($_GET['lang'])){
      $lang = $_GET['lang'];
      $_SESSION['lang'] = $lang;
    }else{
      if(isset($_SESSION['lang'])){
        $lang = $_SESSION['lang'];
      }else{
        $_SESSION['lang'] = null;
      }
    }
    if(!isset($_SESSION['user'])){
    	header("Location: index.php");
    	exit;
    }
    header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/php charset=utf-8"/>
		<link href="../css/prueba.css" rel="stylesheet" type="text/css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <!-- <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	 -->
	    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	    <!-- <script defer src="https://use.fontawesome.com/releases/[VERSION]/js/all.js"></script> -->
  		<!-- <script defer src="https://use.fontawesome.com/releases/[VERSION]/js/v4-shims.js"></script> -->
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.js" ></script>
		<title>SQLab</title>
	</head>	
	<body>

		<?php include("modals/modals_cerrar_sesion.php"); ?>
		<?php include("modals/modals_ver_ejercicio.php"); ?>
		<?php include("navbar/navbar_menu_profesor.php"); ?>
		<div class="contenedor">
			
			<?php include("navbar/navbar_menu_lateral.php"); ?>
			<?php include("navbar/navbar_show_message.php"); ?>
			
			
			<!--CONTENEDOR -->
			<div class="container-center "> 
				<div class="adm-hojas">
					<div class="row ">		
						<div class="col-md-11 editar-hoja" id="editarHojaEjercicio">			
							<form class="jumbotron-propio" id="longSelect" method="post"> 

								<h3>Editar Hoja de Ejercicio</h3>
								<p class="pl-5">Puede insertar nuevos ejercicios a la hoja o borrar los que seleccione.</p>
								<div class="hrr"></div>
								
								<input type="text" name="h_id" value=<?php echo $_GET['id'] ?> style="display: none">
								<div name="he_id" id="editaHojaId" style="display: none" data-number=<?php echo $_GET['id'] ?> ></div>
								<div class="form-row pt-4">
									<div class="form-group col-md-12">
										<div class="panel panel-primary">
					                        <div class="panel-heading">
												<label for="name"> Nombre de la Hoja</label>
											</div>
											<div class="panel-footer">	
					  							<input type="text" id="editaHojaNombre" name="nombre" class="form-control" disabled />
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
								                     <table id="tabla_editar_hoja_ejercicios" class="table table-striped table-bordered tablaEditarHoja" style="text-align: center">  
								                        <thead>
								                            <tr>
								                            	<th class="primera"></th>
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
								<div class="form-row pr-4">	
									<div class="form-group col-md-3">
										<button class="btn btn-log btn-tertiary-border btn-block" type="reset" onclick="location.href = '../templates/prf_listar_hojas.php'"><?php echo trad( "Cancelar", $lang) ?></button>
									</div>
									<div class="form-group col-md-4 offset-1">
										<button class="btn btn-log btn-tertiary btn-block" name="borrar" id="borrarEjerDeHoja" data-number=<?php echo $_GET['id'] ?> ><?php echo trad( "Borrar seleccionados", $lang) ?></button>
									</div>
									<div class="form-group col-md-4">
										<div class="btn btn-log btn-tertiary btn-block" name="agregar" id="agregarEjerAHoja"><a href="../templates/prf_agregar_ejer_a_hoja.php" ><?php echo trad('Agregar nuevos',$lang) ?></a></div>
									</div>

						  		</div>
								<br>
								<br>
								<br>
						  		
					  		</form>
						  	
						</div>
					</div>
				</div>
			</div> 
		</div>
	<script type="text/javascript" src="../js/functions.js"></script>
	<script type="text/javascript" src="../js/editar_hoja_ejercicios.js"></script>
	</body>
	<footer class="footer py-3 text-center">
		<span>© 2018</span> <a id="pie" href="index_profesor.php">SQLab</a> 
		
	</footer>
</html>