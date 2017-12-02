<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style.css">
	<title>Playas de Tenerife</title>
</head>
<body>
	<div class="header">
		<div class="titulo">
			<p class="linkshead">
			<a class="menulinks" href="todas.php" >Todas las playas </a>| Gráfico | Log-in
			</p>
			<p>
				Playas de Tenerife
			</p>
		</div>
	</div>
	<?PHP 
		if(ISSET($_POST["user"]) && ISSET($_POST["clave"])){
			$user = $_POST["user"];
			$clave = $_POST["clave"];
			echo $user;
			echo $clave;
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
			}else{
			//printf("Conjunto de caracteres actual: %s\n <br>", $conn->character_set_name());
			}
			$count = 0;
			$sql = "SELECT clave, privilegios FROM usuarios WHERE login = '$user'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			
				if( $row["clave"] == $clave){
					session_start();
					$_SESSION["user"] = $user;
					$_SESSION["privilegios"] = $row["privilegios"];
					header('Location: inicio.php');
				}else{
					echo "Login INCORRECTO";
					header('Location: inicio.php');
				}
			
		}
	?>
</body>
</html>