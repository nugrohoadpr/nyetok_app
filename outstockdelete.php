<?php


	session_start();
	require 'config.php';

	if (isset($_GET['id'])) {
	   $barang_keluar = $outstock->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
	   $hasilarray = iterator_to_array($barang_keluar);
	}

	$updateCriteria = ["nama" => $hasilarray['nama']]; // Modify this according to your needs

    $cursor = $stock->find($updateCriteria);
    $stockarray = iterator_to_array($cursor);

   
        foreach ($stockarray as $document) {
            //var_dump($document);
            $updateValues = [
            '$set' => [
                'ukuran41' => (isset($document['ukuran41']) ? $document['ukuran41'] : 0) + $hasilarray['ukuran41'],
                'ukuran42' => (isset($document['ukuran42']) ? $document['ukuran42'] : 0) + $hasilarray['ukuran42'],
                'ukuran43' => (isset($document['ukuran43']) ? $document['ukuran43'] : 0) + $hasilarray['ukuran43'],
                'ukuran44' => (isset($document['ukuran44']) ? $document['ukuran44'] : 0) + $hasilarray['ukuran44'],
                ],
            ];
        } 
    // Options for the update (upsert set to true)
    $updateOptions = [
        'upsert' => true,
    ];

    // Execute the combined insert/update operation
    $updateResult = $stock->updateOne($updateCriteria, $updateValues, $updateOptions);

	$outstock->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

	header("Location: outstockindex.php");


?>