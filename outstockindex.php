<?php
   session_start();
   require 'config.php';
   $title = "index outstock";
   $collection1Name = "barang_keluar"; 
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
    <h1>BARANG KELUAR</h1>


    <a href="outstockcreate.php" class="btn btn-success">Add Outstock</a>

    <br></br>
    <table class="table table-borderd">
       <tr>
          <th>Tanggal</th>
          <th>Name</th>
          <th>Status Keluar</th>
          <th>User</th>
          <th>Jabatan</th>
          <th>Action</th>
       </tr>
       <?php
          foreach($cursor as $data) {
             echo "<tr>";
             echo "<td>".$data->tanggal."</td>";
             echo "<td>".$data->nama."</td>";
             echo "<td>".$data->statuskeluar."</td>";
             echo "<td>".$data->datadetails->usernama."</td>";
             echo "<td>".$data->datadetails->jabatan."</td>";
             echo "<td>";
             echo "<a href='outstockedit.php?id=".$data->_id."' class='btn btn-primary'>Edit</a>";
             echo "<a href='outstockdelete.php?id=".$data->_id."' class='btn btn-danger'>Delete</a>";
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