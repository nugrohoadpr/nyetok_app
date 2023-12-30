<?php


session_start();


   require 'config.php';
   $title = "create user";
   if(isset($_POST['submit'])){
      //insert to collection instock
      $insertOneResult = $user->insertOne([
          'usernama' => strtoupper($_POST['usernama']),
          'alamat' => strtoupper($_POST['alamat']),
          'jabatan' => $_POST['jabatan'],
          'kode' => intval($_POST['kode']),
      ]);

      //update to collection stock

      header("Location: userindex.php");
   }
   include 'template/header.php';
?>

  <div class="container">
     <h1>Create User</h1>
     <a href="userindex.php" class="btn btn-primary">Back</a>

     <form method="POST">
        <div class="form-group">
           <strong>Name:</strong>
           <input type="text" name="usernama" required="" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
           <strong>Alamat:</strong>
           <input type="text" name="alamat" required="" class="form-control" placeholder="Alamat">
        </div>
        <div class="form-group">
           <strong>Jabatan:</strong>
           <input type="text" name="jabatan" required="" class="form-control" placeholder="Jabatan">
        </div>
        <div class="form-group">
           <strong>No ID Karyawan:</strong>
           <input type="text" name="kode" required="" class="form-control" placeholder="No ID Karyawan">
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