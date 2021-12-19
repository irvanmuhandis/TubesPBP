<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="style2.css">
  <!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  <title>Mini Project</title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:rgb(0, 0, 0);">
    <a class="navbar-brand mb-0 h1">Perpustakaan | Petugas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index2.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="form_pinjam.php">Peminjaman</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="form_balik.php">Pengembalian</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="listpinjam.php">Buku Dipinjam</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="riwayatpinjam.php">Riwayat Pinjam</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="belum_kembali.php">Belum Mengembalikan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add_anggota.php">Tambah Anggota</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li><a class="navbar-brand mb-0">
            <?php
            session_start();
            echo $_SESSION['username'];
            ?>
          </a></li>
        <li style="padding-top: 5px;"><a class="btn btn-danger btn-sm" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>
</body>
<div class="container">