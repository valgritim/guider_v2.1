<?php
session_start();
// Insert a new line in log file
$file = '/logs/connections.txt';
$newLine = "\nDeconnexion : ".$_SESSION['user']['CONNECT']." - ".$_SESSION['user']['ID']." ".$_SESSION['user']['MAIL']." Statut : Leaving";
file_put_contents($file, $newLine, FILE_APPEND | LOCK_EX);
// Destroy section
session_destroy();
//Redirect to index.php
header('Location: index.php');

