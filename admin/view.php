<?php

include 'header_admin.php';

if(!empty($_GET['id'])){
    
    $id = checkInput($_GET['id']);
}

// $db = Database::connect();
$statement = $db->prepare('SELECT guides.id, guides.guide_first, guides.guide_last, guides.photo,guides.id_commune, coordonnees.commune_coord AS commune, guides.langue,guides.prestation,guides.theme, pays.nom_pays AS pays FROM guides, pays, coordonnees WHERE  guides.id_commune = coordonnees.id AND guides.guide_pays = pays.id AND guides.id = ?');


$statement->execute(array($id));
$item = $statement->fetch();
Database::disconnect();

function checkInput($data){
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    
}
?>

<body>
    <h1 class="text-logo text-center" style="color:#fff;"><i class="fas fa-id-badge"></i> Guider </h1>

    <div class="container view mt-5 pt-5 pb-5">
        <div class="row view">
            <div class="col-sm-6 col-md-6 col-lg-6 pl-5">
                <h1><strong>Fiche guide</strong></h1>
                <br>
                <form>
                    <div class="form-group">
                        <label>Nom:</label>
                            <?php echo ' '. $item['guide_last']; ?>
                    </div>

                    <div class="form-group">
                        <label>Prénom:</label>
                            <?php echo ' '. $item['guide_first']; ?>
                    </div>

                    <div class="form-group">
                        <label>Description:</label>
                            <?php echo ' '. $item['prestation']; ?>
                    </div>

                    <div class="form-group">
                        <label>Pays:</label>
                            <?php echo ' '. $item['pays']; ?>
                    </div>

                    <div class="form-group">
                        <label>Commune:</label>
                            <?php echo ' '. $item['commune']; ?>
                    </div>

                    <div class="form-group">
                        <label>Langue:</label>
                            <?php echo ' '. $item['langue']; ?>
                    </div>

                    <div class="form-group">
                        <label>Thème:</label>
                            <?php echo ' '. $item['theme']; ?>
                    </div>

                    <div class="form-group">
                        <label>Nom photo:</label>
                            <?php echo ' '. $item['photo']; ?>
                    </div>
                </form>
                <br>
                <div class="form-actions">
                        <a class="btn btn-primary btn-lg" href="index.php"><i class="fas fa-arrow-left"></i> Retour</a>
                    </div>
            </div>
            <div class="col-lg-4 site">
                <div class="card-deck viewport">
                    <div class="card view">
                        <img class="card-img-top" src="<?php echo '../img/guides/' . $item['photo'] ; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title view"><?php echo $item['guide_last'] . ' ' . $item['guide_first']; ?></h5>
                            
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Secteur: <?php echo $item['pays']; ?></li>
                            <li class="list-group-item">Commune: <?php echo $item['commune']; ?></li>
                            <li class="list-group-item">Thème: <?php echo $item['theme']; ?></li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>   
</body>
</html>
