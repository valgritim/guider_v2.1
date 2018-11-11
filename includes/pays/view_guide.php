<?php

session_start();

require '../../class/Database.php';
// get guide's id in order to select each data concerning this guide
if(!empty($_GET['id'])){
    
    $id = checkInput($_GET['id']);
}

$db = Database::connect();
$statement = $db->prepare('SELECT guides.id, guides.guide_first, guides.guide_last, coordonnees.commune_coord AS commune, guides.langue,guides.prestation,guides.theme, guides.photo,pays.nom_pays AS pays ,coordonnees.latitude, coordonnees.longitude FROM guides, coordonnees, pays WHERE guides.id = ?');

// prepare page guide with all elements concerning guide in order to fill the card, selection by id
$statement->execute(array($id));
$item = $statement->fetch();

$_SESSION['guide'] = $item['id'];
$_SESSION['name'] = $item['guide_last'];
$_SESSION['first_name'] = $item['guide_first'];

Database::disconnect();

function checkInput($data){
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title> Guider </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Vast+Shadow" rel="stylesheet">         
    <link rel="stylesheet" href="../../css/view_guide.css">
    <link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css">     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>        

</head>

<body>
    <h1 class="text-logo text-center text-light"><i class="fas fa-id-badge text-light"></i> Guider </h1>

    <div class="container mt-5 pb-5">
        <div class="row">
            <div id="identity" class="col-sm-8 col-md-6 col-lg-6 pl-5">
                <h1><strong>Réserver ce guide</strong></h1>
                <br>
                <form>
                    <img style="max-width: 15rem;"src="<?php echo '../../img/guides/' . $item['photo'] ; ?>" alt="Card image cap">
                    <div class="form-group">                            
                           <h4 class="card-title"><?php echo $item['guide_first'] . ' ' . $item['guide_last']; ?></h4>
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
                        <label>Description: </label><br>
                            <?php echo ' '. $item['prestation']; ?>
                    </div>                        
                </form>
                <br>
                <div class="form-actions">
                    <?php 
                        echo "<a id='bouton' class=\"btn btn-primary\" href=\"javascript:history.go(-1)\"><i class=\"fas fa-arrow-left\"></i> Retour guides</a>";
                    ?>
                </div>
            </div>
            <div class="col-sm-5" id="reserve">
                <div class="card-deck">
                    <div class="card" style="width: 12rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?php echo $item['guide_first'] . ' ' . $item['guide_last']; ?></h5>

                           <hr>
                        </div>
                        <form method="POST" action="addEvent.php" role="form">
                            <div class="form-group d-none">                                                     
                                <input class="d-none" id="guide_id" type="text" name="guide_id" class="form-control" value="<?php $_SESSION['guide']; ?>">
                                <input class="d-none" id="guide_last" type="text" name="guide_last" class="form-control" value="<?php $_SESSION['name']; ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="date">Choisir une date:</label>
                                <input id="date" type="date" name="date" class="form-control">
                                <hr>
                            </div>

                                <label id="horaire" class="form-label" for="heure">Choisir un horaire:</label>
                                <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="schedule" value="10:00">
                                <label class="form-check-label pr-3" for="am">10h à 12h</label>
                                            
                                <input class="form-check-input pl-3" type="radio" name="schedule" id="pm" value="14:00">
                                <label class="form-check-label" for="pm">14h à 16h</label>
                                                                                       
                            </div>
                            <hr> 
                            <div class="form-group">
                                <p>Nombre de personnes:</p>
                                <select class="custom-select" name="value">
                                    <option value="1">De 1 à 3 personnes = 20 €</option>
                                    <option value="2">De 4 à 6 personnes =  30 €</option>
                                    <option value="3">+ de 6 personnes = 40 €</option>
                                </select>
                            </div>
                            <hr>

                             <div class="card-body">
                                   <?php
                                        if(!empty($_SESSION['user']['ID'])){

                                            echo '<input id="reservation" class="btn btn-order bg-success w-100 p-2 text-light" type="submit" name="reserve" value="Réserver"> <h6>Passez au paiement et recevez un e-mail de confirmation</h6>';
                                            

                                        } else {

                                            echo '<p class="bg-danger text-center text-light"><i class="far fa-handshake"></i> Réserver</a> <h6>Pour réserver, veuillez vous connecter!</h6></p>';
                                                
                                        }

                                    ?>                           
                            </div>                            
                        </form>
                       <?php
                            if(isset($_SESSION["error"])){
                                $error = $_SESSION["error"];
                                echo '<div class="alert alert-danger">' . $error . '</div>';
                            }
                        ?> 
                    </div>
                </div>
            </div>
        </div>
        <h3 class="text-center"><i class="fas fa-calendar-alt"></i> Calendrier des disponibilités</h3>
        <hr>

        <div id="calendar"></div>
                
    </div>

    
    <script type="text/javascript">


        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getFullYear();

        $(document).ready(function(){
                       // plugin Fullcalendar activation: calendar loaded into browser
            $('#calendar').fullCalendar({
                
                
                allDay: false,
                minTime: '10:00:00',
                maxTime: '20:00:00',
            // option buttons activated into calendar:
                header:{
                        left: 'prev, next',
                        center: 'title',
                        prev: 'left-single-arrow',
                        next: 'right-single-arrow',
                        prevYear: 'left-double-arrow',
                        nextYear: 'right-double-arrow'

                        },
                events: 'load.php',

                        
                businessHours:{
                            // days of week. an array of zero-based day of week integers (0=Sunday)
                                dow: [ 0, 1, 2, 3, 4, 5, 6], // Monday - Thursday

                                start: '10:00', // 
                                end: '16:00',
                                },
                // display events into calendar:
                
                        
                
                eventColor: '#0066ff',
                eventTextColor: '#fff',
                timeFormat: 'H(:mm)' // uppercase H for 24-hour clock

                            
                    });

        });

    </script>
      
</body>
</html>


        