<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insertar</title>
</head>
<body>
	<?PHP 
		//variables to hold json file and decode to get result as array
		//$json = file_get_contents("http://opendata.taro.ull.es/datos/dataset/ed6645f9-6bd9-419d-9543-3e7db9d2a147/resource/c2870b8c-1051-49d4-adb5-3e398f0c66cb/download/playas.json");
		$json = file_get_contents('http://www.opendatacanarias.es/datos/dataset/6b13318c-5b25-4334-99ec-9606aa95b15a/resource/d686f190-6b3c-4e50-8cdc-f770765c7515/download/playas.json');
		$objIndividual = json_decode($json, true);
		//database connection variables
		$servername = "localhost";
		$username = "adminPlayas";
		$password = "cjwSA2F2mEpZZrBc";
		$dbname = "playas";		
		//Create connection
		
		$conn = new mysqli("localhost", "dwes", "abc123", "playas");
		//Check connection
		if($conn->connect_error){
			die("La conexión ha fallado: " .$conn->connect_error);
		}
		//Cambiamos la codificación
		if(!$conn->set_charset("utf8")){
			printf("Error cargando el conjunto de caracteres utf8: %s\n");
		}else{
			printf("Conjunto de caracteres actual: %s\n <br>", $conn->character_set_name());
		}
		//DELETING OLD DATA BEFORE INSERT
		$sqlDelete = "DELETE FROM PLAYAS WHERE idPlaya > 0";
		if($conn->query($sqlDelete) === TRUE){
			echo "Se han eliminado todos los registros antiguos <br>";
		}else{
			echo "Error: " .$sqlDelete . "<br>" . $conn->error;
		}	
		//Inserting data from JSON
		for($x = 0; $x < count($objIndividual["listado"]); $x++){
			//data to insert
			$longlat = (string)$objIndividual["listado"][$x]["ows_Georeferencia"]; //Guardamos el campo GEO que contiene en un solo string la longitud y la latitud
			if($longlat == ""){
				$longlat = "(0, 0)" ;
			}
			list($long, $lat) = explode(",", $longlat); //Guardamos en dos variables el string dividido
			$longitud = str_replace("(", "", $long);
			$latitud = str_replace(")", "", $lat); //Guardamos los valores en variables distintas y le quitamos los paréntesis.
			$municipio = (string)$objIndividual["listado"][$x]["ows_Municipio"]; 
			$idMun;
			$descripcion = (string)$objIndividual["listado"][$x]["ows_DescripcionEspanol"]; 
			if($descripcion == ""){
				$descripcion = "Sin descripción";
			}
			$playaSize = (string)$objIndividual["listado"][$x]["ows_LongitudPlaya"]; 
			if($playaSize == ""){
				$playaSize = "Desconocido";
			}
			$nombre = (string)$objIndividual["listado"][$x]["ows_LinkTitle"];
			//PARCHE PARA LA PLAYA CON EL NOMBRE DEMASIADO LARGO
			if($x == 10){
				$nombre = "Playa Las Americas";
			}
			$direccion = (string)$objIndividual["listado"][$x]["ows_Direccion"];
			$imagen;
			switch ($municipio){    //Como el JSON no tiene ID para municipio hacemos un arreglo para adapatarlo a nuestra base de datos
				case "Tacoronte":
					$idMun = 1;
					break;
				case "Candelaria":
					$idMun = 2;
					break;
				case "Santiago del Teide":
					$idMun = 3;
					break;
				case "Arona":
					$idMun = 4;
					break;
				case "Puerto de la Cruz (El)":
					$idMun = 5;
					break;
				case "Guía de Isora":
					$idMun = 6;
					break;
				case "Santa Cruz de Tenerife":
					$idMun = 7;
					break;
			}
		$sql = "INSERT INTO playas (idMun, nombre, descripcion, direccion, playaSize, longitud, latitud) VALUES($idMun, '$nombre', '$descripcion', '$direccion', '$playaSize', $longitud, $latitud)";
		if($conn->query($sql) === TRUE){
			echo "Playa $nombre añadida correctamente <br>";
		} else{
				echo "Error: " .$sql . "<br>" . $conn->error;
			}
		}
		$conn->close();
		header("Location: todas.php");
	?>
		

</body>
</html>