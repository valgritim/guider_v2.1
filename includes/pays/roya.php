<section class="container-fluid">
	<section class="bannerCountry">
		<img src="./img/pays/roya/sospel.png" alt="Sospel">
		<div class="bannerCountryCaption">
			<p class="bannerCountryCaptionText">Vallée de la Roya</p>
		</div>
	</section>
	<!-- <div class="separation"></div> -->
	<section class="presentCountry">
		<div class="square title-font"><h1>Nature</h1></div>
		<p><strong>V</strong>allée de toutes les Merveilles. À la frontière avec l'Italie, cette région offre un décor fait de hauts sommets, de gorges, de forêts, de grands alpages. Villages perchés tels Saorge, chapelles peintes et églises baroques (à Sospel et Tende) et gravures rupestres de la Vallée des Merveilles en composent la richesse historique tandis que l'eau vive dans les gorges de la Roya répond aux attentes des visiteurs les plus sportifs...<br><br>Notre sélection de villages incontournables : <i>Saorge, Castellar, St Dalmas de Tende, Sospel, Castillon, Tende.</i></p>
	</section>
	<!-- Carousel Fade -->


	<div id="carouselPaysFade" class="carousel slide carousel-fade" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="./img/pays/roya/slideshow/slide1.jpg" height="400px" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="./img/pays/roya/slideshow/slide2.jpg" height="400px" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="./img/pays/roya/slideshow/slide3.jpg" height="400px" alt="Third slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="./img/pays/roya/slideshow/slide4.jpg" height="400px" alt="Third slide">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselPaysFade" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselPaysFade" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>-
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