<?php

require '../class/Database.php';
	// va chercher le fichier database.php pour connexion
$db = Database::connect();
require '../class/User.php';
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<title>GUIDER - v2.0.0</title>
	<meta charset="UTF-8">
	<!--intégration du meta viewport-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<!-- Favicon -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- Inclusion du CSS personalisé -->
	<link rel="stylesheet" href="../css/admin_index.css">
	<link rel="stylesheet" href="../css/admin_delete.css">
	<link rel="stylesheet" href="../css/admin_insert.css">
	<link rel="stylesheet" href="../css/admin_update.css">
	<link rel="stylesheet" href="../css/admin_view.css">


</head>
<body>



