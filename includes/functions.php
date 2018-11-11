<?php
// Require class

require './class/CustomException.php';
require './class/User.php';




function countryListGuides($db,$id){
	// j'ai besoin de 2 paramètres: la variable de connexion à la bd et l'id du pays queje vais récupérer avec le Get Url sur la page pays choisie.

	$statement = $db->prepare('SELECT guides.id, guides.guide_first, guides.guide_last, coordonnees.commune_coord AS commune, guides.langue,guides.prestation,guides.theme, guides.photo,pays.nom_pays AS pays ,coordonnees.latitude, coordonnees.longitude FROM guides, coordonnees, pays WHERE  guides.id_commune = coordonnees.id AND guides.guide_pays = pays.id AND guides.guide_pays = :id');

	$statement->bindValue(":id", $id, PDO::PARAM_INT);
	$statement->execute();		

	while ($item = $statement->fetch()) 
// prend la premiere ligne du statement et le met dans le html, s'execute tant qu'il y a des lignes
	{
		echo '<div class="card js-marker" data-lat = "' . $item['latitude'] . '" data-lng = "' . $item['longitude'] . '" data-text = "' . $item['guide_first'] . ' ' . $item['guide_last'] . '">
		<img class="card-img-top" src="./img/guides/' . $item['photo'] . '" alt="Card image cap"> 
		<div class="card-body">
		<h4 class="card-title"><strong>' . $item['guide_first'] . '</strong>'. ' ' . '<strong>'. $item['guide_last'] . '</strong>' . '</h4>
		<p class="card-text"><strong>Thème: </strong>' . $item['theme'] . ' <br><strong>Vallée:  </strong>' . $item['pays'] . ' <br><strong>Village:  </strong>' . $item['commune'] . ' <br><strong>Langues parlées: </strong>' . $item['langue'] . '</p>
		</div>
		<div class="card-footer" id="ensavoirplus">									     
		<a class="btn p-2 rounded" href="includes/pays/view_guide.php?id=' .$item['id'] . '">En savoir +</a>
		</div>
		</div>';
	}

}

function cleanInput($var){

	$var = trim($var);
	$var = stripslashes($var);
	$var = htmlspecialchars($var);

	return $var;

}



