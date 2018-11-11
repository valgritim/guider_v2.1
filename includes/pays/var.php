<section class="container-fluid">
	<section class="bannerCountry">
		<img src="./img/pays/var/beuil.png" alt="Beuil les Launes">
		<div class="bannerCountryCaption">
			<p class="bannerCountryCaptionText">Vallée du Var</p>
		</div>
	</section>
	<!-- <div class="separation"></div> -->
	<section class="presentCountry">
		<div class="square title-font"><h1>Nature</h1></div>
		<p>
			<strong>C</strong>'est le pays des gorges grandioses telles celles du Cians et de Daluis, abruptes, encaissées, profondément sculptées par les eaux dans les schistes rouges. On y croise donc des formations géologiques particulières. Le contraste est saisissant entre la haute et la moyenne vallée du Var, plus évasée, où serpente au soleil, le fameux "Train des Pignes"...<br />Notre sélection de villages incontournables : <i>Beuil, Touët-sur-Var, Guillaume, Villars-sur-Var, Puget-Theniers</i>
		</p>
	</section>
	<!-- Carousel Fade -->


	<div id="carouselPaysFade" class="carousel slide carousel-fade" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="./img/pays/var/slideshow/slide1.jpg" height="400px" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="./img/pays/var/slideshow/slide2.jpg" height="400px" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="./img/pays/var/slideshow/slide3.jpg" height="400px" alt="Third slide">
			</div>
			
		</div>
		<a class="carousel-control-prev" href="#carouselPaysFade" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselPaysFade" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<!-- FIn Carousel -->
<section class="presentGuide">
		<div class="square title-font"><h1>Guides</h1></div>
		<div class="row col-xl-12">
			<div class="localGuide col-sm-12 col-md-7 col-lg-7 col-xl-8 mb-5">
				
				<?php
				countryListGuides($db, (int)$_GET['url']);
				// appel fonction avec comme parametres la connexion a la bd et l'url du pays(id)
				?>

			</div>
			<!-- Map -->
			<div id="mapid" class="col-md-5 col-lg-5 col-xl-4">
				
			</div>
		</div>
	</section>
</section>