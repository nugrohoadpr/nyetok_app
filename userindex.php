<?php
   session_start();
   require 'config.php';
   $title = "index user";
   include 'template/header.php';
?>
   <div class="container">
      <h1>USER</h1>
      <a href="usercreate.php" class="btn btn-success">Add User</a>
      <br></br>
      <table class="table table-borderd">
         <tr>
            <th>Name</th>
            <th>Alamat</th>
            <th>Jabatan</th>
            <th>Action</th>
         </tr>
         <?php
            $showuser = $user->find([]);
            foreach($showuser as $showuser) {
               echo "<tr>";
               echo "<td>".$showuser->usernama."</td>";
               echo "<td>".$showuser->alamat."</td>";
               echo "<td>".$showuser->jabatan."</td>";
               echo "<td>";
               echo "<a href='userupdate.php?id=".$showuser->_id."' class='btn btn-primary'>Edit</a>";
               echo "<a href='userdelete.php?id=".$showuser->_id."' class='btn btn-danger'>Delete</a>";
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