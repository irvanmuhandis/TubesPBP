<?php include('header.php'); ?>
<br>
<div class="card">
  <div class="card-header h6">Daftar Buku yang Sedang Dipinjam</div>
  <div class="card-body">
    <table class="table table-striped">
      <tr>
        <th>ID Transaksi</th>
        <th>Cover Buku</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Batas Pengembalian</th>
        <th>Denda</th>
      </tr>
      <?php
      require_once('db_login.php');
      $query = "SELECT dt.idtransaksi, buku.file_gambar, buku.judul, peminjaman.tgl_pinjam,
                date_add(tgl_pinjam,INTERVAL 14 day) AS bataswaktu, dt.denda
                FROM anggota
                JOIN peminjaman ON anggota.nim=peminjaman.nim
                JOIN detail_transaksi AS dt ON peminjaman.idtransaksi=dt.idtransaksi
                JOIN buku ON dt.idbuku=buku.idbuku
                WHERE nama='".$_SESSION['username']."' AND ISNULL(dt.tgl_kembali)";
      $result = $db->query($query);
      if (!$result) {
        die("Could not query the database: <br />" . $db->error . "<br />Query: " . $query);
      }
      // Fetch and display the results
      while ($row = $result->fetch_object()) {
        echo '<tr>';
        echo '<td>' . $row->idtransaksi . '</td>';
        $image = $row->file_gambar;
        echo '<td>' . '<img src="./images/' . $image . '" width="100">' . '</td>';
        echo '<td>' . $row->judul . '</td>';
        echo '<td>' . $row->tgl_pinjam . '</td>';
        echo '<td>' . $row->bataswaktu . '</td>';
        echo '<td>' . $row->denda . '</td>';
        echo '</tr>';
      }
      echo '</table>';
      $result->free();
      ?>
    </table>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header h6">Riwayat Peminjaman</div>
  <div class="card-body">
    <table class="table table-striped">
      <tr>
        <th>ID Transaksi</th>
        <th>Tanggal Pinjam</th>
        <th>Cover Buku</th>
        <th>Judul Buku</th>
        <th>Batas Pengembalian</th>
        <th>Tanggal Kembali</th>
        <th>Denda</th>
        <th>Total Denda/ Transaksi</th>
      </tr>
      <?php
      require_once('db_login.php');
      $query = "SELECT dt.idtransaksi, buku.file_gambar, buku.judul, peminjaman.tgl_pinjam,
                date_add(tgl_pinjam,INTERVAL 14 day) AS bataswaktu, dt.tgl_kembali, dt.denda, peminjaman.total_denda
                FROM anggota
                JOIN peminjaman ON anggota.nim=peminjaman.nim
                JOIN detail_transaksi AS dt ON peminjaman.idtransaksi=dt.idtransaksi
                JOIN buku ON dt.idbuku=buku.idbuku
                WHERE nama='".$_SESSION['username']."' AND !ISNULL(dt.tgl_kembali)
                ORDER BY dt.idtransaksi DESC, dt.tgl_kembali DESC";
      $result = $db->query($query);
      if (!$result) {
        die("Could not query the database: <br />" . $db->error . "<br />Query: " . $query);
      }
      // Fetch and display the results
      while ($row = $result->fetch_object()) {
        echo '<tr>';
        echo '<td>' . $row->idtransaksi . '</td>';
        echo '<td>' . $row->tgl_pinjam . '</td>';
        $image = $row->file_gambar;
        echo '<td>' . '<img src="./images/' . $image . '" width="100">' . '</td>';
        echo '<td>' . $row->judul . '</td>';
        echo '<td>' . $row->bataswaktu . '</td>';
        echo '<td>' . $row->tgl_kembali . '</td>';
        echo '<td>' . $row->denda . '</td>';
        echo '<td>' . $row->total_denda . '</td>';
        echo '</tr>';
      }
      echo '</table>';
      $result->free();
      $db->close();
      ?>
    </table>
  </div>
</div><br>
<?php include('footer.html'); ?>