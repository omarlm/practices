<html>
<head></head>
<body>
	<?PHP
	session_start();
	session_destroy();
	unset($_SESSION["user"]);
	header('Location: inicio.php');
?>
</body>
</html>		