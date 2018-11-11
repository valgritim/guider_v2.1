<?php

   
include ('header_admin.php');

    $guide_firstError = $guide_lastError = $communeError = $langueError = $themeError = $prestationError = $paysError = $imageError = "";
    $guide_first = $guide_last = $commune = $langue = $theme = $prestation = $pays = $image = "";


if(!empty($_POST))
{
    $guide_first = checkInput($_POST['prenom']);
    $guide_last = checkInput($_POST['nom']);
    $commune = checkInput($_POST['id_commune']);
    $langue = checkInput($_POST['langue']);
    $theme = checkInput($_POST['theme']);
    $prestation = checkInput($_POST['prestation']);
    $pays = checkInput($_POST['guide_pays']);
    $image = checkInput($_FILES['image']['name']);
    $imagePath = '../img/guides/' . basename($image);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess = true;
    
    if(empty($guide_first))
    {
        $guide_firstError = "Ce champ ne peut pas être vide";
        $isSuccess = false;
    }
    if(empty($guide_last))
    {
        $guide_lastError = "Ce champ ne peut pas être vide";
        $isSuccess = false;
    }
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
        $imageError = "Vous devez joindre une photo!";
        $isImageUpdated = false;
        
        
    }
    else {
        $isUploadSuccess = true;
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
        if($_FILES["image"]["size"] > 5000000)
        {
            $imageError = "le fichier ne doit pas dépasser les 5MO";
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
    if($isSuccess && $isUploadSuccess)
    {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO guides (guide_first,guide_last,guide_pays,id_commune,langue,theme,prestation,photo) values (?,?,?,?,?,?,?,?);");
        $statement->execute(array($guide_first,$guide_last,$pays,$commune,$langue,$theme,$prestation,$image));

        
        // echo "<pre>";
        // $statement->debugDumpParams();
        // echo "</pre>";
        
        header("Location: index.php");
    }
    
}
function checkInput($data){
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    
}

?> 

<body>
    <h1 class="text-logo text-center" style="color: #fff;"><i class="fas fa-id-badge"></i> Guider </h1>

    <div class="container insert mb-5 pb-5 pt-2">
        <div class="row">

            <h1 class="text-center pt-3"><strong>Ajouter un guide</strong></h1>
            <br/>
            <form class="form pt-2" action="insert.php " method="post" role="form" enctype="multipart/form-data">
                <div class="form-group ">
                    <br/>
                    <label class="insert" for="nom">Nom:</label>
                    <input type="text " class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php echo $guide_last; ?>">
                    <span class="help-inline"><?php echo $guide_lastError; ?></span>
                </div>

                <div class="form-group ">
                    <label class="insert" for="prenom">Prénom:</label>
                    <input type="text " class="form-control" id="prenom" name="prenom" placeholder="Prénom" value="<?php echo $guide_first; ?>">
                    <span class="help-inline"><?php echo $guide_firstError; ?></span>

                </div>

                <div class="form-group ">
                    <label class="insert" for="commune">Commune:</label>
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
                    <label class="insert" for="langue">Langues parlées:</label>
                    <input type="text " class="form-control" id="langue" name="langue" placeholder="Langues" value="<?php echo $langue; ?>">
                    <span class="help-inline"><?php echo $langueError; ?></span>
                </div>

                <div class="form-group ">
                    <label class="insert" for="theme">Thème:</label>
                    <select class="form-control" id="theme" name="theme">
                        <option value="theme">Visite</option>
                        <option value="promenade">Promenade</option>
                        <option value="dégustation">Dégustation</option>
                    </select>
                </div>

                <div class="form-group ">
                    <label class="insert" for="prestation">Description de la prestation:</label>
                    <textarea class="form-control" rows="5" id="prestation" name="prestation" placeholder="Prestation" value="<?php echo $prestation; ?>">
                    </textarea>
                    <span class="help-inline"><?php echo $prestationError; ?></span>
                </div>

                <div class="form-group ">
                    <label class="insert" for="guide_pays">Secteur:</label>
                    <select class="form-control" id="guide_pays" name="guide_pays">
                        <?php 
                                
                            foreach($db->query('SELECT * FROM pays') as $row)
                            {
                                echo '<option value="'. $row['id'] . '">' . $row['nom_pays'] .'</option>';
                            }
                            Database::disconnect();    
                        ?>            
                    </select>
                    <span class="help-inline"><?php echo $paysError; ?></span>
                </div>

                <div class="form-group">
                    <label class="insert" for="image">Sélectionner une image: </label>
                    <input type="file" id="image" name="image" class="text-light">
                    <span class="help-inline"><?php echo $imageError; ?></span>

                </div>
                <br>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success mr-2"><i class="fas fa-pencil-alt"></i>Ajouter</button>
                    <a class="btn btn-primary " href="index.php "><i class="fas fa-arrow-left"></i> Retour</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
