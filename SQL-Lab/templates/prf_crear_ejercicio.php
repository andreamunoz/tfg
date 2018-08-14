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
					<div class="row ">
						<div class="col-md-11 crear-ejercicio">	
							<form class="jumbotron-propio" id="longSelect" method="post" action="../handler/crear_ejercicio.php">
								<h3 id="userPrincipal" data-name="<?php echo $_SESSION['user']; ?>"><?php echo trad('Crear Ejercicio',$lang) ?></h3>
								<p class="pl-5"><?php echo trad('Indicar el propietario de las tablas que se desean utilizar así como la categoría y nivel del ejercicio, una descripción que sirva de ayuda al alumno, elenunciado y una solución.',$lang) ?></p>
								<div class="hrr"></div>
								<div class="form-row pt-4 ">
									<div class="form-group col-md-4">
										<div class="panel panel-primary">
					                        <div class="panel-heading">
						  						<label for="user_tablas"><?php echo trad('Origen tablas',$lang) ?><span class="red"> *</span></label>	
						  					</div>
						  					<div class="panel-footer selector-user" >
												
						  						<select id="user_tablas" name="user_tablas" class="form-control" required></select>
								  				
						  					</div>
						  				</div>
						  			</div>
						  			<div class="form-group col-md-4" style="margin-bottom: 0 !important">
						  				<div class="panel panel-primary">
					                        <div class="panel-heading">
						  						<label for="tablas"><?php echo trad('Tablas',$lang) ?></label>	
						  					</div>
						  					<div class="panel-footer selector-tabla" >
						  						<select multiple="" type="text" id="tablas" name="tablas[]" size="4" class="form-control"></select>				  				
						  					</div>
						  				</div>
						  			</div>
						  			<div class="form-group col-md-4">
						  				<div class="panel panel-primary">
					                        <div class="panel-heading">
						  						<label for="tablas"><?php echo trad('Columnas tabla',$lang) ?></label>	
						  					</div>
						  					<div class="panel-footer columnas-tabla" >
						  						<table id="columnas" class="form-control" ><tbody></tbody></table>			  				
						  					</div>
						  				</div>
						  			</div>
						  		</div>
						  		<div class="form-row pt-2 ">
						  			<div class="form-group col-md-4">
						  				<div class="panel panel-primary">
					                        <div class="panel-heading">
												<label for="categoria"><?php echo trad('Categoría',$lang) ?><span class="red"> *</span></label>
											</div>	
											<div class="panel-footer" >
								  				<select type="text" id="categoria" name="categoria" class="form-control" required>
								  					<?php 
								  						include_once '../inc/ejercicio.php';
								  						$ejer = new Ejercicio();
												        $resultado = $ejer->getCategorias();
													    foreach ($resultado as $key => $value) { 
													    	$newKey = "c".($key+1);
													    	if (isset($_SESSION['guardarDatos'])) {
															    if($newKey === $_SESSION['guardarDatos'][1]){ ?>
															    	<option value=<?php echo $newKey ?> selected="selected"> <?php echo $value ?> </option>
															    <?php } else{ ?>
																	<option value=<?php echo $newKey ?> > <?php echo $value ?> </option>
															    <?php } 
															} else { ?>
																<option value=<?php echo $newKey ?> > <?php echo $value ?> </option>
															<?php }	
													 	} ?> 
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
								  				<select type="text" id="nivel" name="nivel" class="form-control" required>
								  					<?php if (isset($_SESSION['guardarDatos'])) { 
								  						if( $_SESSION['guardarDatos'][2] === "facil"){ ?>
								  							<option value="facil" selected="selected"><?php echo trad('Principiante',$lang) ?></option>
									  						<option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
									  						<option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>
													<?php } else if( $_SESSION['guardarDatos'][2] === "medio"){ ?>
															<option value="facil"><?php echo trad('Principiante',$lang) ?></option>
									  						<option value="medio" selected="selected"><?php echo trad('Intermedio',$lang) ?></option>
									  						<option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>
													<?php } else if( $_SESSION['guardarDatos'][2] === "dificil"){ ?>
															<option value="facil"><?php echo trad('Principiante',$lang) ?></option>
										  					<option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
										  					<option value="dificil" selected="selected"><?php echo trad('Avanzado',$lang) ?></option>
								  					<?php } 
								  					}else { ?>
									  					<option value="facil"><?php echo trad('Principiante',$lang) ?></option>
									  					<option value="medio"><?php echo trad('Intermedio',$lang) ?></option>
									  					<option value="dificil"><?php echo trad('Avanzado',$lang) ?></option>
								  					<?php 	} ?>			  	
								  				</select>
								  			</div>
								  		</div>
									</div>
									<div class="form-group col-md-4">
						  				<div class="panel panel-primary">
					                        <div class="panel-heading">
												<label for="deshabilitar"><?php echo trad('Ejercicio',$lang) ?><span class="red"> *</span></label>
											</div>	
											<div class="panel-footer" >
								  				<select type="text" id="deshabilitar" name="deshabilitar" class="form-control" required>
								  					<?php if (isset($_SESSION['guardarDatos'])) { 
								  						if( intval($_SESSION['guardarDatos'][3]) === 0){ ?>
															<option value="0" selected="selected"><?php echo trad('Habilitado',$lang) ?></option>
								  							<option value="1"><?php echo trad('Deshabilitado',$lang) ?></option>
													<?php } else { ?>
															<option value="0"><?php echo trad('Habilitado',$lang) ?></option>
								  							<option value="1" selected="selected"><?php echo trad('Deshabilitado',$lang) ?></option>
								  					<?php }
								  					} else { ?>
									  					<option value="0"><?php echo trad('Habilitado',$lang) ?></option>
								  						<option value="1"><?php echo trad('Deshabilitado',$lang) ?></option>
								  					<?php } ?>
								  					
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
												<?php if (isset($_SESSION['guardarDatos'])) { ?>
													<input type="text" id="descripcion" name="descripcion" class="form-control" maxlength="50" required value="<?php echo $_SESSION['guardarDatos'][4] ?>" />
												<?php } else {?>
													<input type="text" id="descripcion" name="descripcion" class="form-control" maxlength="50" required />
												<?php } ?>
						  					</div>
						  				</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<div class="panel panel-primary">
					                        <div class="panel-heading">
												<label for="enunciado"><?php echo trad('Enunciado',$lang) ?><span class="red"> *</span></label>
											</div>	
											<div class="panel-footer" >
												<?php if (isset($_SESSION['guardarDatos'])) { ?>
						  							<textarea  id="enunciado" name="enunciado" class="form-control" rows="5" required><?php echo $_SESSION['guardarDatos'][5] ?></textarea>
						  						<?php } else { ?>
						  							<textarea  id="enunciado" name="enunciado" class="form-control" rows="5" required></textarea>
						  						<?php } ?>
						  					</div>
						  				</div>
									</div>
									<div class="form-group col-md-6">
										<div class="panel panel-primary">
					                        <div class="panel-heading">
												<label for="solucion"><?php echo trad('Solución',$lang) ?><span class="red"> *</span></label>
											</div>	
											<div class="panel-footer" >
												<?php if (isset($_SESSION['guardarDatos'])) { ?>
						  							<textarea  id="solucion" name="solucion" class="form-control" rows="5" required><?php echo $_SESSION['guardarDatos'][6] ?></textarea>
												<?php }else { ?>
						  							<textarea  id="solucion" name="solucion" class="form-control" rows="5" required></textarea>
						  						<?php } ?>
						  					</div>
						  				</div>
									</div>
								</div>
						  		<div class="form-row">	
						  			<!-- <div class="form-group col-md-3">
										<button class="btn btn-log btn-tertiary-border btn-block" type="reset"><?php echo trad('Cancelar',$lang) ?></button>
									</div> -->
									<div class="form-group col-md-3 offset-9 pr-4">
										<button class="btn btn-log btn-tertiary btn-block" name="crear" type="submit"><?php echo trad('Crear ejercicio',$lang) ?></button>
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
	<script type="text/javascript" src="../js/update_select.js"></script>
	</body>
	<footer class="footer py-3 text-center">
		<span>© 2018</span> <a id="pie" href="index_profesor.php">SQLab</a> 
		
	</footer>
</html>