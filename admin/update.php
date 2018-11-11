    <?php

    require 'header_admin.php';


    if(!empty($_GET['id']))
        /*on peut voir l'id sur la page index.php admin dans l'url:je veux le récupérer*/
    {
        $id = checkInput($_GET['id']);
    }

    // traitement du Post

    $communeError = $langueError = $themeError = $prestationError = $paysError = $imageError = "";
    $commune = $langue = $theme = $prestation = $pays = $image = "";

    // 1. IF/si le post est activé: gestion des erreurs/champs vides

    if(!empty($_POST))
    {
        $commune = checkInput($_POST['id_commune']);
        $langue = checkInput($_POST['langue']);
        $theme = checkInput($_POST['theme']);
        $prestation = checkInput($_POST['prestation']);
        $pays = checkInput($_POST['guide_pays']);
        $image = checkInput($_FILES['image']['name']);
        $imagePath = '../img/guides/' . basename($image);
        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $isSuccess = true;


        if(empty($commune))
        {
            $communeError = "Ce champ ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($langue))
        {
            $langueError = "Ce champ ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($theme))
        {
            $themeError = "Ce champ ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($prestation))
        {
            $prestationError = "Ce champ ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($pays))
        {
            $paysError = "Ce champ ne peut pas être vide";
            $isSuccess = false;
        }
        
        if(empty($image))
        {
            $isImageUpdated = false;
            
            // 2. le post est activé et les champs ne sont pas vides:
        } else {  

            $isImageUpdated = true;
            $isUploadSuccess = true;

            //Input image non vide : traitement des erreurs pour le telechargement des images

            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
            {
                $imageError = "les fichiers autorises sont .jpg .png .jpeg et .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath))
            {
                $imageError = "le fichier existe déjà";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 10000000)
            {
                $imageError = "le fichier ne doit pas dépasser les 10 mo";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess)
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
                {
                    $imageError = "il y a eu une erreur lors du chargement";
                    $isUploadSuccess = false;
                }
            }
        }

        // traitement des données si success=true

        if(($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated))
        {

               // UPdate avec une image
            if($isImageUpdated)
            {
                $statement = $db->prepare("UPDATE guides set guide_pays = ?,langue = ?,theme = ?,prestation = ?,photo = ?, id_commune = ? WHERE id = ?");
                $statement->execute(array($pays,$langue,$theme,$prestation,$image,$commune,$id));
            }
        // update sans image
            else 
            {
                $statement = $db->prepare("UPDATE guides set guide_pays = ?,langue = ?,theme = ?,prestation = ?, id_commune = ? WHERE id = ?");
                $statement->execute(array($pays,$langue,$theme,$prestation,$commune,$id));


            }

            Database::disconnect();
            header("Location: index.php?update=success");
        }
        // s'il n'y a qu'une update d'images
        
        else if($isImageUpdated && !$isUploadSuccess)
        {
            // $db = Database::connect();
            $statement = $db->prepare("SELECT photo FROM guides WHERE id = ?");
            $statement->execute(array($id));
            $item = $statement->fetch();
            $image = $item['photo'];
            Database::disconnect();
            
        }
    }
    else /*je dois récuperer toutes les infos sur mon item apres le GET grace à l'id donc avant le POST*/
    {

        $statement = $db->prepare("SELECT guides.guide_first, guides.guide_last, guides.id_commune, guides.langue, guides.theme, guides.prestation, guides.guide_pays, guides.photo, pays.nom_pays AS pays, coordonnees.commune_coord AS commune FROM guides, coordonnees, pays WHERE guides.id_commune = coordonnees.id AND guides.id = ?");

        $statement->execute(array($id));
        $item = $statement->fetch();
        $guide_first = $item['guide_first'];
        $guide_last = $item['guide_last'];
        $commune = $item['id_commune'];
        $langue = $item['langue'];
        $theme = $item['theme'];
        $prestation = $item['prestation'];
        $pays = $item['guide_pays'];
        $image = $item['photo'];  
        Database::disconnect();
        /*je repartis les valeurs avec les donnees de ma base selon les champs de mon formulaire*/

    }
    

    function checkInput($data){

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }

    ?>

    <body>
        <h1 class="text-logo text-center" style="color: #fff"><i class="fas fa-id-badge"></i> Guider </h1>

        <div class="container update offset-lg-2 col-lg-8 py-5 px-5">
            <div class="row update">
                <div class="col-sm-6">
                    <h2><strong>Modifier une fiche</strong></h2>
                    <br>
                    <form class="form" action="<?php echo 'update.php?id='. $id; ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="form-group ">

                            <label for="commune">Commune:</label>

                            <select class="form-control" id="id_commune" name="id_commune">
                                <?php 
                                $db = Database::connect();
                                foreach($db->query('SELECT * FROM coordonnees') as $row)
                                {
                                    if($row['id'] == $commune)
                                        echo '<option selected="selected" value="'. $row['id'] . '" style="size:4; height:10px;overflow-y: scroll ">' . $row['commune_coord'] .'</option>';
                                    else
                                        echo '<option value="'. $row['id'] . '">' . $row['commune_coord'] .'</option>';
                                }
                                Database::disconnect();    
                                ?> 
                            </select>
                            <span class="help-inline"><?php echo $communeError; ?></span>
                        </div>

                        <div class="form-group ">
                            <label for="langue">Langue:</label>
                            <input type="text " class="form-control" id="langue" name="langue" placeholder="langue" value="<?php echo $langue; ?>">
                            <span class="help-inline"><?php echo $langueError; ?></span>
                        </div>

                        <div class="form-group ">
                            <label for="theme">Thème:</label>
                            <input type="text " class="form-control" id="theme" name="theme" placeholder="Thème" value="<?php echo $theme; ?>">
                            <span class="help-inline"><?php echo $themeError; ?></span>
                        </div>

                        <div class="form-group ">
                            <label for="prestation">Prestation:</label>
                            <input type="text " class="form-control" id="prestation" name="prestation" placeholder="Prestation" value="<?php echo $prestation; ?>">
                            <span class="help-inline"><?php echo $prestationError; ?></span>
                        </div>
                        
                        <div class="form-group ">
                            <label for="guide_pays">Pays:</label>
                            <select class="form-control" id="guide_pays" name="guide_pays">
                                <?php 
                                $db = Database::connect();
                                foreach($db->query('SELECT * FROM pays') as $row)
                                {
                                    if($row['id'] == $pays)
                                        echo '<option selected="selected" value="'. $row['id'] . '">' . $row['nom_pays'] .'</option>';
                                    else
                                        echo '<option value="'. $row['id'] . '">' . $row['nom_pays'] .'</option>';
                                }
                                Database::disconnect();    
                                ?>                
                            </select>
                            <span class="help-inline"><?php echo $paysError; ?></span>
                        </div>

                        <div class="form-group border border-secondary rounded p-3">
                            <label>Image:</label>
                            <p><?php echo $image; ?></p>
                            <label for="image">Sélectionner une image: </label>
                            <input type="file" id="image" name="image">
                            <span class="help-inline"><?php echo $imageError; ?></span>
                        </div>
                        <br>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><i class="fas fa-pencil-alt"></i></i> Modifier</button>
                            <a class="btn btn-primary " href="index.php "><i class="fas fa-arrow-left"></i> Retour</a>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 mx-auto site">
                    <div class="card-deck">
                        <div class="card update">
                            <img class="card-img-top" src="<?php echo '../img/guides/' . $item['photo'] ; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $guide_last . ' ' . $guide_first; ?></h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                            <div class="card-body">
                                <a href="# " class="btn btn-order bg-secondary" role="btn "><i class="far fa-handshake"></i> Réserver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
