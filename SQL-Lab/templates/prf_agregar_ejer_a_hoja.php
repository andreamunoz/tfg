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
		<?php include("modals/modals_ver_ejercicio_Agregar.php"); ?>
		<?php include("navbar/navbar_menu_profesor.php"); ?>
		<div class="contenedor">
			
			<?php include("navbar/navbar_menu_lateral.php"); ?>
			<?php include("navbar/navbar_show_message.php"); ?>
			
			
			<!--CONTENEDOR -->
			<div class="container-center "> 
				<div class="adm-ejercicios">
					<div class="row ">

				        <h4><?php echo trad('Agregar ejercicios a la hoja',$lang) ?></h4>
				        
				        <div class="hrr" style="border: 2px solid #24609d"></div>
				        <form method="post" action="../handler/agregar_ejercicio_a_hoja.php"> 
							<div class="form-row pl-4">
								<div class="form-group col-md-12">
									<div class="panel panel-primary">
										<div id="accordion ">
							                <div class="card">  
							                    <div class="table-responsive">  
							                     <table id="tabla_agregar_ejer_hoja_ejercicios" class="table table-striped table-bordered">  
							                        <thead>
							                            <tr>
							                            	<th class="primera"></th>
							                                <th>Descripción</th>
							                                <th class="nivelAgregarEjer"><span class="cursorChange">Nivel <i class="fa fa-sort"></i></span></th>
							                                <th class="tipoAgregarEjer"><span class="cursorChange">Tipo <i class="fa fa-sort"></i></span></th>
							                                <th class="creadorAgregarEjer"><span class="cursorChange">Creador <i class="fa fa-sort"></i></span></th>
							                                <th>Ver</th>
							                          	</tr>
							                          </thead>
							                          <tbody >
							                            <?php 
							                            $id_hoja = $_SESSION['editar_hoja'];
							                            include_once '../inc/ejercicio.php';
							                            include_once '../inc/hoja_ejercicio.php';
							                            $he = new HojaEjercicio();
							                            $seleccionados = $he->getTodosIdEjerDeHoja($id_hoja);
							                            // var_dump($seleccionados);
							                            $ejer = new Ejercicio();
							                            $result = $ejer->getAllEjerciciosAutorizados();    
							                            
							                            while($fila = mysqli_fetch_array($result)){
							                            	// var_dump(intval($fila['id_ejercicio']));
							                            ?>
							                            <?php if($fila['deshabilitar'] === "0" && !in_array(intval($fila['id_ejercicio']), $seleccionados)){ ?>	
							                                <tr >
							                                	<?php echo '<td class="primera"><input type="checkbox" class="form-check-input" id="checkbox-editar-hoja" name="seleccionados[]" value='. $fila["id_ejercicio"] .'></td>'?>
							                                  	<?php echo '<td>'.$fila['descripcion'].'</td>'; ?>
							                                  	<?php echo '<td>'.$fila['nivel'].'</td>'; ?>
							                                  	<?php echo '<td>'.$fila['tipo'].'</td>'; ?>
							                                  	<?php echo '<td>'.$fila['creador_ejercicio'].'</td>'; ?>
																<?php echo '<td id="rowVerEjerAgregar" class="boton_ver_ejercicio" data-number='. $fila["id_ejercicio"] .'><a data-toggle="modal" href="#modalVerEejercicioAgregar"><i id="icon_ver" class="fa fa-eye" title="ver" aria-hidden="true"></i></a></td>'; ?>

							                                </tr>
															<?php } ?>	
							                            <?php                                 
							                            }
							                            ?>

							                          </tbody>
							                      </table>
							                    </div>  
							                </div> 
							              </div>
				  					</div>
								</div>
							</div>
					  		<div class="form-row pr-2">	
								<div class="form-group col-md-3 pl-4">
									<!-- <button class="btn btn-log btn-tertiary-border btn-block" type="reset"><?php //echo trad('Cancelar',$lang) ?></button> -->
									<button type="button" class="btn btn-log btn-tertiary-border btn-block" type="reset" onclick="location.href = '../templates/prf_listar_hojas.php'">Volver</button>
								</div>
								<div class="form-group col-md-5 offset-4 pr-3">
									<button class="btn btn-log btn-tertiary btn-block" name="agregar" type="submit"><?php echo trad('Agregar seleccionados',$lang) ?></button>
								</div>

					  		</div>
						  	<br>
 							<br>
 							<br>
 							<br>
						</form>
 					
				</div>
			</div> 
		</div>
	<script type="text/javascript" src="../js/functions.js"></script>
	</body>
	<footer class="footer py-3 text-center">
		<span>© 2018</span> <a id="pie" href="index_profesor.php">SQLab</a> 
		
	</footer>
</html>