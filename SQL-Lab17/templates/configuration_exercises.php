<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" ><?php echo trad('Modo Profesor',$lang) ?> </a> > <a class="enlace" href="configuration_exercises.php" > <?php echo trad('Ejercicios',$lang) ?></a></label>
    <h2><strong><?php echo trad('Ejercicios',$lang) ?></strong></h2>
    <div class="row mb-150">
        <div class="offset-md-10 col-md-2">
            <div class="text-right pl-5">
                <a type="button" class="btn btn-primary pl-3 pr-3" href="configuration_new_exercises.php" ><?php echo trad('Crear Ejercicio',$lang) ?></a>
            </div>
        </div>
    </div>
    <div id="accordion ">
        <div class="card">  
            <div class="table-responsive"> 
                
                <table id="employee_data" class="table table-striped table-bordered">  
                    <thead>
                        <tr>
                            <th style="width:40%;"><?php echo trad('Descripción',$lang) ?></th>
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
                                <tr class="fondo_blanco" onclick="location='configuration_show_exercises.php?exercise=<?php echo $fila['id_ejercicio']; ?>'">                                    
                                    <?php echo '<td>' . $fila['descripcion'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>
                                    <?php if($_SESSION['user']== $fila['creador_ejercicio']){ ?>
                                    <?php echo '<td style="text-align:right;">'
                                            . '<a type="button" class="mr-4 highlight_e" href="configuration_edit_exercises.php?exercise=' . $fila['id_ejercicio'] . '"><i class="fas fa-edit" style="color:black; opacity:0.9;"></i></a>'
                                            . '<a type="button" class="pr-5 highlight_d" href="../handler/validate_deshabilitar.php?deshabilitar=' . $fila['id_ejercicio'] . '"><i class="fas fa-unlock" style="color:black; opacity:0.9;"></i></a>'
                                            . '</td>';
                                    } else {
                                        echo '<td>'
                                            . '<a type="button" class="mr-4" href="configuration_show_exercises.php?exercise=' . $fila['id_ejercicio'] . '"></a>'
                                            . '</td>';
                                    }
                                    ?>
                                </tr>
                            <?php
                            }else {
                                ?>
                                <tr class="habilitar fondo_blanco" onclick="location='configuration_show_exercises.php?exercise=<?php echo $fila['id_ejercicio']; ?>'">                                    
                                    <?php echo '<td>' . $fila['descripcion'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['nivel'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['tipo'] . '</td>'; ?>
                                    <?php echo '<td>' . $fila['creador_ejercicio'] . '</td>'; ?>
                                    <?php if($_SESSION['user']== $fila['creador_ejercicio']){ ?>
                                    <?php echo '<td style="text-align:right;">'
                                            . '<div class="mr-2 mt-2 ml-2 mb-2 highlight"><a type="button" href="configuration_edit_exercises.php?exercise=' . $fila['id_ejercicio'] . '"><i class="fas fa-edit" ></i></a></div>'
                                            . '<a method="post" type="button" class="pr-5" href="../handler/validate_habilitar.php?habilitar=' . $fila['id_ejercicio'] . '"><i class="fas fa-lock"></i></a>'
                                            . '</td>';
                                    } else {
                                        echo '<td>'
                                            . '<a type="button" class="mr-4" href="configuration_show_exercises.php?exercise=' . $fila['id_ejercicio'] . '"></a>'
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
