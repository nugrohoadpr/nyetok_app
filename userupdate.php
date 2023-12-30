<?php
   session_start();

   require 'config.php';
   $title = "edit user";

   if (isset($_GET['id'])) {
      $usermasuk = $user->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
      $hasilarray = iterator_to_array($usermasuk);
   }

   if(isset($_POST['submit'])){

      $user->updateOne(
          ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
          ['$set' => ['usernama' => strtoupper($_POST['usernama']),
                        'alamat' => strtoupper($_POST['alamat']),
                        'jabatan' => ($_POST['jabatan']),
                        'kode' => intval($_POST['kode']),
                     ],
         ]
      );

      header("Location: userindex.php");
   }

   include 'template/header.php';

?>

   <div class="container">
      <h1>EDIT USER</h1>
      <a href="userindex.php" class="btn btn-primary">Back</a>


      <form method="POST">
         <div class="form-group">
            <strong>Nama:</strong>
            <input type="text" name="nama" value="<?php echo $hasilarray['usernama']; ?>" required="" class="form-control" placeholder="Nama">
         </div>
         <div class="form-group">
            <strong>Alamat:</strong>
            <input type="text" name="alamat" value="<?php echo $hasilarray['alamat']; ?>" required="" class="form-control" placeholder="Alamat">
         </div>
         <div class="form-group">
            <strong>Jabatan:</strong>
            <input type="text" name="jabatan" value="<?php echo $hasilarray['jabatan']; ?>" required="" class="form-control" placeholder="Jabatan">
         </div>
         <div class="form-group">
            <strong>No ID Jabatan:</strong>
            <input type="text" name="kode" value="<?php echo $hasilarray['kode']; ?>" required="" class="form-control" placeholder="No ID Jabatan">
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