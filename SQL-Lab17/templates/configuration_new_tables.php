<?php
session_start();
?>
<?php include("layout.php"); ?>
<?php include("menus/menu_lateral.php"); ?>
<?php include("menus/menu_horizontal.php"); ?>
<div class="container-tabla pt-4 pb-5">
    <label><a class="enlace" href="configuration.php" >Configuración </a> > <a class="enlace" href="configuration_tables.php" > Tablas</a> > <a class="enlace" href="configuration_new_tables.php" > Nueva Tabla</a></label>
    <h2><strong>Nueva Tabla</strong></h2>
    <div class="row mb-5">
        <div class="col-md-12">
            <p>Introduzca el código para crear las tablas e introducir los datos. Sólo se permiten las sentencias CREATE TABLE, INSERT INTO, DROP TABLE y ALTER TABLE.</p>
        </div>
    </div>  
    <section id="tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <form id="new_tables" method="post" action="../handler/validate_new_tables.php">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-tables-tab" data-toggle="tab" href="#nav-new-tables" role="tab" aria-controls="nav-home" aria-selected="true">Nueva Tabla</a>
                                <!--<a class="nav-item nav-link" id="nav-exercises-tab" data-toggle="tab" href="#nav-exercises" role="tab" aria-controls="nav-profile" aria-selected="false">Añadir Ejercicios</a>-->
                            </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane fade show active mt-3 pl-4" id="nav-new-tables" role="tabpanel" aria-labelledby="nav-tables-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name" ><strong>Código</strong></label>                                    
                                    </div>
          
                                </div>
                                <div class="row">
                                    <div class="col-md-3">                                    
                                        <textarea rows="5" id="new_name_table" name="new_name_table" placeholder="Introduce el código aquí..." class="form-control form-control-sm" required style="width: 1000px"></textarea>
                                    </div>
                                   
                                </div>
                            </div>                          
                            <div class="form-group col-md-2 offset-10">
                                <button class="btn btn-primary pl-4 pr-4" name="new_sheet" type="submit">Crear Tabla</button>
                            </div>                           
                        </div>
                        <?php
                        if(isset($_SESSION['message_new_tables'])){
                            echo $_SESSION['message_new_table'];
                            unset($_SESSION['message_new_tables']);
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>

<?php include("footer.php"); ?> 
