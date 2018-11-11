<?php

session_start();

require '../../class/Database.php';



$id = $_SESSION['guide'];

$data = array();

// prepare and execute statement query on guide events
$db = Database::connect();
$statement = $db->prepare('SELECT * FROM events WHERE id_guide = ?');
$statement->execute(array($id));
$result = $statement->fetchAll();


foreach($result as $row)
{
// datas that will be implemented into calendar
	$data[] = array(

		'id' => $row['id'],
		'title' => $row['guide_last'] . ' ' . $row['start'],
		'start' => $row['date']

		
	);
}
   //   echo "<pre>";
 		// $statement->debugDumpParams();
 		// echo "</pre>";


// // conversion data into string to be displayed into event calendar
// }
echo json_encode($data);
// function cleaning datas



