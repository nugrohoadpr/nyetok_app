<?php


require_once __DIR__ . "/vendor/autoload.php";

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->selectDatabase('stock');
$instock = (new MongoDB\Client)->stock->barang_masuk;
$outstock = (new MongoDB\Client)->stock->barang_keluar;
$stock = (new MongoDB\Client)->stock->stock;
$user = (new MongoDB\Client)->stock->user;

?>