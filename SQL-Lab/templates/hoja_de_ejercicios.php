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
				<h3 class="text-center" >HOJA DE EJERCICIOS</h3>
				<div class="hrr mb-3"></div>		
  				<div id="accordion">
						<div class="card">
							<?php 
							include_once '../inc/hoja_ejercicio.php';
							$ejer = new HojaEjercicio();
							$result = $ejer->getAllHojas();
									
							while($fila = mysqli_fetch_array($result)){
							?>
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
								<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<?php	
								echo $fila['nombre'];
								?>
								</button>
						      	</h5>
						      	 	
					      	</div>
					      	<div class="row">
						      		<div class="col-md-2 pl-5 pt-2">
						      			<p>NºEjercicios: 5</p> 
						      		</div>
						      		<div class="col-md-2 pl-5 pt-2">
						      			<p>Intentos: 2</p> 
						      		</div> 
						      	</div>    
							<?php } ?>						     						     								    	
						    <!--<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
							      <div class="card-body">
							        	<table class="table text-center">
											<tbody>
											    <tr>
											      <th scope="row">Ejercicio 1</th>
											      <td>Categoría 1</td>
											      <td>Intermedio</td>						  
											      	<td>					    
											      	<a id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
													<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true"></i></a>
											      	</td>
											    </tr>
											    <tr>
											      	<th scope="row">Ejercicio 2</th>
											      	<td>Categoría 2</td>
											      	<td>Avanzado</td>
													<td>
											      	<a id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
													<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true"></i></a>
											      </td>
											    </tr>
											    <tr>
											      	<th scope="row">Ejercicio 2</th>
											      	<td>Categoría 2</td>
											      	<td>Avanzado</td>
													<td>
											      	<a id="edit" href="#"><i id="icon_edit" class="fa fa-edit pr-3" title="editar" aria-hidden="true"></i></a>
													<a id="delete" href="#"><i id="icon_delete" class="fa fa-times pr-3" title="eliminar" aria-hidden="true"></i></a>
											      </td>
											    </tr>
											</tbody>
										</table>	
							      </div>
							    </div>-->
					</div>
				</div>
		</div>
	</body>
</html>