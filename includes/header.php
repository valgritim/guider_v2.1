<?php
	
	require './class/Database.php';
	// va chercher le fichier database.php pour connexion
	$db = Database::connect();
	require('functions.php');
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>GUIDER - v2.1.0</title>
		<meta charset="UTF-8">
		<!--intégration du meta viewport-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="./img/logo.png" />
		<!--intégration du Bootstrap CSS par CDN-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Roboto" rel="stylesheet">
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css"
  integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
  crossorigin=""/> 
		

		<!-- Inclusion du CSS personalisé -->
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/pays.css">
		<link rel="stylesheet" href="./css/login.css">
		<link rel="stylesheet" href="./css/forgotPwd.css">
		<link rel="stylesheet" href="./css/contactForm.css">
		
		
		
	</head>
	<body>
		
			<?php include('nav.php'); ?>
		
			