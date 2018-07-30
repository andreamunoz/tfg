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
		<?php include("navbar/navbar_menu_profesor.php"); ?>
		<div class="contenedor">
			
			<?php include("navbar/navbar_menu_lateral.php"); ?>
			<?php include("navbar/navbar_show_message.php"); ?>
			
			
			<!--CONTENEDOR -->
			<div class="container-center "> 
				<div class="adm-ejercicios">
					<!-- <div class="row "> -->
						<div class="col-md-11 editar-ejercicio" id="editarEjercicio" >
							
								<form class="jumbotron-propio" id="longSelect" method="post" action="../handler/editar_ejercicio.php">
									<h3><?php echo trad( "Editar Ejercicio", $lang) ?></h3>
									<p class="pl-5"><?php echo trad( "Podrás editar algunos campos del ejercicio", $lang) ?>.</p>
									<div class="hrr"></div>
														
											<div class="form-row pt-4 ">
												<input type="text" name="ed_id" value=<?php echo $_GET['id']?> style="display: none">
												<div name="e_id" id="editaId" style="display: none" data-number=<?php echo $_GET['id']?> > </div>
												<div class="form-group col-md-4">
									  				<div class="panel panel-primary">
								                        <div class="panel-heading">
									  						<label for="duenoOld"><?php echo trad('Origen tablas',$lang) ?></label>	
									  					</div>
									  					<div class="panel-footer user_tablas" >	
									  						<input type="text" class="form-control" name="dueno" id="editaDueno" value="" readonly="readonly">
								  				
									  					</div>
									  				</div>
									  			</div>
									  			<div class="form-group col-md-4">
									  				<div class="panel panel-primary">
								                        <div class="panel-heading">
									  						<label for="tablasOld"><?php echo trad('Tablas usadas',$lang) ?></label>	
									  					</div>
									  					<div class="panel-footer columnas-tabla" >
									  						
									  						<input type="text" class="form-control" name="tablas" id="editaTablas" value="" readonly="readonly">					  				
									  					</div>
									  				</div>
									  			</div>
											</div>
									  		<!-- <div class="pt-4"><p>Datos que se pueden modificar: Categoría, nivel, estado, descripcion y solución. </p></div> -->
									  		<div class="form-row pt-2 ">
									  			<div class="form-group col-md-4">
									  				<div class="panel panel-primary">
								                        <div class="panel-heading">
															<label for="categoria"><?php echo trad('Categoría',$lang) ?><span class="red"> *</span></label>
														</div>	
														<div class="panel-footer" >
											  				<select type="text" id="editaCategoria" name="categoria" class="form-control" required>
											  					
											  				</select>
											  			</div>
											  		</div>
												</div>
												<div class="form-group col-md-4">
									  				<div class="panel panel-primary">
								                        <div class="panel-heading">
															<label for="nivel"><?php echo trad('Nivel',$lang) ?><span class="red"> *</span></label>
														</div>	
														<div class="panel-footer" >
											  				<select type="text" id="editaNivel" name="nivel" class="form-control" required>
											  					
											  				</select>
											  			</div>
											  		</div>
												</div>
												<div class="form-group col-md-4">
									  				<div class="panel panel-primary">
								                        <div class="panel-heading">
															<label for="deshabilitar"><?php echo trad(' Estado del ejercicio',$lang) ?><span class="red"> *</span></label>
														</div>	
														<div class="panel-footer" >
											  				<select type="text" id="editaDeshabilitar" name="deshabilitar" class="form-control" required>
											  					
											  				</select>
											  			</div>
											  		</div>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-12">
													<div class="panel panel-primary">
								                        <div class="panel-heading">
															<label for="descripcion"><?php echo trad('Descripcion',$lang) ?><span class="red"> *</span></label>
														</div>	
														<div class="panel-footer" >
															<input type="text" id="editaDescripcion" name="descripcion" class="form-control" placeholder=<?php echo trad('Descripcion breve aquí...',$lang) ?>  maxlength="50"  value="" required />
									  					</div>
									  				</div>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-6">
													<div class="panel panel-primary">
								                        <div class="panel-heading">
															<label for="enunciado"><?php echo trad( "Enunciado", $lang) ?><span class="red"> *</span></label>
														</div>	
														<div class="panel-footer" >
									  						<textarea  id="editaEnunciado" name="enunciado" class="form-control" rows="4" placeholder=<?php echo trad( "Escribe el enunciado aquí...", $lang) ?> required></textarea>
									  					</div>
									  				</div>
												</div>
												<div class="form-group col-md-6">
													<div class="panel panel-primary">
								                        <div class="panel-heading">
															<label for="solucion"><?php echo trad( "Solución", $lang) ?><span class="red"> *</span></label>
														</div>	
														<div class="panel-footer" >
									  						<textarea  id="editaSolucion" name="solucion" class="form-control" rows="4" placeholder=<?php echo trad( "Escribe la solución aquí...", $lang) ?> required></textarea>
									  					</div>
									  				</div>
												</div>
											</div>
									  		<div class="form-row">	
									  			<div class="form-group col-md-3">
													<button class="btn btn-log btn-tertiary-border btn-block" type="reset" onclick="location.href = '../templates/prf_listar_ejercicios.php'"><?php echo trad( "Cancelar", $lang) ?></button>
												</div>
												<div class="form-group col-md-3 offset-6 pr-4">
													<button class="btn btn-log btn-tertiary btn-block" type="submit"><?php echo trad( "Guardar cambios", $lang) ?></button>
												</div>
									  		</div>
								  		<!-- <?php //} 
								  		//unset($_SESSION['editar']);
								  		?> -->
								  	<br>
							  		<br>
							  		<br>
						  		</form>
						</div>
					<!-- </div> -->
				</div>
			</div> 
		</div>
	<script type="text/javascript" src="../js/functions.js"></script>
	<script type="text/javascript" src="../js/editar_ejercicio.js"></script>
	</body>
	<footer class="footer py-3 text-center">
		<span>© 2018</span> <a id="pie" href="index_profesor.php">SQLab</a> 
		
	</footer>
</html>