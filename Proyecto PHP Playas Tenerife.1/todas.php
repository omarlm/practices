<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style.css">
	<title>Playas Tenerife</title>
</head>
<body>
<?PHP
	session_start();
	if(ISSET($_SESSION["user"]) && ISSET($_SESSION["privilegios"]))	{
		$user = $_SESSION["user"];
		$privilegios = $_SESSION["privilegios"];
	} else{
		$privilegios = 0;
		session_destroy();
	}
?>
	<div class="header">
		<div class="titulo">
		<p class="linkshead">
	<a class="menulinks" href="todas.php" >Todas las playas </a>| <a href="grafica.php" class="menulinks" >Gráfico</a> |<a class="menulinks" href="login.php" > Log-in </a>| <?PHP if(ISSET($_SESSION["user"])){ echo $user." |"; echo "<a class='menulinks' href='logout.php'> Salir</a> ". "| ";} if($privilegios == 1) echo "<a class='menulinks' href='insertar.php'> Actualizar registros</a> ";?>
		</p>
		<p>
		Playas de Tenerife
		</p>
		</div>
	</div>
	<?PHP 
		function conexionDropDown(){//Funcion para llenar el dropdown
		
			$servername = "localhost";
			$username = "adminPlayas";
			$password = "cjwSA2F2mEpZZrBc";
			$dbname = "playasdb";
			//Create connection
			$conn = new mysqli("localhost", "adminPlayas", "cjwSA2F2mEpZZrBc", "playasdb");
			//Check connection
			if($conn->connect_error){
				die("La conexión ha fallado: " .$conn->connect_error);
			}
			//Cambiamos la codificación		
			if(!$conn->set_charset("utf8")){
				printf("Error cargando el conjunto de caracteres utf8: %s\n");
			}else{
			//printf("Conjunto de caracteres actual: %s\n <br>", $conn->character_set_name());
			}
			$selectDropDownList = "SELECT idMunicipio, nombreMun FROM municipio";
			$result = mysqli_query($conn, $selectDropDownList);
			echo "<div class='selectdiv'>";
			echo "<form class='demo' action='inicio.php' method='POST'>";
			echo "<select class='black' name='municipios' onchange='this.form.submit()'>";
			echo "<option>Seleccione un municipio</option>";
			while ($row = mysqli_fetch_array($result)){
				echo "<option value=".$row['idMunicipio']." >".$row['nombreMun']."</option>";
			
			}
			echo "</select>";	
			echo "</div>";
			echo "</form>";

			$conn->close();
		}
		function conexionResult(){ //Lo modificamos para que muestre todas las playas en el inicio
			//CADENA DE CONEXION
			$servername = "localhost";
			$username = "adminPlayas";
			$password = "cjwSA2F2mEpZZrBc";
			$dbname = "playasdb";
			//Create connection
			$conn = new mysqli("localhost", "adminPlayas", "cjwSA2F2mEpZZrBc", "playasdb");
			//Check connection
			if($conn->connect_error){
				die("La conexión ha fallado: " .$conn->connect_error);
			}
			//Cambiamos la codificación		
			if(!$conn->set_charset("utf8")){
				printf("Error cargando el conjunto de caracteres utf8: %s\n");
			}else{
			//printf("Conjunto de caracteres actual: %s\n <br>", $conn->character_set_name());
			}
			//$selectMunicipio = "SELECT nombreMun FROM municipio WHERE idMunicipio = $mun";
			//$result = mysqli_query($conn, $selectMunicipio);
			//while ($row = mysqli_fetch_array($result)){
			//	echo "<p class='resmun'>Mostrando resultados para: ".$row['nombreMun'] ."</p><br>";
			//}
			$selectMunicipio = "SELECT nombre, idPlaya, direccion, idMun,playaSize, longitud, latitud, imagen, municipio.nombreMun FROM playas INNER JOIN municipio ON idMun = municipio.idMunicipio";
			$result = mysqli_query($conn, $selectMunicipio);
			//Abrimos <OL>
			echo "<ol>";
			while ($row = mysqli_fetch_array($result)){ //Vamos a mostrar los resultados construyendo un lenguaje de marcas adaptado al CSS
				echo "<form method='POST' action='playas.php' target='_blank'>";
				echo "<li class='beach'>"; //ABRIMOS <LI>
				echo "<h2>".$row['nombre'] ."</h2><br>"; //ABRIMOS <H2> PARA TENER UN TITULO BONITO
				if($row['imagen'] == NULL){
					echo "<img class='img' src='01.png'>";
				}else{
					echo "<img class='img' src='data:image/jpeg;base64,".base64_encode($row['imagen'])."' alt='Sin foto'>";
				}
				echo "<p>"; //Abrimos el inicio de un p?afo para meter la informaci??				//echo "<img class='img' src='01.png'>"; //A??mos el hueco para la imagen
				echo "Dirección: ".$row['direccion']."<br>";
				echo "Municipio: ".$row['nombreMun']."<br>";
				echo "Longitud de la Playa: ".$row['playaSize']."<br>";
				echo "</p>";
				echo '<a href="playas.php?id='. $row["idPlaya"] .'" class="btn">MAPA</a>';
				//echo "<input class='btn' type='submit' value='MAPA'>";
				echo "</li>";
				echo "</form>";
			}
			echo "</ol>";//CERRAMOS </OL>
		}
		conexionDropDown();
		//if(isset($_POST["municipios"]) && !EMPTY($_POST["municipios"])){ //Si existe la variable POST enviada al cambiar el indice del dropdownlist realizamos una consulta SQL
			conexionResult();
		//}	else{
			//echo "nope";
		//}	
	?>
</body>
</html>