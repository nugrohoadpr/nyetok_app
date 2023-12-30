<?php


session_start();
require 'config.php';
$title = "create outstock";

if(isset($_POST['submit'])){

    //$tanggal => new MongoDB\BSON\UTCDateTime(new DateTime());
    $insertOneResult = $outstock->insertOne([
          'nama' => strtoupper($_POST['nama']).'-'.strtoupper($_POST['warna']),
          'jenis' => 'OUT',
          'ukuran41' => intval($_POST['ukuran41']),
          'ukuran42' => intval($_POST['ukuran42']),
          'ukuran43' => intval($_POST['ukuran43']),
          'ukuran44' => intval($_POST['ukuran44']),
          'statuskeluar' => $_POST['statuskeluar'],
          'kode' => intval($_POST['kode']),
          'tanggal' => (new DateTime())->format('d-m-Y H:i:s')
        ]);

    $updateCriteria = ["nama" => strtoupper($_POST['nama']).'-'.strtoupper($_POST['warna'])]; // Modify this according to your needs

    $cursor = $stock->find($updateCriteria);
    $hasilarray = iterator_to_array($cursor);

    if (!empty($hasilarray)) {
            foreach ($hasilarray as $document) {
            //var_dump($document);
            $updateValues = [
            '$set' => [
                'ukuran41' => isset($document['ukuran41']) ? $document['ukuran41'] - intval($_POST['ukuran41']) : intval($_POST['ukuran41']),
                'ukuran42' => isset($document['ukuran42']) ? $document['ukuran42'] - intval($_POST['ukuran42']) : intval($_POST['ukuran42']),
                'ukuran43' => isset($document['ukuran43']) ? $document['ukuran43'] - intval($_POST['ukuran43']) : intval($_POST['ukuran43']),
                'ukuran44' => isset($document['ukuran44']) ? $document['ukuran44'] - intval($_POST['ukuran44']) : intval($_POST['ukuran44']),
                ],
            ];

          $updateOptions = [
            'upsert' => true,
          ];

          // Execute the combined insert/update operation
          $updateResult = $stock->updateOne($updateCriteria, $updateValues, $updateOptions);
        }
        
    } else {
        echo'alert("STOCK TIDAK ADA!!!");';
    }

    // Options for the update (upsert set to true)

   header("Location: outstockindex.php");
}

include 'template/header.php';
?>
  <div class="container">
     <h1>Create Barang Keluar</h1>
     <a href="outstockindex.php" class="btn btn-primary">Back</a>


     <form method="POST">
        <div class="form-group">
           <strong>Name:</strong>
           <input type="text" name="nama" required="" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
           <strong>Warna:</strong>
           <input type="text" name="warna" required="" class="form-control" placeholder="Warna">
        </div>
        <div class="form-group">
           <strong>Ukuran 41:</strong>
           <textarea class="form-control" name="ukuran41" placeholder="ukuran41" placeholder="Ukuran 41"></textarea>
        </div>
        <div class="form-group">
           <strong>Ukuran 42:</strong>
           <textarea class="form-control" name="ukuran42" placeholder="ukuran42" placeholder="Ukuran 42"></textarea>
        </div>
        <div class="form-group">
           <strong>Ukuran 43:</strong>
           <textarea class="form-control" name="ukuran43" placeholder="ukuran43" placeholder="Ukuran 43"></textarea>
        </div>
        <div class="form-group">
           <strong>Ukuran 44:</strong>
           <textarea class="form-control" name="ukuran44" placeholder="ukuran44" placeholder="Ukuran 44"></textarea>
        </div>
        <div class="form-group">
           <strong>status keluar barang:</strong>
           <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="statuskeluar">
              <option value="offline">Offline</option>
              <option value="lazada">Lazada</option>
              <option value="shopee">Shopee</option>
           </select>
        </div>
        <div class="form-group">
           <strong>Penanggung Jawab:</strong>
           <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="kode">
              <?php
              $kodeuser = $user->find([]);
              foreach($kodeuser as $kodeuser) {
                      echo "<option value=".$kodeuser->kode.">".$kodeuser->usernama."</option>";
                      };
             ?>
           </select>
        </div>
        <div class="form-group">
           <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </div>
     </form>
  </div>


</div>
</div>
</body>
</html>