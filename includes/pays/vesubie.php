<section class="container-fluid">
	<section class="bannerCountry">
		<img src="./img/pays/vesubie/boreon.png" alt="Boréon">
		<div class="bannerCountryCaption">
			<p class="bannerCountryCaptionText">Vallée de la Vésubie</p>
		</div>
	</section>
	<!-- <div class="separation"></div> -->
	<section class="presentCountry">
		<div class="square title-font"><h1>Nature</h1></div>
		<p>
			<strong>A</strong> une heure de la Côte d'Azur, plusieurs villages de charme pour vos vacances et vos loisirs, au coeur du Parc National du Mercantour, aux portes de la vallée des merveilles, cette vallée se dévoile au sein d'un environnement sauvage et préservé. la Vésubie offre une large palette d'activités de pleine nature, été comme hiver, de la randonnée à la pêche à la truite, en passant par les sports en eau vive.<br />Notre sélection de villages incontournables : <i>Roquebilière, Venanson, La Bollène Vésubie, St Martin Vésubie.</i>
			
		</p>
	</section>
	<!-- Carousel Fade -->


	<div id="carouselPaysFade" class="carousel slide carousel-fade" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="./img/pays/vesubie/slideshow/slide1.jpg" height="400px" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="./img/pays/vesubie/slideshow/slide2.jpg" height="400px" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="./img/pays/vesubie/slideshow/slide3.jpg" height="400px" alt="Third slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="./img/pays/vesubie/slideshow/slide4.jpg" height="400px" alt="Third slide">
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