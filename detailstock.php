<?php
   	session_start();
   	require 'config.php';
	$title = "detail stock";

	if (isset($_GET['id'])) {
	   $stock = $stock->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
	   $detailstock = iterator_to_array($stock);
	}

	// Specify the names of the two collections
	$collection1Name = "barang_masuk";
	$collection2Name = "barang_keluar";
	$aggregatePipeline = [
	    [
	        '$unionWith' => $collection2Name,
	    ],
	    [
        	'$match' => [
        		'nama' => $detailstock['nama'],
        	],
	    ],
	    [
	        '$sort' => ['tanggal' => -1], // Sort by 'tanggal' in descending order (latest first)
	    ],
	    // Add more pipeline stages as needed
	];

	$cursor = $database->$collection1Name->aggregate($aggregatePipeline);

   include 'template/header.php';
?>

	<div class="container">
		<h1>DETAIL STOCK</h1>
		<table class="table">
	        <tbody>
	            <tr>
	                <td>Nama	:</td>
	                <td><?php 
					      echo "<p>".$detailstock['nama']."<p>"; 
					   ?>
					</td>
	            </tr>
	            <tr>
	                <td>Tahun	:</td>
	                <td><?php 
					      echo "<p>".$detailstock['tahun']."<p>"; 
					   ?>
					</td>
	            </tr>
	            <tr>
	                <td>Ukuran	:</td>
	                <td><?php 
					      echo "<p>ukuran 41 : ".$detailstock['ukuran41']."<p>"; 
					      echo "<p>ukuran 42 : ".$detailstock['ukuran42']."<p>";
					      echo "<p>ukuran 43 : ".$detailstock['ukuran43']."<p>";
					      echo "<p>ukuran 44 : ".$detailstock['ukuran44']."<p>";
					   ?>
					</td>
	            </tr>
	            <!-- Add more rows as needed -->
	        </tbody>
	    </table>
	    <a href="index.php" class="btn btn-danger">Back</a>

	    <br>
	    <h2>RIWAYAT PERUBAHAN DATA</h2>
	    <table class="table table-borderd">
		   <tr>
		      <th>Name</th>
		      <th>Status</th>
		      <th>Ukuran</th>
		   </tr>
		    <?php
		      foreach($cursor as $riwayat) {
		         echo "<tr>";
		         echo "<td>".$riwayat->tanggal."</td>";
		         echo "<td>".$riwayat->jenis."</td>";
		         echo "<td>
		                     <p>41 : ".$riwayat->ukuran41."</p>
		                     <p>42 : ".$riwayat->ukuran42."</p>
		                     <p>43 : ".$riwayat->ukuran43."</p>
		                     <p>44 : ".$riwayat->ukuran44."</p>
		               </td>";
		         echo "</tr>";
		      };
		   ?>
	   </table>
	</div>


</div>
</div>
</body>
</html>