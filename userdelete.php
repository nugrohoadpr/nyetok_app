<?php


	session_start();
	require 'config.php';

	$user->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);


	header("Location: userindex.php");


?>