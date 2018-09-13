<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlace" href="configuration_sheets.php" > <?php echo trad('Hoja de Ejercicios',$lang) ?></a></label>
    <h2><strong><?php echo trad('Hoja de Ejercicios',$lang) ?></strong></h2>
    <div class="row mb-150">
        <div class="col-md-8">
            <p><?php echo trad('Añade, edita y elimina la hoja de ejercicios.',$lang) ?></p>
        </div>
        <div class="text-right pl-5">
            <a type="button" class="btn btn-primary pl-5 pr-5" href="configuration_new_sheets.php" ><?php echo trad('Crear Hoja',$lang) ?></a>
        </div>
    </div>
    <div id="accordion">
        <div class="card" >  
            <div class="table-responsive">  
                <table id="employee_data" class="table table-striped-conf table-bordered">  
                    <thead>
                        <tr>
                            <th style="width:30%"><?php echo trad('Nombre Hoja',$lang) ?></th>
                            <th style="width:20%"><?php echo trad('Nombre Profesor',$lang) ?></th>
                            <th style="width: 20%"><?php echo trad('N. Ejercicios',$lang) ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php
                        include_once '../inc/hoja_ejercicio.php';
                        include_once '../inc/esta_contenido.php';
                        $hojaejer = new HojaEjercicio();
                        $result = $hojaejer->getAllHojas();
                        $cont = 0;
                        if (isset($result)) {

                            while ($fila_hoja = mysqli_fetch_array($result)) {
                                ?>

                                <tr class="accordion-toggle" id="show-accordion" >
                                    <?php echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $fila_hoja['nombre_hoja'] . '</td>'; ?>

                                    <?php echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $fila_hoja['creador_hoja'] . '</td>'; ?>
                                    <?php
                                    $number = new EstaContenido();
                                    $id_hoja = $fila_hoja['id_hoja'];
                                    $row_number = $number->getNumberEjerciciosByHoja($id_hoja);
                                    echo '<td data-toggle="collapse" data-target="#collapse_' . $fila_hoja['id_hoja'] . '">' . $row_number["COUNT(id_ejercicio)"] . '</td>';
                                    ?>
                                    <?php if($_SESSION['user'] == $fila_hoja['creador_hoja']){ ?>
                                    <?php echo '<td >'
                                            . ' <a type="button" class="btn btn-primary btn-edit mr-4" href="configuration_edit_sheets.php?hoja=' . $fila_hoja['id_hoja'] . '">Editar</a>'
                                            . ' <button type="button" class="btn btn-secundary pl-5 pr-5" data-toggle="modal" data-target="#modalEliminarHoja'.$cont.'"> Eliminar              
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalEliminarHoja'.$cont.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog " role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2 class="mt-4 pl-5">'. $fila_hoja['nombre_hoja'] .'</h2>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"> <img class="img_icon_cerrar cerrar" src="../img/icon_cerrarPanel_blanco.svg"/></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="pl-5"><strong><i>¿Desea eliminar '. $fila_hoja['nombre_hoja'] .'?</i></strong></h5>
                                                                <p class="pl-5">Esta hoja contiene '. $row_number["COUNT(id_ejercicio)"] . ' ejercicios.</p>
                                                                <a method="post" type="button" class="btn btn-secundary pl-5 pr-5 mt-4 ml-5 mb-4" href="../handler/validate_eliminar_hoja.php?eliminar_hoja=' . $fila_hoja['id_hoja'] . '">Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>'                                   
                                            . '</td>'; 
                                    } else {?>
                                    <?php echo '<td>'
                                            . '<a type="button" class="btn btn-primary pl-5 pr-5" href="configuration_show_sheet.php?hoja=' . $fila_hoja['id_hoja'] . '">Mostrar</a>'                                           
                                            . '</td>';
                                    }?>
                                </tr>
                                <?php $cont = $cont + 1;
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <?php
                    if(isset($_SESSION['message_sheets'])){
                        echo $_SESSION['message_sheets'];
                        unset($_SESSION['message_sheets']);
                    }
                    if(isset($_SESSION['msg_eleminar_hoja'])){
                        echo $_SESSION['msg_eleminar_hoja'];
                        unset($_SESSION['msg_eleminar_hoja']);
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
