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
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/php charset=utf-8"/>
		<link href="../css/prueba.css" rel="stylesheet" type="text/css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	

	    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	    <script defer src="https://use.fontawesome.com/releases/[VERSION]/js/all.js"></script>
  		<script defer src="https://use.fontawesome.com/releases/[VERSION]/js/v4-shims.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

		<title>SQLab</title>
	</head>	
	<body>
		<?php include("modals/modals_cerrar_sesion.php"); ?>
		<?php include("navbar/navbar_menu_alumno.php"); ?>
		<div class="container pt-4">
			<?php $hojaparameter = $_GET['hoja']; ?>
			<h2><?php echo 'Hoja '.$hojaparameter ?></h2>
			<div class="hrr mt-3 mb-3"></div>

			<div class="row pt-4 pb-4">
				<div class="col-md-3  offset-9">
					 <div class="progress">
					 <?php   
					 	include_once '../inc/hoja_ejercicio.php';
						$hojaejer = new HojaEjercicio();
						$res = $hojaejer->getIdByName($hojaparameter);
					 	$idHoja = $res['id_hoja'];

					 	include_once '../inc/esta_contenido.php';
					 	$estaCon = new EstaContenido();
					 	$r = $estaCon->getNumEjercicios($idHoja);

					 	include_once '../inc/estadisticas.php';
                        $contenido = new Estadisticas(); 
                        $rCon = $contenido->getPorcentajeAciertos($idHoja);

                        if($rCon['veredicto'] > '0'){                    
                       		$resultadoDec = ($rCon['veredicto'] / $r['num']) * 100;
                       		$resultado = round($resultadoDec);
                       		echo '<div class="progress-bar" role="progressbar" aria-valuenow="70"
					  aria-valuemin="0" aria-valuemax="100" style="width:'.$resultado.'%"><p>'.$resultado.'%</p>
					  </div>';                 	
                       	}else{
                       		echo '<div class="progress-bar" role="progressbar" aria-valuenow="0"
					  aria-valuemin="0" aria-valuemax="100" style="width:0%"><p>0%</p>
					  </div>'; }					
					  ?>
					</div> 
				</div>
			</div>			
  			<div id="accordion">
				<div class="card">
					<table id="myTable" class="table table-hover tablesorter">
						<thead>
							<tr>
							    <th>Nombre Ejercicio</th>
							    <th>Nivel</th>
							    <th>Tipo</th>
							    <th>Profesor</th>
							    <th>Ultima Modificación</th>
							    <th>Intentos</th>
							    <th></th>

							</tr>
						</thead>
						<tbody>
							<?php 
							
							$id_h = $res['id_hoja'];
							include_once '../inc/ejercicio.php';
							$ejer = new Ejercicio();
							$result = $ejer->getEjerciciosHoja($id_h);
							include_once '../inc/solucion.php';
							$sol = new Solucion();		
							while($fila = mysqli_fetch_array($result)){
							?>

								<?php $id = $fila['id_ejercicio'];
								$solucion = $sol->getAllEjerciciosByName($id);

								$fila_sol = mysqli_fetch_array($solucion);
									if($fila_sol['veredicto']=='1'){
								?>
									<tr class="border-veredictoV">
								<?php } else if($fila_sol['veredicto']=='0') { ?>
										<tr class="border-veredictoR">
								<?php } else { ?>
										<tr class="border-veredictoA">	
										<?php } ?>	
										<?php echo '<td>Ejercicio '.$fila['id_ejercicio'].'</td>'; ?>
										<?php echo '<td>'.$fila['nivel'].'</td>'; ?>
										<?php echo '<td>'.$fila['tipo'].'</td>'; ?>
										<?php echo '<td>'.$fila['creador_ejercicio'].'</td>'; ?>
										 
										<?php if($fila_sol['fecha']) 
												echo '<td>'.$fila_sol['fecha'].'</td>'; 
											  else
											  	echo '<td>No tiene última modificación</td>'; 
										?>
										<?php if($fila_sol['intentos']) 
												echo '<td>'.$fila_sol['intentos'].'</td>'; 
											  else
											  	echo '<td>0</td>'; 
										?>

										<?php echo '<td><a href="realizar_ejercicio.php?ejercicio='.$fila['id_ejercicio'].'">Ver</a></td>'; ?>

									</tr>

							<?php  					     				     			
							}
							?>
							
						</tbody>
					</table>									    		
				</div>
			</div>
		</div>
	</body>
</html>