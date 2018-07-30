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
				<div class="adm-ejercicios">
					<div class="row ">
										  	
						<div class="col-md-11 jumbotron-propio lista-ejercicio" id="listarEjercicios">
							<h3><?php echo trad( "Gestión de Ejercicios", $lang) ?></h3>
							<p class="pl-5"><?php echo trad( "Aquí se muestran todos los ejercicios almacenados.", $lang); unset($_SESSION['editar']); ?></p>
							<div class="hrr"></div><br>
							<div class="selector-user-gestion">
								<div class="row">
									<div class="col-md-4">
										<p> Consultar ejercicios de: </p>
									</div>
									<div class="col-md-8">
										<select class="user-tablas-gestion form-control"></select>
									</div>
									<div style="color: red; font-weight: bold">TODAVIA NO FUNCIONA EL FILTRADO. SE VEN LOS EJERCICIOS CREADOS POR EL USUARIO LOGUEADO</div>
								</div>
							</div>
							<div id="accordion ">
				              <div class="card">  
				                <div class="table-responsive">  
				                     <table id="employee_data" class="table table-striped table-bordered tablaListarEjercicios" style="text-align: center">  
				                        <thead>
				                          <tr>
				                              <th>Descripcion</th>
				                              <th>Nivel</th>
				                              <th>Tipo</th>
				                              <th>Creador</th>
				                              <th>Ver</th>
				                              <th></th>
				                              <th></th>
				                          </tr>
				                        </thead>
				                        <tbody>
				                            <?php 
				                            include_once '../inc/ejercicio.php';
				                            $ejer = new Ejercicio();
				                            $result = $ejer->getAllMisEjercicios($_SESSION['user']);    
				                            include_once '../inc/solucion.php';
				                            $sol = new Solucion();
				                            while($fila = mysqli_fetch_array($result)){
				                            	$resul_sol = $sol->getCuantosEjerciciosByName($fila['id_ejercicio']);
				                            	$fila_sol = $resul_sol->fetch_array(MYSQLI_ASSOC);
				                            ?>
				                                <tr data-number="<?php echo $fila["id_ejercicio"] ?>">
				                                  	<?php echo '<td>'.$fila['descripcion'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['nivel'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['tipo'].'</td>'; ?>
				                                  	<?php echo '<td>'.$fila['creador_ejercicio'].'</td>'; ?>
				                                  	<?php echo '<td id="rowVer" class="boton_ver_ejercicio" data-number='. $fila["id_ejercicio"] .'><a data-toggle="modal" href="#modalVerEejercicio"><i id="icon_ver" class="fa fa-eye" title="ver" aria-hidden="true"></i></a></td>'; ?>
													<?php if($fila['creador_ejercicio'] === $_SESSION['user']) {
															if( $fila_sol["cantidad"] === "0"){ ?>	
						                                  		<?php echo '<td id="rowEditarEjer" class="boton_editar_ejercicio" data-number='. $fila["id_ejercicio"] .'><a href="../templates/prf_editar_ejercicio.php?id='. $fila["id_ejercicio"] .'"><i id="icon_edit" class="fa fa-edit" title="editar" aria-hidden="true"></i></a></td>'; ?>
																<?php echo '<td  class="boton_borrar_ejercicio" data-number='. $fila['id_ejercicio'] .'><a href="#"><i id="icon_delete" class="fa fa-times" title="eliminar" aria-hidden="true"></i></a></td>'; ?>
															<?php }else{ 
																if($fila['deshabilitar'] === "0"){ ?>
																	<?php echo '<td colspan="2" class="boton_deshabilitar_ejercicio" data-number='. $fila["id_ejercicio"] .'><a href="#">Deshabilitar</a></td>'; ?>
																<?php }else{ ?>
																	<?php echo '<td colspan="2" class="boton_habilitar_ejercicio" data-number='. $fila["id_ejercicio"] .'><a href="#">Habilitar</a></td>'; ?>
																<?php } ?>
															<?php } ?>
													<?php } else{?>
														<td colspan="2"></td>
													<?php } ?>	

				                                </tr>
				                            <?php                                 
				                            }
				                            ?>
				                        </tbody>
				                      </table>
				                    </div>  
				                </div> 
				            </div> 	
							<br>
					  		<br>
					  		<br>	
						</div>
					</div>
				</div>
			</div> 
		</div>
	<script type="text/javascript" src="../js/functions.js"></script>
	</body>
	<footer class="footer py-3 text-center">
		<span>© 2018</span> <a id="pie" href="index_profesor.php">SQLab</a> 
		
	</footer>
</html>