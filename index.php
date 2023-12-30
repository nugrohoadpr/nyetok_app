<?php
   session_start();
   $title = "index stock";
   include 'template/header.php';
?>

   <div class="container">
      <h1>STOCK GUDANG</h1>
      <table class="table table-borderd">
         <tr>
            <th>Name</th>
            <th>Tahun</th>
            <th>Ukuran</th>
            <th>Action</th>
         </tr>
         <?php
            require 'config.php';

            $readystock = $stock->find([]);

            foreach($readystock as $readystock) {
               echo "<tr>";
               echo "<td>".$readystock->nama."</td>";
               echo "<td>".$readystock->tahun."</td>";
               echo "<td>
                           <p>41 : ".$readystock->ukuran41."</p>
                           <p>42 : ".$readystock->ukuran42."</p>
                           <p>43 : ".$readystock->ukuran43."</p>
                           <p>44 : ".$readystock->ukuran44."</p>
                     </td>";
               echo "<td>";
               echo "<a href='detailstock.php?id=".$readystock->_id."' class='btn btn-primary'>Detail</a>";
               echo "<a href='deletestock.php?id=".$readystock->_id."' class='btn btn-danger'>Delete</a>";
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