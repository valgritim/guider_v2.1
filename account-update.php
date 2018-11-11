<?php

session_start();
?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <title> Guider </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/user_index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body>    
 
<img src="./img/logo.png" id="mainLogo" height="120px" width="120px" alt="logo chat eglise"> 
<div class="container admin">
    <div class="row">
        <div class="col-sm-6 pl-5">
            <h1><strong>Votre compte</strong></h1>
            <br>
            
            <form id="modif" method="POST" role="form" action="./secure.php">

                <div class="form-group">

                    <label>Nom: <?= $_SESSION['user']['LAST'] ?> </label>               
                    <input type="text" class="form-control" id="last" name="users_last" placeholder="last" value="<?= $_SESSION['user']['LAST'] ?>">
                    
                </div>

                <div class="form-group">
                    <label>Prénom:  </label><?= $_SESSION['user']['FIRST']?></div>
                    <input type="text" class="form-control" id="first" name="users_first" placeholder="first" value="<?= $_SESSION['user']['FIRST']?>">
                   

                    <div class="form-group">
                        <label>Téléphone:  </label>
                        <input type="text" class="form-control" id="phone" name="users_phone" placeholder="phone" value="<?= $_SESSION['user']['PHONE']?>">
                       
                    </div>
                    <div class="form-group">
                        <label>Email:  </label>
                        <input type="text" class="form-control" id="email" name="users_email" placeholder="email" value="<?= $_SESSION['user']['MAIL']?>">
                        
                    </div>
                    <div class="form-actions">
                        <input id="btnModif" class="btn btn-success" type="submit" name="update" value="Valider la modification">
                        <a class="btn btn-primary" href="javascript:history.go(-1)"><i class="fas fa-arrow-left"></i> Retour compte</a>
                    </div>
                </form>
                <br>


            </div>
            <div id="card-resa" class="col-sm-5 site">
                <div class="card-deck">
                    <div class="card" style="width: 40rem;">
                        <div class="card-body">
                            <h1 id="card-title">Vos réservations</h1>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Secteur:</li>
                            <li class="list-group-item">Commune: </li>
                            <li class="list-group-item">Thème: </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>      
</body>

</html>