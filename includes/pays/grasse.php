<section class="container-fluid">
	<section class="bannerCountry">
		<img src="./img/pays/grasse/gourdon-600.jpg" alt="Plan Large de Gourdon">
		<div class="bannerCountryCaption">
			<p class="bannerCountryCaptionText">Arrière Pays Grassois</p>
		</div>
	</section>
	<!-- <div class="separation"></div> -->
	<section class="presentCountry">
		<div class="square title-font"><h1>Nature</h1></div>
		<p>Les grands espaces de prairies et de bois, les pittoresques villages , la lumière, les parfums, l'éclat argenté des oliviers en font un haut-lieu de promenades et découvertes. Les paysages sont variés : moyenne montagne, plateaux arides, gorges, forêts et vallées fertiles. La culture rurale y est très forte, autour de villages vivants et conviviaux, qui sont souvent perchés sur des promontoire rocheux. Le temps s’arrête, on s’émerveille , l’authenticité touche nos coeurs… On découvre le patrimoine local, on savoure des spécialités du pays et surtout on prend son temps…
			<br />
		<i>Notre sélection de villages incontournables : Cabris, Saint-Cézaire, Caussols, Escragnolles, St Vallier de Thiey, Briançonnet, Gars, Seranon, Caille, Coursegoules, Gréolières, Consegudes, Le Mas.</i></p>
	</section>
	<!-- Carousel Fade -->


	<div id="carouselPaysFade" class="carousel slide carousel-fade" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="./img/pays/grasse/slideshow/slide1.jpg" height="400px" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="./img/pays/grasse/slideshow/slide2.jpg" height="400px" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="./img/pays/grasse/slideshow/slide3.jpg" height="400px" alt="Third slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="./img/pays/grasse/slideshow/slide4.jpg" height="400px" alt="Third slide">
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