<?php

include ('header_admin.php');

// SECURITE: On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['user'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: ../index.php');
  exit();
}
?>

<body id="index">
    <div class="container thumbnail col-md-1" style="position:absolute; right:20px; margin-top: 20px;">
        <h6 style="text-align:center; font-size: 1em; font-weight: bold;">Administrateur</h6>
        <a href="../disconnect.php" style="font-weight: bold;"> Déconnexion  <i class="fas fa-sign-out-alt"></i></a>            
    </div>
    <h1 class="text-logo text-center mb-5"><i class="fas fa-id-badge"></i> Guider </h1>
    <div id="tabs">

        <ul>
            <li><a href="#tabs-1">Guides</a></li>
            <li><a href="#tabs-2">Utilisateurs</a></li>
        </ul>

        <div class="container admin bg-success" id="tabs-1">
            <div class="row index">
                <h1><strong>Liste des guides  </strong><a href="insert.php" class="btn btn-success btn-lg"><i class="fas fa-plus"></i> Ajouter</a></h1>

                <table id="table_id1" class="table table-striped table-bordered bg-dark">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Village</th>
                            <th>Thème</th>
                            <th>Pays</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $statement = $db->query('SELECT guides.id,guides.guide_first,guides.guide_last,guides.id_commune,guides.theme,pays.nom_pays AS pays, coordonnees.commune_coord AS commune FROM guides, coordonnees, pays WHERE  guides.id_commune = coordonnees.id AND guides.guide_pays = pays.id ORDER BY guides.id ASC ');

                        
                        while($item = $statement->fetch())
                        {
                            echo '<tr>';
                            echo '<td>' . $item['guide_first']. '</td>';
                            echo '<td>' . $item['guide_last']. '</td>';
                            echo '<td>' . $item['commune']. '</td>';
                            echo '<td>' . $item['theme']. '</td>';
                            echo '<td>' . $item['pays']. '</td>';
                            echo '<td width=320>';
                            echo '<a class="btn btn-default" href="view.php?id=' .$item['id'] . '"><i class="far fa-eye"></i> Voir</a>';
                            echo ' ';
                            echo '<a class="btn btn-primary" href="update.php?id=' . $item['id'] . '"><i class="fas fa-pencil-alt"></i> Modifier</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id=' . $item['id'] . '"><i class="fas fa-trash-alt"> Supprimer</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        

                        ?>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Partie User -->

        <div class="container admin bg-success" id="tabs-2">
            <div class="row index">
                <h1><strong>Liste des utilisateurs  </strong></h1>

                <table id="table_id2" class="table table-striped table-bordered bg-dark">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Droits</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                       <?php User::listUser($db); ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div> <!-- fermeture du tabs -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready( function () {
            $('#tabs').tabs();
            $('#table_id1,#table_id2').DataTable();
        } );

    </script>
</body>
</html>
