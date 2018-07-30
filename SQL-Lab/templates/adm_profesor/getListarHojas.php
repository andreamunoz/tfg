<?php 
	session_start();
	$orden = $_GET["orden"];
	//var_dump($orden);
    include_once '../../inc/hoja_ejercicio.php';
    include_once '../../inc/esta_contenido.php';
    $contenido = "";
    $hojaejer = new HojaEjercicio();
    if ($orden === "0") {
	    $result = $hojaejer->getAllHojas();
	}else if($orden === "1"){
	    $result = $hojaejer->getAllHojasCreadorASC();

    }else if($orden === "2"){
	    $result = $hojaejer->getAllHojasCreadorDESC();

    }else{
    	 $result = $hojaejer->getAllHojas();
    }
	    if(isset($result)){
	    	
	    	while($fila_hoja = mysqli_fetch_array($result)){  
	     
			    $contenido = $contenido.'<tr class="accordion-toggle" id="show-accordion" ><td data-toggle="collapse" data-target="#collapse_'.$fila_hoja['id_hoja'].'">'.$fila_hoja['nombre_hoja'].'</td>';      
			    $contenido = $contenido.'<td data-toggle="collapse" data-target="#collapse_'.$fila_hoja['id_hoja'].'">'.$fila_hoja['creador_hoja'].'</td>'; 
			    $number = new EstaContenido();
	     		$id_hoja = $fila_hoja['id_hoja'];
		      	$row_number = $number->getNumberEjerciciosByHoja($id_hoja); 

		        $contenido = $contenido.'<td data-toggle="collapse" data-target="#collapse_'.$fila_hoja['id_hoja'].'">'.$row_number["COUNT(id_ejercicio)"].'</td>';
		        $contenido = $contenido.'<td  id="rowInfoHoja" class="boton_info_hoja" data-number='. $fila_hoja["id_hoja"] .'><a href="#">+Info</a></td>'; 
		        if ($fila_hoja['creador_hoja'] === $_SESSION['user']){
		       		$contenido = $contenido.'<td id="rowEditarHoja" data-number="'.$fila_hoja['id_hoja'].'"><a href="../templates/prf_editar_hojas.php?id='.$fila_hoja['id_hoja'].'">Editar</a></td>'; 
		       		$contenido = $contenido.'<td id="rowBorrarHoja" data-number="'.$fila_hoja['id_hoja'].'"><a href="#borrar-hoja-'.$fila_hoja['id_hoja'].'">Borrar</a></td>';	
		       	}else{
		       		$contenido = $contenido.'<td></td>';
		       		$contenido = $contenido.'<td></td>';
		       	}
	    		$contenido = $contenido.'</tr>';
	    
	    	}                                   
	    }else{
	    	$contenido = "";
	    }
    
    echo $contenido;
?>