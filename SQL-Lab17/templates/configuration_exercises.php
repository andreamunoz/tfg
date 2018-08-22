<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" >Configuración </a> > <a class="enlace" href="configuration_exercises.php" > Ejercicios</a></label>
    <h2><strong>Ejercicios</strong></h2>
    <div class="row mb-150">
        <div class="col-md-9">
            <p>Añade, edita y elimina los ejercicios...</p>
        </div>

        <div class="col-md-3 p-0">
            <a type="button" class="btn btn-primary pl-4 pr-4" href="configuration_new_exercises.php" >Crear Ejercicio</a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secundary pl-5 pr-5" data-toggle="modal" data-target="#exampleModalCenter">
                Ayuda
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="mt-4 pl-5">Ayuda</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <img class="img_icon_cerrar cerrar" src="../img/icon_cerrarPanel_blanco.svg"/></span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <p class="pl-5">+ <strong><i>Crear ejercicio:</i></strong> Rellene el nombre y selecciona el nivel, categoría y la vista, después añade las tablas que se usarán en el ejercicio y añade su enunciado y solución. </p>
                            <p class="pl-5">+ <strong><i>Mostrar:</i></strong> Muestra el ejercicio, solo podrá visualizarlo no realizarlo.</p>
                            <p class="pl-5">+ <strong><i>Editar:</i></strong> Cambie el nombre y selecciona el nivel, categoría y la vista, puede cambiar tambien las tablas que se usarán en el ejercicio y cambie su enunciado y solución.</p>
                            <p class="pl-5">+ <strong><i>Habilitar/Deshabilitar:</i></strong> Habilite un ejercicio para poder solucionarlo / Deshabilite un ejercicio para que no se pueda solucionar. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="accordion ">
        <div class="card">  
            <div class="table-responsive"> 
                
                <table id="employee_data" class="table table-striped table-bordered">  
                    <thead>
                        <tr>
                            <th style="width:20%;">Nombre Ejercicio</th>
                            <th style="width:10%;">Nivel</th>
                            <th style="width:20%;">Tipo</th>
                            <th style="width:15%;">Profesor</th>                         
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once '../inc/ejercicio.php';
                        $ejer = new Ejercicio();
                        include_once '../inc/solucion.php';
                        $sol = new Solucion();
                        $result = $ejer->getAllEjercicios();
                        while ($fila = mysqli_fetch_array($result)) {
                            ?>

                            <?php
                            $id = $fila['id_ejercicio'];
                            //$solucion = $sol->getAllEjerciciosByName($id);
                            //$fila_sol = mysqli_fetch_array($solucion);
                            if($fila['deshabilitar']==0){
                            ?>
                                <tr>                                    
                                    <?php echo '<td>Ejercicio ' . $fila['id_ejercicio'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>
                                    <?php if($_SESSION['user']== $fila['creador_ejercicio']){ ?>
                                    <?php echo '<td>'
                                            . '<a type="button" class="btn btn-primary pl-5 pr-5 mr-4" href="configuration_edit_exercises.php?exercise=' . $fila['id_ejercicio'] . '">Editar</a>'
                                            . '<a type="button" class="btn btn-secundary pl-5 pr-5" href="../handler/validate_deshabilitar.php?deshabilitar=' . $fila['id_ejercicio'] . '">Deshabilitar</a>'
                                            . '</td>';
                                    } else {
                                        echo '<td>'
                                            . '<a type="button" class="btn btn-primary pl-5 pr-5" href="perform_exercise.php?exercise=' . $fila['id_ejercicio'] . '">Mostrar</a>'
                                            . '</td>';
                                    }
                                    ?>
                                </tr>
                            <?php
                            }else {
                                ?>
                                <tr class="habilitar">                                    
                                    <?php echo '<td>Ejercicio ' . $fila['id_ejercicio'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>
                                    <?php if($_SESSION['user']== $fila['creador_ejercicio']){ ?>
                                    <?php echo '<td>'
                                            . '<a type="button" class="btn btn-primary pl-5 pr-5 mr-4" href="configuration_edit_exercises.php?exercise=' . $fila['id_ejercicio'] . '">Editar</a>'
                                            . '<a method="post" type="button" class="btn btn-secundary pl-5 pr-5" href="../handler/validate_habilitar.php?habilitar=' . $fila['id_ejercicio'] . '">Habilitar</a>'
                                            . '</td>';
                                    } else {
                                        echo '<td>'
                                            . '<a type="button" class="btn btn-primary pl-5 pr-5" href="perform_exercise.php?exercise=' . $fila['id_ejercicio'] . '">Mostrar</a>'
                                            . '</td>';
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <?php
                if(isset($_SESSION['msg_habilitar'])){
                    echo $_SESSION['msg_habilitar'];
                    unset($_SESSION['msg_habilitar']);
                }
                ?>
            </div>  
        </div> 
    </div>
</div>

<?php include("footer.php"); ?> 
