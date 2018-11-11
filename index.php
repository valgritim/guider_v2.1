<?php include('includes/header.php'); 

//Debug
// if (!empty($_SESSION['user'])){
// 	echo '<p style="margin-top:100px; font-size: 20px;">' . $_SESSION['user']['MAIL'] . '</p>';
// }
?>
<section class="container-fluid">
	<section id="banner">
		<div id="bannerCaption">
			<p><span class="upper superbold title-font">Guider</span>
				<br />
				Sortez des sentiers battus...
			</p>
		</div>
	</section>
	
	<section id="prolog">
		<div class="square title-font"><h1>Découvrir</h1></div>
		<p><span class="bold">N</span>otre arrière-pays est riche en villages typiques, vallées vertes, points de vue insoupçonnés... Nous vous aidons à les découvrir.<br />
			Venez vivre et partager des moments inoubliables avec <span class="bold">nos guides locaux</span>, garants de l'histoire de leur région, mémoires vivantes et fins connaisseurs du terroir. Aller dans l'arrière-pays, c'est quitter la ville pour se retirer à la campagne proche, c'est un retour aux sources. <br />
			Pour les amoureux de l'authenticité... nous avons conçu <span class="title-font bold">GUIDER</span>...</p>
		</section>	

		<section id="destCarousel">
			<!-- Affichage du carousel large pour tous les écrans sauf les small -->
			<section id="carouselLarge" class="pt-4 pb-4">
				<?php include('./includes/carousel.php'); ?>
			</section>
			<!-- Affichage du carousel small pour tous les smartphones -->
			<section id="carouselSmall">
				<?php include('./includes/carouselSmall.php'); ?>
			</section>


		</section>

		<section id="map">
			<div class="square title-font"><h1>Trouver</h1></div>
			<div id="mapDetail">
				<img src="img/carte.jpg" alt="CountryMap" id="countryMap">
				<ul id="listCountry">
					<li><span class="badge badge-pill badge-secondary">1</span>&nbsp;-&nbsp;Arrière-pays Grassois</li>
					<li><span class="badge badge-pill badge-secondary">2</span>&nbsp;-&nbsp;Vallée de l'Esteron</li>
					<li><span class="badge badge-pill badge-secondary">3</span>&nbsp;-&nbsp;Vallée du Var</li>
					<li><span class="badge badge-pill badge-secondary">4</span>&nbsp;-&nbsp;Vallée de la Tinée</li>
					<li><span class="badge badge-pill badge-secondary">5</span>&nbsp;-&nbsp;Vallée de la Vésubie</li>
					<li><span class="badge badge-pill badge-secondary">6</span>&nbsp;-&nbsp;Pays des Paillons</li>
					<li><span class="badge badge-pill badge-secondary">7</span>&nbsp;-&nbsp;Vallée de la Roya</li>
				</ul>

				<img src="img/Bellet.jpg" height="45%" width="45%" alt="Bellet" id="lastImgMap">

			</div>
		</section>

	</section>




	<?php include('includes/footer.php'); ?>