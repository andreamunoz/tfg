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
              <h2>Hoja de Ejercicios</h2>
              <p>Texto a añadir aquí...</p>
              <div class="hrr mb-3"></div>     
              <div id="accordion ">
              <div class="card">  
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                        <thead>
                            <tr>
                              <th>Nombre Hoja</th>
                              <th >Nombre Profesor</th>
                              <th style="width: 60%">N. Ejercicios</th>
                              <th></th>
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
                              <?php echo '<td><a href="hoja_ejercicio.php?hoja='.$fila_hoja['id_hoja'].'">+Info</a></td>'; ?>
                            </tr>
                            
                            
                            <?php }                                   
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