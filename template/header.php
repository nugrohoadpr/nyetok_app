<!DOCTYPE html>
<html>
<head>
   <title><?php 
            echo $title; 
        ?> 
   </title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
   <link rel="stylesheet" href="template/style.css">
</head>
<body>
<div id="viewport">
  <!-- Sidebar -->
  <div id="sidebar">
    <header>
      <a href="index.php">NYETOK APP</a>
    </header>
    <ul class="nav">
      <li>
        <a href="index.php">
          <i class="zmdi zmdi-view-dashboard"></i> STOCK
        </a>
      </li>
      <li>
        <a href="instockindex.php">
          <i class="zmdi zmdi-link"></i> BARANG MASUK
        </a>
      </li>
      <li>
        <a href="outstockindex.php">
          <i class="zmdi zmdi-widgets"></i> BARANG KELUAR
        </a>
      </li>
      <li>
        <a href="userindex.php">
          <i class="zmdi zmdi-calendar"></i> USER
        </a>
      </li>
    </ul>
  </div>
  <!-- Content -->
  <div id="content">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#"><i class="zmdi zmdi-notifications text-danger"></i>
            </a>
          </li>
          <li><a href="userindex.php">Test User</a></li>
        </ul>
      </div>
    </nav>
  </div>
</div>