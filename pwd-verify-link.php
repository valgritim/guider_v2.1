<?php

session_start();

require 'class/Database.php';

//je recupere les données envoyées par le lien dans l'url par le GET: le user id, l'id et le token 
$userId = isset($_GET['u_id']) ? trim($_GET['u_id']) : '';
$token = isset($_GET['t']) ? trim($_GET['t']) : '';
$passwordRequestId = isset($_GET['id']) ? trim($_GET['id']) : '';

$db = database::connect();

$statement = $db->query("SELECT id, user_id, date_requested FROM password_reset_request WHERE user_id = '$userId' AND token = '$token' AND id = '$passwordRequestId';");
$result =  $statement->fetch();


if($result == 0){

	echo 'invalid request';
	exit;

} else {

	

	$usedToken = $db->prepare("UPDATE password_reset_request SET token = NULL, confirmed_at = NOW() WHERE id = ?;");
	$newResult = $usedToken->execute(array($passwordRequestId));

	$newStatement = $db->prepare("SELECT * FROM users WHERE users_id = ?;");
	$newResult = $newStatement->execute(array($userId));

	$newResult = $newStatement->fetch();

	$_SESSION['u_id'] = $newResult['users_id'];
	$_SESSION['u_first'] = $newResult['users_first'];
	$_SESSION['u_last'] = $newResult['users_last'];
	$_SESSION['u_phone'] = $newResult['users_phone'];
	$_SESSION['u_email'] = $newResult['users_email'];
	$_SESSION['u_pwd'] = $newResult['users_pwd'];


  header('Location:create_newPwd.php?linkNewPwd=success');
}
database::disconnect();

