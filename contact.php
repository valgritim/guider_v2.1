<?php

include('./includes/header.php');

?>

<!-- formulaire -->
<section id="contactF" class="container-fluid " style="background-image: url(img/saintPaul.jpg);">
	<div class="login-boxForm mt-5 mb-2" id="loginBoxForm">     
		<h2 class="mb-4">Formulaire de contact</h2>
		<?php 

		if (isset($_SESSION['errorContact']) && !empty($_SESSION['errorContact']) ){
			?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Une erreur est arrivée!</strong> <br /> 
				<?php 

					foreach($_SESSION['errorContact'] as $key=>$value){

							echo $value . '<br/>' ;

					}

				 ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php } ?>

		<form action="secure.php" method="POST" enctype="multipart/form-data" id="contact">
			<div class="row contact col-xl-12">
				<div class="flex-col col-xl-6">

					<label class="contactLabel">Nom : <span class="blue"> *</span></label>
					<input class="inputContact" type="text" name="name">
					<br/>
					<label class="contactLabel">Prénom : <span class="blue">*</span></label>
					<input class="inputContact" type="text" name="firstname">
					<br/>
					<label class="contactLabel">Mail : <span class="blue"> *</span></label>
					<input class="inputContact" type="text" name="email">
				</div>
				<br/>
				<div class="flex-col col-xl-6">


					<label class="contactLabel mr-3">Tél : <span class="blue">*</span></label>
					<input class="inputContact" type="text" name="phone">

					<label class="contactLabel">Objet : <span class="blue"> *</span></label>
					<input class="inputContact" type="text" name="objet">

					<label class="contactLabel pt-4">Pièce jointe : </label>
					<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
					<input type="file" name="file">


				</div>
				<br/>
				<div class="col-xl-12">

					<label class="contactLabel">Votre message : <span class="blue"> </span></label><br>
					<textarea id="message" name="message"></textarea>

					<p class="requises"><span class="blue">* Ces informations sont requises</span></p>


				</div>
				
				<input id="bouton" class="btn ml-3" type="submit" name="contact" value="Envoyer">

				<?php 

				if (isset($_SESSION['envoi'])){ 

					echo '<p class="thanks" style="display:block;">Votre message a bien été envoyé!</p>';
				} else {

					echo '<p class="thanks" style="display:none;"</p>'; 

				};

				?>
				</div>
		</form>
		</div>
	</section>
	<?php include('./includes/footer.php'); ?>