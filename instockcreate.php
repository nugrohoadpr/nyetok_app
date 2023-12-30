<?php


session_start();
require 'config.php';
$title = "create instock";

if(isset($_POST['submit'])){

   

   //insert to collection instock
   $insertOneResult = $instock->insertOne([
       'nama' => strtoupper($_POST['nama']).'-'.strtoupper($_POST['warna']),
       'jenis' => 'IN',
       'tahun' => $_POST['tahun'],
       'ukuran41' => intval($_POST['ukuran41']),
       'ukuran42' => intval($_POST['ukuran42']),
       'ukuran43' => intval($_POST['ukuran43']),
       'ukuran44' => intval($_POST['ukuran44']),
       'kode' => intval($_POST['kode']),
       'statusmasuk' => $_POST['status'],
       'tanggal' => (new DateTime())->format('d-m-Y H:i:s')
   ]);

   //update to collection stock
   $updateCriteria = ["nama" => strtoupper($_POST['nama']).'-'.strtoupper($_POST['warna'])]; // Modify this according to your needs

    $cursor = $stock->find($updateCriteria);
    $hasilarray = iterator_to_array($cursor);

    if (!empty($hasilarray)) {
        foreach ($hasilarray as $document) {
            //var_dump($document);
            $updateValues = [
            '$set' => [
                'tahun' => $_POST['tahun'],
                'ukuran41' => isset($document['ukuran41']) ? $document['ukuran41'] + intval($_POST['ukuran41']) : intval($_POST['ukuran41']),
                'ukuran42' => isset($document['ukuran42']) ? $document['ukuran42'] + intval($_POST['ukuran42']) : intval($_POST['ukuran42']),
                'ukuran43' => isset($document['ukuran43']) ? $document['ukuran43'] + intval($_POST['ukuran43']) : intval($_POST['ukuran43']),
                'ukuran44' => isset($document['ukuran44']) ? $document['ukuran44'] + intval($_POST['ukuran44']) : intval($_POST['ukuran44']),
                ],
            ];
        }
    } else {
        $updateValues = [
        '$set' => [
            'tahun' => $_POST['tahun'],
            'ukuran41' => intval($_POST['ukuran41']),
            'ukuran42' => intval($_POST['ukuran42']),
            'ukuran43' => intval($_POST['ukuran43']),
            'ukuran44' => intval($_POST['ukuran44']),
            ],
        ];
    }

    // Options for the update (upsert set to true)
    $updateOptions = [
        'upsert' => true,
    ];

    // Execute the combined insert/update operation
    $updateResult = $stock->updateOne($updateCriteria, $updateValues, $updateOptions);

   header("Location: instockindex.php");
}

include 'template/header.php';

?>


  <div class="container">
     <h1>Create Barang Masuk</h1>
     <a href="instockindex.php" class="btn btn-primary">Back</a>

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
           <strong>Tahun:</strong>
           <textarea class="form-control" name="tahun" placeholder="tahun" placeholder="Tahun"></textarea>
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
           <strong>status barang:</strong>
           <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="status">
              <option value="new">NEW</option>
              <option value="retur">RETUR</option>
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