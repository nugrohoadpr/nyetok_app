<?php


session_start();
require 'config.php';


$stock->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

header("Location: index.php");

?>