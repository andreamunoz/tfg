<?php 
	session_start();
    $id_hoja = $_SESSION['editar_hoja'];
    $orden = $_GET['orden'];

    $contenido = "";
    include_once '../../inc/ejercicio.php';
    include_once '../../inc/hoja_ejercicio.php';
    $he = new HojaEjercicio();
    $seleccionados = $he->getTodosIdEjerDeHoja($id_hoja);

    $ejer = new Ejercicio();
    switch ($orden) {
    	case "1":
    		$result = $ejer->getAllEjerciciosAutorizadosNivelASC();
    		break;
    	case "2":
    		$result = $ejer->getAllEjerciciosAutorizadosNivelDESC();
    		break;
    	case "3":
    		$result = $ejer->getAllEjerciciosAutorizadosTipoASC();
    		break;
    	case "4":
    		$result = $ejer->getAllEjerciciosAutorizadosTipoDESC();
    		break;
    	case "5":
    		$result = $ejer->getAllEjerciciosAutorizadosCreadorASC();
    		break;
    	case "6":
    		$result = $ejer->getAllEjerciciosAutorizadosCreadorDESC();
    		break;
    	
    	default:
    		$result = $ejer->getAllEjerciciosAutorizados();
    		break;
    }
    
    while($fila = mysqli_fetch_array($result)){

		if($fila['deshabilitar'] === "0" && !in_array(intval($fila['id_ejercicio']), $seleccionados)){	
		    $contenido = $contenido.'<tr><td class="primera"><input type="checkbox" class="form-check-input" id="checkbox-editar-hoja" name="seleccionados[]" value='. $fila["id_ejercicio"] .'></td><td>'.$fila['descripcion'].'</td><td>'.$fila['nivel'].'</td><td>'.$fila['tipo'].'</td> <td>'.$fila['creador_ejercicio'].'</td><td id="rowVerEjerAgregar" class="boton_ver_ejercicio" data-number='. $fila["id_ejercicio"] .'><a data-toggle="modal" href="#modalVerEejercicioAgregar"><i id="icon_ver" class="fa fa-eye" title="ver" aria-hidden="true"></i></a></td></tr>';
		} 
    
    }
    echo $contenido;
?>