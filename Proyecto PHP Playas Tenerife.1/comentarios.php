<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="style.css">
<title>Procesando comentario</title>
</head>
<body>
<?php
	if(ISSET($_POST["nombre"]) && ISSET($_POST["puntuacion"]) && ISSET($_POST["comentario"]) && $_POST["nombre"] != "" && $_POST["puntuacion"] != "" && $_POST["comentario"] != ""){
		echo "Nombre: ". $_POST["nombre"] ."<br>";
		echo "Puntuacion: ". $_POST["puntuacion"]."<br>";
		echo "Comentario: ". $_POST["comentario"]."<br>";
		echo $_GET["id"];
		$idPlaya = $_GET["id"];
		$nombre = $_POST["nombre"];
		$puntuacion = $_POST["puntuacion"];
		$comentario = $_POST["comentario"];
		
		
		$servername = "localhost";
		$username = "adminPlayas";
		$password = "cjwSA2F2mEpZZrBc";
		$dbname = "playas";		
		//Create connection
		
		$conn = new mysqli("localhost", "adminPlayas", "cjwSA2F2mEpZZrBc", "playas");
		//Check connection
		if($conn->connect_error){
			die("La conexión ha fallado: " .$conn->connect_error);
		}
		//Cambiamos la codificación
		if(!$conn->set_charset("utf8")){
			printf("Error cargando el conjunto de caracteres utf8: %s\n");
		}
		
		$sql = "INSERT INTO valoraciones(idPlaya, puntuacion, comentario, nickname) VALUES ($idPlaya, '$puntuacion', '$comentario', '$nombre')";
		if($conn->query($sql) === TRUE){
			echo "ok";
			header("Location: playas.php?id=".$idPlaya);
		} else{
				echo "Error: " .$sql . "<br>" . $conn->error;
				header("Location: todas.php");
			}
		}
	else{
		header("Location: playas.php?id=".$idPlaya);
	}	
		$conn->close()
		
?>			
</body>
</html>
