<?php

session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title> Guider </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!--intégration du Bootstrap CSS par CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Vast+Shadow" rel="stylesheet"> 
    <link href="css/user_index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">        
</head>
<body>
    <?php include('./includes/nav.php'); ?>
        
    <div class="container admin">
        <div class="row col-sm-12 col-md-12" id="fiche_user">
           <div class="col-sm-6 col-md-6 col-lg-6 pl-5" id="compte">
                <h2 class="text-center" id="h2">Votre compte</h2>
                <h4 class="mt-4 text-center" id="h4"><strong>Bienvenue <?php  echo ' ' . $_SESSION['user']['FIRST']; ?>!</strong></h4>
                <br>
                <form>
                   	<div class="form-group">
                    	<label>Nom:  </label><?php  echo ' ' . $_SESSION['user']['LAST']; ?>
                   	</div>

                	<div class="form-group">
                    	<label>Prénom:  </label><?php  echo ' ' . $_SESSION['user']['FIRST']; ?></div>

                 	<div class="form-group">
                     	<label>Téléphone:  </label><?php echo ' ' . $_SESSION['user']['PHONE']; ?></div>

                 	<div class="form-group">
                     	<label>Email:  </label><?php echo ' ' . $_SESSION['user']['MAIL']; ?></div>

                </form>
                <br>
                <div class="form-actions">
                    <a class="btn btn-primary" href="account-update.php" id="update_user"><i class="fas fa-pencil-alt"></i> Modifier les données personnelles</a>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 " id="resa">
                <div class="card-deck">
                    <div class="card pl-2 pr-2">
                        <div class="card-body">
                            <h4 class="card-title">Vos 3 dernières réservations</h4>
                            
                        </div>
                        <div id="accordion" class="bg-primary text-light mb-2 text-center">
                        <?php

                                require 'class/Database.php';
                                

                                $users_last = $_SESSION['user']['LAST'];


                                $db = Database::connect();

                                $statement = $db->prepare('SELECT * FROM events WHERE users_last=? ORDER BY date DESC LIMIT 3');
                                $statement->execute(array($users_last));


                            while($item = $statement->fetch()){
                                    echo '
                                            <h3>Réservation du ' . date ( 'd/m/Y' , strtotime($item['date'])). '</h3>
                                            <div> 
                                                <ul class="list-group list-group-flush">';
                                                    echo '<li class="list-group-item"><strong>Guide réservé: </strong>' . $item['guide_first'] . ' ' . $item['guide_last'] . '</li>';
                                                    echo '<li class="list-group-item">Jour de la visite: ' . date ( 'd/m/Y' , strtotime($item['date'])) . '</li>';
                                                    echo '<li class="list-group-item">Heure de la visite: ' . $item['start'] . 'H</li>
                                                </ul>
                                            </div> 
                                      ';                             
                            }
                            
                                Database::disconnect();
                        ?>

                        </div>                                
                        <div class="card-body text-center" id="cancelButton">
                            <a href="# " class="btn btn-order bg-secondary text-light" role="btn "><i class="fas fa-trash-alt"></i> Annuler la dernière réservation</a>
                        </div>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    
    <script>
        //Displays collapsible content panels for reservations already done
    $( function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  } );
  </script>  

</body>

</html>
