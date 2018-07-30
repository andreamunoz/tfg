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
			
			<!-- <?php //include("navbar/navbar_menu_lateral.php"); ?> -->
			<?php include("navbar/navbar_show_message.php"); ?>
			<div class="nav-side-menu">   		
			    <div class="menu-list">	
			        <ul id="menu-content" class="menu-content collapse out">   
			            <li data-toggle="collapse" data-target="#prin" class="collapsed" id="liprin">
			              <a id="principal" href="../templates/index_profesor.php"><i class="fa fa-home" aria-hidden="true"></i><?php echo trad('Inicio', $lang) ?> </a>
			            </li>  
			            <li data-toggle="collapse" data-target="#tablas" class="collapsed" id="litabl">
			              <a id="adjuntar_tabla" href="../templates/prf_tablas.php"><i class="fa fa-table" aria-hidden="true"></i><?php echo trad('Añadir Datos',$lang) ?></a>
			            </li>   
			            <li data-toggle="collapse" data-target="#ejercicios" class="collapsed" id="liejer">
			              <a id="ejercicio" href="#"><i class="fa fa-file-o" aria-hidden="true"></i><?php echo trad('Ejercicios',$lang) ?> <span class="arrow"></span></a>
			            </li>  
			            <ul class="sub-menu collapse" id="ejercicios">
			              <li class="" id="licrej"><a id="crear_ejercicio" href="../templates/prf_crear_ejercicio.php"><?php echo trad('Crear Ejercicio',$lang) ?></a></li>
			              <li class="" id="liliej"><a id="lista_ejercicio" href="../templates/prf_listar_ejercicios.php"><?php echo trad('Gestión de Ejercicios',$lang) ?></a></li>
			            </ul>
			            <li data-toggle="collapse" data-target="#hojas" class="" id="lihoja">
			              <a id="hoja_ejercicio" href="#"><i class="fa fa-files-o" aria-hidden="true"></i><?php echo trad('Hojas de Ejercicios', $lang) ?> <span class="arrow"></span></a>
			            </li>  
			            <ul class="sub-menu collapse show" id="hojas">
			                <li class="" id="licrho"><a id="crear_hoja" href="../templates/prf_crear_hoja.php"><?php echo trad('Crear Hoja',$lang) ?></a></li>
			                <li class="" id="liliho"><a id="lista_hoja" href="../templates/prf_listar_hojas.php"><?php echo trad('Gestión de Hojas',$lang) ?></a></li>    
			            </ul>         

			            <li data-toggle="collapse" data-target="#estadisticas" class="collapsed" id="liesta">
			              <a id="estadistic" href="../templates/prf_estadisticas.php"><i class="fa fa-signal" aria-hidden="true"></i><?php echo trad('Estadísticas',$lang) ?></a>
			            </li>  

			            <li data-toggle="collapse" data-target="#configurar" class="collapsed" id="liconf">
			              <a id="configuracion" href="#"><i class="fa fa-cogs" aria-hidden="true"></i><?php echo trad('Configuración',$lang) ?> <span class="arrow"></span></a>
			            </li>  
			            <ul class="sub-menu collapse" id="configurar">
			              <li class="" id="liperf"><a id="perfil" href="../templates/prf_configuracion.php"><?php echo trad('Perfil',$lang) ?></a></li>
			            </ul>  

			        </ul>
			 	</div>
			 </div>
			
			<!--CONTENEDOR -->
			<div class="container-center "> 
				<div class="adm-hojas">
					<div class="row ">

						<div class="col-md-11 lista-hoja" id="listarHojaEjercicios">
							<form class="jumbotron-propio" id="longSelect" method="post" action="../handler/listar_hojasejercicios.php">
								<h3>Gestión de Hojas</h3>
								<p class="pl-5">Se podrán ver los ejercicios dentro de sus propias hojas.</p>
								<div class="hrr"></div><br>
				  				<div id="accordion ">
					                <div class="card">  
					                    <div class="table-responsive">  
					                     <table id="table-listar-hojas" class="table table-striped table-bordered">  
					                        <thead>
					                            <tr>
					                              <th style="width: 30%">Nombre Hoja</th>
					                              <th class="nombreProfListar" style="width: 27%"><span class="cursorChange">Nombre Profesor  <i class="fa fa-sort"></i></span></th>
					                              <th style="width: 13%">N. Ejercicios </th>
					                              <th style="width: 10%; text-align: center"></th>
					                              <th style="width: 10%; text-align: center"></th>
					                              <th style="width: 10%; text-align: center"></th>
					                            </tr>
					                          </thead>
					                          <tbody >
					                            <?php 
					                            include_once '../inc/hoja_ejercicio.php';
					                            include_once '../inc/esta_contenido.php';
					                            $hojaejer = new HojaEjercicio();
					                            $result = $hojaejer->getAllHojas();
					                            if(isset($result)){

					                              while($fila_hoja = mysqli_fetch_array($result)){  
					                            ?>
					                            
					                              <tr class="accordion-toggle" id="show-accordion" >
					                              <?php echo '<td data-toggle="collapse" data-target="#collapse_'.$fila_hoja['id_hoja'].'">'.$fila_hoja['nombre_hoja'].'</td>'; ?>
					                             
					                              <?php echo '<td data-toggle="collapse" data-target="#collapse_'.$fila_hoja['id_hoja'].'">'.$fila_hoja['creador_hoja'].'</td>'; ?>
					                              <?php $number = new EstaContenido();
					                              $id_hoja = $fila_hoja['id_hoja'];
					                              $row_number = $number->getNumberEjerciciosByHoja($id_hoja); 
					                              echo '<td data-toggle="collapse" data-target="#collapse_'.$fila_hoja['id_hoja'].'">'.$row_number["COUNT(id_ejercicio)"].'</td>'; ?>
					                              <?php echo '<td class="boton_info_hoja" data-number='. $fila_hoja["id_hoja"] .'><a href="../templates/prf_info_hoja.php?id='. $fila_hoja['id_hoja'] .'">+Info</a></td>'; ?>
					                              <?php if ($fila_hoja['creador_hoja'] === $_SESSION['user']){
					                               		echo '<td id="rowEditarHoja" data-number="'.$fila_hoja['id_hoja'].'"><a href="../templates/prf_editar_hojas.php?id='. $fila_hoja['id_hoja'] .'">Editar</a></td>'; 
					                               		echo '<td id="rowBorrarHoja" data-number="'.$fila_hoja['id_hoja'].'"><a href="#borrar-hoja-'.$fila_hoja['id_hoja'].'">Borrar</a></td>';	
					                               }else{
					                               		echo '<td></td>';
					                               		echo '<td></td>';
					                               }?>
					                            </tr>
					                            
					                            <?php }                                   
					                            }
					                            ?> 

					                          </tbody>
					                      </table>
					                    </div>  
					                </div> 
				              	</div>
							</form>
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