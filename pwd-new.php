<?php

session_start();

require ('class/Database.php');

$error = "Mot de passe incorrect";
$success = "Mot de passe modifié!<br/>Vous pouvez vous connecter";

$pwd_reset = $pwd_verif = "";

// gestion des erreurs, verification des champs du formulaire:
if(!empty($_POST)){

	if(empty($_POST['pwd_reset']) || empty($_POST['pwd_verif'])){
		//  si les champs sont vides après le post

			$_SESSION['error'] = $error;

	} else {
	// je verifie si le champ 1 est egal au champ 2
	
		if($_POST['pwd_reset'] !== $_POST['pwd_verif']){

				$_SESSION['error'] = $error;
		
		} else {
			// récupération de l'users id de la session en cours et hachage du mot de passe
			
			$pwd_reset = $_POST['pwd_verif'];
			$passHash = password_hash($pwd_reset, PASSWORD_DEFAULT);

			$db = database::connect();

			$statement = $db->prepare("UPDATE users SET users_pwd = ? WHERE users_id = ?");
			$statement->execute(array($passHash,$_SESSION['u_id']));

			header('Location:login.php?modifyPwd=success');
		}
	}
}

?>

<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>GUIDER</title>
		<meta charset="UTF-8">
		<link href="css/createPwd.css" rel="stylesheet" type="text/css">
		<!--intégration du meta viewport-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<!--intégration du Bootstrap CSS par CDN-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
		
	</head>
	<body>
		<!-- Body------------------------------ -->
				   
		<!-- container de Login -->
		<div class="login-box">
			<div class="container">
			<!-- header------------------>
				<div class="row ml-0">
					<div class="col-md-12 col-lg-12">
						<h3 class="pb-5">Réinitialisation de mot de passe</h3>
					</div>
				</div>
			<!-- corps du login -->
				<div class="container">
				
					<div class="row">
						<div class="offset-1 col-lg-10 col-md-12">
							<?php
		                    	if(isset($_SESSION["error"])){
								         $error = $_SESSION["error"];
								         echo "<div class='alert alert-danger text-center'>" . $error . "</div><br/>";
								} 
								if(isset($_SESSION['success'])) {

		                   			$success = $_SESSION['success'];
		                   			echo "<div class='alert alert-success text-center'>" . $success . "</div><br/>";
		                   		}
		               		?>  
							
							<div class="panel-heading">
								<h4 class="text-center pt-1">NOUVEAU MOT DE PASSE</h4>
							</div>

							<form class="form-horizontal py-3" action="create_newPwd.php" method="POST">
									<div class="form-group">										
										<label for="pwd_reset" class="control-label col-lg-10 col-md-8"><strong>Entrez votre mot de passe *</strong></label>

										<div class="col-lg-10">
											<input type="text" name="pwd_reset" placeholder="votre mot de passe" required>
										</div>
									</div>

									<div class="form-group">										
										<label for="pwd_verif" class="control-label col-lg-10 col-md-8"><strong>Confirmer le nouveau mot de passe *</strong></label>

										<div class="col-lg-10">
											<input type="text" name="pwd_verif" placeholder="votre mot de passe" required>
										</div>
									</div>

									<div class="required-data py-2">
										<label class="required pl-3"></label><i>* Données obligatoires</i>
									</div>

									<div class="form-group col-lg-10">
										<input class="btn col-lg-8 col-md-6" type="submit" name="submit" value="Valider">
										<br><br>		
									</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	<!--------SCRIPTS--------------------------------------------------------->

	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	
</body>	
</html>