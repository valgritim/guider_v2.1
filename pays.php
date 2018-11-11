<?php 

// We include the header which contains all meta and navigation.
include('includes/header.php');

// We check if a GET request was sent.
if (isset($_GET['url'])){

	// Here we use an if, else if, else condition instead of a switch.
	// Each value is the same as the id into the database.
	if ($_GET['url'] == 1){

		include('includes/pays/grasse.php'); 

	}elseif($_GET['url'] == 2){
		
		include('includes/pays/esteron.php'); 
		
	}elseif($_GET['url'] == 3){
		
		include('includes/pays/var.php'); 
		
	}elseif($_GET['url'] == 4){
		
		include('includes/pays/tinee.php'); 
		
	}elseif($_GET['url'] == 5){
		
		include('includes/pays/vesubie.php'); 
		
	}elseif($_GET['url'] == 6){
		
		include('includes/pays/paillon.php'); 
		
	}elseif($_GET['url'] == 7){
		
		include('includes/pays/roya.php'); 
		
	}else{
		echo "<div class='alert alert-info alert-box'><strong>Ups !</strong> La page demandée n'existe pas.<br />La page à laquelle vous tentez d'accéder n'existe pas. Cliquer pour <a href='index.php' alt='retour à l'accueil'>revenir à l'accueil.</a></div>";
	}
}else{
	echo "<div class='alert alert-info alert-box'><strong>Ups !</strong> La page demandée n'existe pas.<br />La page à laquelle vous tentez d'accéder n'existe pas. Cliquer pour <a href='index.php' alt='retour à l'accueil'>revenir à l'accueil.</a></div>";
}

// We include the footer which contain also our scripts
include('includes/footer.php'); ?>
