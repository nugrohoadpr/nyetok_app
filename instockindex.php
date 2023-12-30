<?php
   session_start();
   require 'config.php';
   $title = "index instock";

   $collection1Name = "barang_masuk"; 
   $cursor = $database->$collection1Name->aggregate([
       [
           '$lookup' => [
               'from' => 'user',
               'localField' => 'kode',
               'foreignField' => 'kode',
               'as' => 'datadetails',
           ],
       ],
       [
           '$unwind' => '$datadetails',
       ],
   ]);
   include 'template/header.php';
?>

<div class="container">
   <h1>BARANG MASUK</h1>
   <a href="instockcreate.php" class="btn btn-success">Add Instock</a><br>
 </br>
   <table class="table table-borderd">
      <tr>
         <th>Tanggal</th>
         <th>Nama</th>
         <th>Tahun</th>
         <th>Status</th>
         <th>User</th>
         <th>Jabatan</th>
         <th>Action</th>
      </tr>
      <?php
         foreach($cursor as $data) {
            echo "<tr>";
            echo "<td>".$data->tanggal."</td>";
            echo "<td>".$data->nama."</td>";
            echo "<td>".$data->tahun."</td>";
            echo "<td>".$data->statusmasuk."</td>";
            echo "<td>".$data->datadetails->usernama."</td>";
            echo "<td>".$data->datadetails->jabatan."</td>";
            echo "<td>";
            echo "<a href='instockedit.php?id=".$data->_id."' class='btn btn-primary'>Edit</a>";
            echo "<a href='instockdelete.php?id=".$data->_id."' class='btn btn-danger'>Delete</a>";
            echo "</td>";
            echo "</tr>";
         };
      ?>
   </table>
</div>


</div>
</div>
</body>
</html>