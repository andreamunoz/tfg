<?php 
	
	include_once '../inc/administrar_schema.php';
	
	session_start();
	$user_name = $_SESSION['user'];
	
	$admin_schema = new Administrar_schema();

	$target_dir = "../uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if(isset($_POST["submit"])){
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check === false) {
	        $uploadOk = 1;
	    } else {
	        $uploadOk = 0;
	    }
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 50000) {
	    echo "Error, el fichero es demasiado grande.";
	    $uploadOk = 0;
	}

	// Allow certain file formats
	if($fileType != "txt" && $fileType != "sql") {
	    echo "Error, solo se permiten ficheros con extensión txt o sql.";
	    $uploadOk = 0;
	}

	if($uploadOk ==0){
		echo "Error, no se ha subido el fichero.";
	}else{
		if (!(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))) {
	        echo "Error, ha habido un fallo al subir el fichero.";
	    } else {
	        echo "El fichero ". basename( $_FILES["fileToUpload"]["name"]). " se ha subido.";

	    }
	}

	$contenido = file_get_contents($target_file);

	if($contenido===false){
		echo "Error al leer el fichero";
	}else{
		$arrayResultado = $admin_schema->obtenerSentencias($contenido, $user_name);

	}
	
	unlink($target_file);
	var_dump($arrayResultado);
	$_SESSION['resultadoIntroducirDatos'] = $arrayResultado; 
	header("Location: ../templates/index_profesor.php#adjuntar_tabla");
	exit();
?>