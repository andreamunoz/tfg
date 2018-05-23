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
           <script src="../js/jquery-1.12.4.js"></script> 
           <script src="../js/jquery.dataTables.js"></script> 
           <script src="../js/dataTable/dataTables.bootstrap.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

           
      </head>  
      <body>  
           <?php include("modals/modals_cerrar_sesion.php"); ?>
           <?php include("navbar/navbar_menu_alumno.php"); ?>
           <div class="container pt-4 pb-5">
              <h2>Ejercicios</h2>
              <p>Texto a añadir aquí...</p>
              <div class="hrr mb-3"></div>
              <div class="row pt-2 pb-2">
                <div class="col-md-1 offset-8">
                  <p class="border-V pr-2">Acierto</p>
                </div>
                <div class="col-md-1">
                  <p class="border-R">Fallo</p>
                </div>
                <div class="col-md-2">
                  <p class="border-A">No intentado</p>
                </div>
              </div>  
              
              <div id="accordion ">
              <div class="card">  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
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
                            include_once '../inc/esta_contenido.php';
                            $ejer = new EstaContenido();
                            include_once '../inc/solucion.php';
                            $sol = new Solucion();
                            $result = $ejer->getAllEjerciciosHabilitados();    
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
                              <?php } else {  ?>

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

                                  <?php echo '<td><a  href="realizar_ejercicio.php?ejercicio='.$fila['id_ejercicio'].'">Ver</a></td>'; ?>

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
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script>  