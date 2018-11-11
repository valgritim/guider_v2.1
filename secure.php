<?php

require './class/Database.php';
	// va chercher le fichier database.php pour connexion
$db = Database::connect();

require('./includes/functions.php');

session_start();

//post button registration new user

if(isset($_POST['submitRegister']) && !empty($_POST['submitRegister'])){

	$first = cleanInput($_POST['users_first']);
	$last = cleanInput($_POST['users_last']);
	$email = cleanInput($_POST['users_email']);
	$phone= cleanInput($_POST['users_phone']);
	$pwd = $_POST['users_pwd'];

	 // hashage du password pour sécurité

	$passHash = password_hash($pwd, PASSWORD_DEFAULT);

		
	$user = new User($email,$passHash,$id='',$first,$last,$phone);
	if($user->exist($db)){

		$_SESSION['errors']['user_exist'] = "Cet utilisateur existe déjà";


		header('Location:login-register.php');
	} else {
		$regInput = '/^([a-z éèêñçîì]{2,30})$/i';
		$regPhone = '/^([+(\d]{1})(([\d+() -.]){5,16})([+(\d]{1})$/';

		if ((isset($first) && !empty($first)) && (isset($last) && !empty($last))){

			if(preg_match($regInput, $first) && preg_match($regInput, $last)){

				if(isset($phone) && !empty($phone)){

					if(preg_match($regPhone, $phone)){

						if(filter_var($email, FILTER_VALIDATE_EMAIL)){

							if(isset($pwd) && !empty($pwd) && strlen($pwd) >= 8 && strlen($pwd) <= 16){

								// All verification has been passed, we created a new DB entry
								try{

									$user->add($db);
									header('Location:login-register.php');
									//echo "OK en DB <a href='login-register.php'> Retout a la page login</a>";		
								}
								catch(CustomException $e){

									die("<br /><strong>Error ! Details: </strong><br />" . $e->getMessage());

								}

							}else{
								header('Location:login-register.php'); //work
								//echo "le pass ou confPass est vide ou n'existe pas ou ne corrrespond pas au filtre <a href='login-register.php'> Retout a la page login</a>";
							}
						}else{
							header('Location:login-register.php'); //work
							//echo "Le champs email ne correspond pas au filtre <a href='login-register.php'> Retout a la page login</a>";
						}
					}else{
						header('Location:login-register.php'); //work
						//echo "Le champs téléphone ne correspond pas au regex <a href='login-register.php'> Retout a la page login</a>";
					}
				}else{
					header('Location:login-register.php'); //work
					//echo "le champs telephone n'existe pas ou est vide <a href='login-register.php'> Retout a la page login</a>";
				}
			}else{
				header('Location:login-register.php'); //work
				//echo "erreur de regex nom ou prénom <a href='login-register.php'> Retout a la page login</a>";
			}
		}else{
			header('Location:index.php');
			//echo "un champs nom ou prénom n'existe pas ou est vide <a href='login-register.php'> Retout a la page login</a>";
		}

	}

}

// post button authentication user
if(isset($_POST['submitLogin']) && !empty($_POST['submitLogin'])){

	$email = cleanInput($_POST['users_email']);
	$pwd = $_POST['users_pwd'];

	$user = new User($email,$pwd);

	

	try{

		$user->authenticate($db);		
	}
	catch(CustomException $e){
		die("<br /><strong>Error ! Details: </strong><br />" . $e->getMessage());

	}
}
// post button update user for admin part

if(isset($_POST['update']) && !empty($_POST['update'])){

	$users_first = cleanInput($_POST['users_first']);   
	$users_last = cleanInput($_POST['users_last']);
	$users_phone = cleanInput($_POST['users_phone']);
	$users_email = cleanInput($_POST['users_email']);
	$users_id = $_SESSION['user']['ID'];
	$users_pwd = $_SESSION['user']['PASS'];

	$user = new User($users_email,$users_pwd,$users_id,$users_first,$users_last,$users_phone);  

	try{

		$user->update($db);	
		$user->resync($db);

		header('Location:account.php?modify=success');
		
	}

	catch(CustomException $e){
		die("<br /><strong>Error ! Details: </strong><br />" . $e->getMessage());

	}

}

// post button contact form

if ((isset($_POST['contact'])) && !empty($_POST['contact'])){

	if(isset($_SESSION['errorContact'])){

		unset($_SESSION['errorContact']);
	}

	$firstname = cleanInput($_POST["firstname"]);
	$name = cleanInput($_POST["name"]);
	$email = filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL);
	$phone= cleanInput(preg_match("/^[0-9 ]*$/",($_POST["phone"])));
	$message = cleanInput($_POST["message"]);
	$objet = cleanInput($_POST["objet"]);
	$isSuccess = true;
	$emailText = "";
	$emailTo = "vb@valeriebaron.website";


				// traitement input prenom

	if(empty($firstname)){

		$_SESSION['errorContact']['firstnameError'] = "Veuillez rentrer votre prénom";
		$isSuccess = false;
	}
	else{
		$emailText .= "Prénom: $firstname<br>";
	}
				// traitement input nom

	if(empty($name)){

		$_SESSION['errorContact']['lastnameError'] = "Veuillez rentrer votre nom";
		$isSuccess = false;
	}
	else{

		$emailText .= "Nom: $name<br>";
	}
				// traitement input email

	if(empty($email)){

		$_SESSION['errorContact']['emailError'] = "Veuillez rentrer un email valide";
		$isSuccess = false;
	}
	else{

		$emailText .= "Email: $email<br>";
	}

				// traitement input message
	if(empty($message)){

		$_SESSION['errorContact']['message'] = "Veuillez rentrer un message";
		$isSuccess = false;
	}
	else{

		$emailText .= "Message: $message<br>";
	}
				// traitement input objet

	if(empty($objet)){

		$_SESSION['errorContact']['objectError'] = "Veuillez rentrer l'objet de votre demande";
		$isSuccess = false;
	}
	else{

		$emailText .= "Objet du message: $objet<br>";
	}
				// traitement input telephone

	if(empty($phone)){

		$_SESSION['errorContact']['phoneError'] = "Veuillez entrer des chiffres et/ou des espaces";
		$isSuccess = false;
	}
	if(empty($phone)){

		$phoneError = "Veuillez entrer un numéro de téléphone";
		$isSuccess = false;
	}
	else{

		$emailText .= "telephone: $phone<br>";
	}
				// TRAITEMENT DU FICHIER JOINT

	if (isset($_FILES['file']) AND $_FILES['file']['error'] == 0){

		        // Testons si le fichier n'est pas trop gros
		if ($_FILES['file']['size'] <= 2000000)
		{


		                // Testons si l'extension est autorisée

			$infosfichier = pathinfo($_FILES['file']['name']);
			$extension_upload = $infosfichier['extension'];
			$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'pdf');

			if (in_array($extension_upload, $extensions_autorisees)) {

		            	//=====Lecture et mise en forme de la pièce jointe.

				$pathfile =  $_FILES['file']['tmp_name'];
				$typepiecejointe = filetype($pathfile);
				$data = chunk_split( base64_encode(file_get_contents($_FILES['file']['tmp_name'])));
				$isSuccess = true;
			}
		}
		else{
			$_SESSION['errorContact']['fileTooHeavy'] = " le fichier est trop lourd, maxi 2 mo";
			$isSuccess = false;
		}
	}
			// utilisation fonction php pour envoi email(adresse, message, concatenation des infos, entete de l email qui correspond a toutes les infos et à qui je dois reply to)


	if($isSuccess){
		$mon_fichier = $_FILES['file']['name'];

					//header for sender info
		$headers = "From: $firstname $name"." <".$email.">";

				//boundary 
		$semi_rand = md5(time()); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

				//headers for attachment 
		$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

				//multipart boundary 
		$corps_message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"utf-8\"\n" . "Content-Transfer-Encoding:8bit\n\n" . $emailText . "\n\n"; 

		$corps_message .= "--{$mime_boundary}\n";

		$corps_message .= "Content-Type: application/octet-stream; name=\"".$mon_fichier."\"\n" . "Content-Description: imagejpg\n" ."Content-Disposition: attachment;\n" . " filename=\"".$mon_fichier."\"; size=".$_FILES['file']['size'].";\n" . "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";

		$corps_message .= "--{$mime_boundary}--";
		$returnpath = "-f" . $emailTo;

		try{

				//send email
			mail($emailTo. ',' .$_POST["email"], $objet, $corps_message, $headers, $returnpath); 
			$_SESSION['success'] = "L'email a bien été envoyé";
			$firstname = $name = $email = $phone = $message = $objet = $file = "";
			$envoi = $_SESSION['envoi'];
			header('Location:contact.php');			
		}
		catch(CustomException $e){

			die("<br /><strong>Error ! Details: </strong><br />" . $e->getMessage());

		}

	} else {

		header('Location:contact.php');

	}
}





