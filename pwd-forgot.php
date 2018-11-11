<?php
	
	 include('includes/header.php'); 
	
	$error = "Identifiant inconnu";
	$success = "Un email a été envoyé";
	$email = $pwd = "";
	


if(!empty($_POST)){

	$email = $_POST['users_email'];

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		// je verifie si l'email rentré correspond bien à un email: erreur:

		$_SESSION['error'] = $error;

	} else {
		// l email a bien le format email. Connexion database et verification si email entré existe ou pas

		// $db = Database::connect();

		$statement = $db->query("SELECT * FROM users WHERE users_email='$email';");
		$result =  $statement->fetch();

		if($result > 0){
			// l 'email existe:

		$email = $result['users_email'];
		$id = $result['users_id'];

		// $db = Database::connect();

		//creation du token sécurisé 
		$token = openssl_random_pseudo_bytes(16);
		$tokenHex = bin2hex($token);

		//insertion des informations dans la table password_reset_request

		$newStatement = $db->prepare("INSERT INTO password_reset_request (user_id,date_requested,token) VALUES (?,?,?)");

		$newResult = $newStatement->execute(array($id,date("Y-m-d H:i:s"),$tokenHex));


		// je récupère l'id du dernier rang inséré dans la base

		$passwordRequestId = $db->lastInsertId();

		$verifyScript = 'https://guider.devcannes.com/verify_link.php';

		// creation du lien de modification sur la page reset_pwd.php avec l'id du user (table users) et l'id de la demande (table password_reset_request) + le token

		$linkToSend = $verifyScript . '?u_id=' . $id . '&id=' . $passwordRequestId . '&t=' . $tokenHex;

		 
		// j'envoie l'email contenant le lien de modification du mot de passe:
		$subject = "Récupération de mot de passe";
		$body = "Bonjour, veuillez cliquer sur le lien suivant pour réinitialiser votre mot de passe:" . $linkToSend;
		$pwd=$result['users_pwd'];		
		mail($email, $subject, $body, "To: $email");

		$_SESSION['success'] = $success;

		// debug

		// echo '<p class="forgotP" style="font-size: 2rem; margin-top:3rem; font-weight: bold;">' . $linkToSend . '</p>';


		} else { 
			// l'email n'existe pas , j'envoie un message d'erreur
		
		$_SESSION['error'] = $error;

		header('Location:forgot.php?login=unknown');

		}
	}	
	
}



?>
<body id="forgot" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
	   
		<!-- container de Login -->
		<div class="login-box">
			<div class="container">
			<!-- header------------------>
				<div class="row ml-0">
					<div class="col-md-12 col-lg-12">					
						<h3 class="pb-5">Récupérer mon mot de passe</h3>
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
								<h4 class="text-center pt-1">MON IDENTIFIANT</h4>
							</div>
							<form class="form-horizontal py-3" action="forgot.php" method="POST">
								
								<div class="form-group">										
									<label for="email" class="control-label col-lg-10 col-md-8"><strong>Votre Email *</strong></label>

									<div class="col-lg-10">
										<input type="text" id="name" name="users_email" placeholder="votre email" required>
									</div>
								</div>

								<div class="required-data py-2">
									<label class="required pl-3"></label><i>* Données obligatoires</i>
								</div>

								<div class="form-group col-lg-10">
									<input class="btn-alt col-lg-8 col-md-6" type="submit" name="submit" value="Valider">
									<br><br>									
										
               						<a class="forgot" href="login.php"><i class="fas fa-arrow-left"></i> Retour login</a>
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
<?php
    unset($_SESSION["error"]);
    unset($_SESSION['success']);
?>