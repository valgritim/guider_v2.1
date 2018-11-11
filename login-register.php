<?php include('includes/header.php'); ?>
<section class="container-fluid">
	<div id="bgLogin">
		<div class="col-xl-8 offset-xl-2 loginParts">
			<div class="row p-2">
				<div class="col-xl-6" id="loginPartL">
					<h5 class="text-center">Accéder à votre profil</h5>
					<div class="panel-heading">
						<h4 class="text-center pt-1">VOS ACCES</h4>
					</div>
					<?php 

					if (isset($_SESSION['errors']['user_LogError']) && !empty($_SESSION['errors']['user_LogError']) ){
						?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Erreur de connexion !</strong> <br /> <?php echo $_SESSION['errors']['user_LogError'] ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php } ?>
					<form class="form-horizontal" action="secure.php" method="POST">

						<div class="form-group" id="errorLogin"></div>

						<div class="form-group">										
							<label for="email" class="control-label col-xl-4">Votre Email *</label>

							<div class="col-xl-8">
								<input type="text" id="nameLogin" name="users_email" placeholder="votre email"  required>
							</div>
						</div>

						<div class="form-group">										
							<label class="control-label col-md-5" for="pwd" >Mot de passe *</label>							
							<div class="col-xl-8">	
								<input type="password" id="passwordLogin" name="users_pwd" placeholder="votre mot de passe" required>
							</div>											
							<div class="required-data pt-5">
								<label class="required pl-3"></label><i>* Données obligatoires</i>
							</div>										
						</div>

						<div class="form-group col-xl-8">
							<input class="btn-alt col-xl-8" type="submit" name="submitLogin" value="Valider"></input>
							
						</div>
					</form>
					<a href="forgot.php" class="text-light pl-3"><span class="fas fa-key">&nbsp;</span>Mot de passe oublié?</a>
				</div>
				<div class="col-xl-6" id="registerPartL">
					<h5 class="text-center">Créer votre compte</h5>
					<div class="panel-heading">
						<h4 class="text-center pt-1">CREER VOS ACCES</h4>
					</div>
					<?php 

					if (isset($_SESSION['errors']['user_exist']) && !empty($_SESSION['errors']['user_exist']) ){
						?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Erreur d'inscription !</strong> <br /> <?php echo $_SESSION['errors']['user_exist'] ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php } ?>
					<div class="col-xl-12" id="registerMessageL">
						<p>Cliquez ci-dessous et créez vos accès sur le site Guider.<br />
							<br />
						Vous disposerez ainsi d'un espace personnel pour gérer votre profil et suivre vos demandes</p>
						<br>
					</div>
					<div class="col-xl-12" id="registerFormL">
						<form class="form-horizontal" action="secure.php" method="POST" id="registerCheck">
							

							<div class="form-group" id="errorRegister"></div>
							<div class="form-group col-xl-8">					
								<label for="firstName" class="control-label col-xl-12">Nom</label>
								<input class="col-xl-12" type="text" name="users_last" placeholder="votre nom">

							</div>  
							<div class="form-group col-xl-8">
								<label for="lastName" class="control-label col-xl-12">Prénom</label>
								<input class="col-xl-12" type="text" name="users_first" placeholder="votre prénom">

							</div> 
							<div class="form-group col-xl-8">
								<label for="phone" class="control-label col-xl-12">Téléphone</label>
								<input class="col-xl-12" type="text" name="users_phone" placeholder="votre téléphone">

							</div>
							<div class="form-group col-xl-8">
								<label for="email" class="control-label col-xl-12">E-mail</label>
								<input class="col-xl-12" type="email" name="users_email" placeholder="votre email">

							</div> 
							<div class="form-group col-xl-8">
								<label for="pass" class="control-label col-xl-12">Mot de passe</label>
								<input class="col-xl-12" type="password" name="users_pwd" placeholder="votre mot de passe">

							</div>
							<input class="btn-alt col-xl-6" type="submit" name="submitRegister" value="Valider">

						</form>            		
					</div>
					<button id="registerBtnDisplayL" class="btn-alt col-xl-6">S'inscrire</button>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include('includes/footer.php'); ?>