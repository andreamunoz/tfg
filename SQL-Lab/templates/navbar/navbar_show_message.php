	<?php 
    if (isset($_SESSION['message'])) { 
  ?>
    <div class="row">

      <div class="container-center">
        <div class="col-sm-9 col-xs-12">
        <div class="message">
          <?php
            $success = array();
            $warning = array();
            foreach ($_SESSION['message'] as $key => $value) {
              if( $value == 1){
                $success[$key] = $key+1;
              }else if($value != ""){
                $warning[$key] = $value;
              }else{
                $warning[$key] = "Ha habido un error al ejecutar la sentencia ".$key+1; 
              }
              //echo "\n esto es key: ". $key ." esto es value: ". $value;

            }

            if(count($success) !== 0){ ?>
                <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close equis_alert_success" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> 
                  <?php echo trad("Las sentencias ",$lang);
                    foreach ($success as $key => $value) {
                      echo $value." ";
                    }
                    echo trad(" se han ejecutado correctamente.", $lang);
                   ?>

                </div>
            <?php  }
            if(count($warning) !== 0){  ?>
                <div class="alert alert-warning  alert-dismissible">
                  <a href="#" class="close equis_alert_warning" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Warning!</strong> 
                  <?php foreach ($warning as $value) {
                      echo $value."<br>";
                    }
                    echo trad("Revise el código e inténtelo de nuevo.", $lang);
                   ?>
                </div>
             <?php  } ?>
        </div> 
        </div>
      </div>
    </div>
   
  <?php 
    unset($_SESSION['message']);
    } 
  ?>
       
