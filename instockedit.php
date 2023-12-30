<?php


  session_start();
  require 'config.php';
  $title = "edit instock";


  if (isset($_GET['id'])) {
     $barang_masuk = $instock->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
     $hasilarray = iterator_to_array($barang_masuk);
  }

  if(isset($_POST['submit'])){
     $instock->updateOne(
         ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
         ['$set' => ['tahun' => $_POST['tahun'],
                       'ukuran41' => intval($_POST['ukuran41']),
                       'ukuran42' => intval($_POST['ukuran42']),
                       'ukuran43' => intval($_POST['ukuran43']),
                       'ukuran44' => intval($_POST['ukuran44']),
                       'kode' => intval($_POST['kode']),
                       'tanggal' => (new DateTime())->format('d-m-Y H:i:s')
                    ]
        ]
     );

     $updateCriteria = ["nama" => $hasilarray['nama']]; // Modify this according to your needs

      $cursor = $stock->find($updateCriteria);
      $stockarray = iterator_to_array($cursor);

     
          foreach ($stockarray as $document) {
              //var_dump($document);
              $updateValues = [
              '$set' => [
                  'tahun' => $_POST['tahun'],
                  'ukuran41' => (isset($document['ukuran41']) ? $document['ukuran41'] : 0) - $hasilarray['ukuran41'] + intval($_POST['ukuran41']),
                  'ukuran42' => (isset($document['ukuran42']) ? $document['ukuran42'] : 0) - $hasilarray['ukuran42'] + intval($_POST['ukuran42']),
                  'ukuran43' => (isset($document['ukuran43']) ? $document['ukuran43'] : 0) - $hasilarray['ukuran43'] + intval($_POST['ukuran43']),
                  'ukuran44' => (isset($document['ukuran44']) ? $document['ukuran44'] : 0) - $hasilarray['ukuran44'] + intval($_POST['ukuran44']),
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
     <?php 
        echo "<h1>".$hasilarray['nama']."</h1>"; 
     ?>
     <a href="instockindex.php" class="btn btn-primary">Back</a>


     <form method="POST">
        <div class="form-group">
           <strong>Tahun:</strong>
           <input type="text" name="tahun" value="<?php echo $hasilarray['tahun']; ?>" required="" class="form-control" placeholder="Tahun">
        </div>
        <div class="form-group">
           <strong>Ukuran 41:</strong>
           <input type="text" name="ukuran41" value="<?php echo $hasilarray['ukuran41']; ?>" required="" class="form-control" placeholder="Ukuran 41">
        </div>
        <div class="form-group">
           <strong>Ukuran 42:</strong>
           <input type="text" name="ukuran42" value="<?php echo $hasilarray['ukuran42']; ?>" required="" class="form-control" placeholder="Ukuran 42">
        </div>
        <div class="form-group">
           <strong>Ukuran 43:</strong>
           <input type="text" name="ukuran43" value="<?php echo $hasilarray['ukuran43']; ?>" required="" class="form-control" placeholder="Ukuran 43">
        </div>
        <div class="form-group">
           <strong>Ukuran 44:</strong>
           <input type="text" name="ukuran44" value="<?php echo $hasilarray['ukuran44']; ?>" required="" class="form-control" placeholder="Ukuran 44">
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