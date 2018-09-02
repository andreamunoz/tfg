<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Configuración',$lang) ?> </a> > <a class="enlace" href="configuration_exercises.php" > <?php echo trad('Ejercicios',$lang) ?></a></label>
    <h2><strong><?php echo trad('Ejercicios',$lang) ?></strong></h2>
    <div class="row mb-150">
        <div class="col-md-8">
            <p><?php echo trad('Añade, edita y habilita o deshabilita los ejercicios.',$lang) ?></p>
        </div>

        <div class="text-right pl-5">
            <a type="button" class="btn btn-primary pl-4 pr-4" href="configuration_new_exercises.php" ><?php echo trad('Crear Ejercicio',$lang) ?></a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secundary pl-5 pr-5" data-toggle="modal" data-target="#exampleModalCenter">
                <?php echo trad('Ayuda',$lang) ?>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="mt-4 pl-5"><?php echo trad('Ayuda',$lang) ?></h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <img class="img_icon_cerrar cerrar" src="../img/icon_cerrarPanel_blanco.svg"/></span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <p class="pl-5">+ <strong><i><?php echo trad('Crear ejercicio',$lang) ?>:</i></strong> <?php echo trad('Rellene el nombre y selecciona el nivel, categoría y la vista, después añade las tablas que se usarán en el ejercicio y añade su enunciado y solución.',$lang) ?> </p>
                            <p class="pl-5">+ <strong><i><?php echo trad('Mostrar',$lang) ?>:</i></strong> <?php echo trad('Muestra el ejercicio, solo podrá visualizarlo no realizarlo.',$lang) ?></p>
                            <p class="pl-5">+ <strong><i><?php echo trad('Editar',$lang) ?>:</i></strong> <?php echo trad('Cambie el nombre y selecciona el nivel, categoría y la vista, puede cambiar tambien las tablas que se usarán en el ejercicio y cambie su enunciado y solución.',$lang) ?></p>
                            <p class="pl-5">+ <strong><i><?php echo trad('Habilitar',$lang) ?>/<?php echo trad('Deshabilitar',$lang) ?>:</i></strong> <?php echo trad('Habilite un ejercicio para poder solucionarlo / Deshabilite un ejercicio para que no se pueda solucionar.',$lang) ?> </p>
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
                            <th style="width:20%;"><?php echo trad('Nombre Ejercicio',$lang) ?></th>
                            <th style="width:10%;"><?php echo trad('Nivel',$lang) ?></th>
                            <th style="width:20%;"><?php echo trad('Tipo',$lang) ?></th>
                            <th style="width:15%;"><?php echo trad('Profesor',$lang) ?></th>                         
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
                                            . '<a type="button" class="btn btn-primary btn-edit mr-4" href="configuration_edit_exercises.php?exercise=' . $fila['id_ejercicio'] . '">Editar</a>'
                                            . '<a type="button" class="btn btn-secundary pl-5 pr-5" href="../handler/validate_deshabilitar.php?deshabilitar=' . $fila['id_ejercicio'] . '">Deshabilitar</a>'
                                            . '</td>';
                                    } else {
                                        echo '<td>'
                                            . '<a type="button" class="btn btn-primary pl-5 pr-5" href="configuration_show_exercises.php?exercise=' . $fila['id_ejercicio'] . '">Mostrar</a>'
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
                                            . '<a type="button" class="btn btn-primary btn-edit mr-4" href="configuration_edit_exercises.php?exercise=' . $fila['id_ejercicio'] . '">Editar</a>'
                                            . '<a method="post" type="button" class="btn btn-secundary btn-habilitar" href="../handler/validate_habilitar.php?habilitar=' . $fila['id_ejercicio'] . '">Habilitar</a>'
                                            . '</td>';
                                    } else {
                                        echo '<td>'
                                            . '<a type="button" class="btn btn-primary pl-5 pr-5" href="configuration_show_exercises.php?exercise=' . $fila['id_ejercicio'] . '">Mostrar</a>'
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
                if(isset($_SESSION['message_sheets'])){
                    echo $_SESSION['message_sheets'];
                    unset($_SESSION['message_sheets']);
                }
                if(isset($_SESSION['message_edit_sheets'])){
                    echo $_SESSION['message_edit_sheets'];
                    unset($_SESSION['message_edit_sheets']);
                }
                ?>
            </div>  
        </div> 
    </div>
</div>

<?php include("footer.php"); ?> 
