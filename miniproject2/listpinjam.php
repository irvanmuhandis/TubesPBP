<?php
include('header3.php');
if (!isset($_SESSION['username']) || $_SESSION['user'] != 'admin') {
  header('Location: login.php');
}
?>
<br>
<div class="card">
  <div class="card-header h4">
    Daftar Buku Dipinjam
  </div>
  <div class="card-body">
    <br>
    <table class="table table-striped">
      <tr>
        <th>ID Buku</th>
        <th>Gambar</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Batas Pengembalian</th>
      </tr>
      <?php
      require_once('db_login.php');

      $query = "SELECT peminjaman.idtransaksi, buku.file_gambar, buku.idbuku, buku.judul, peminjaman.tgl_pinjam, date_add(tgl_pinjam,INTERVAL 12 day)  as bataswaktu
                  FROM peminjaman JOIN detail_transaksi ON peminjaman.idtransaksi=detail_transaksi.idtransaksi
                  JOIN buku ON detail_transaksi.idbuku=buku.idbuku
                  WHERE detail_transaksi.tgl_kembali is NULL ORDER BY detail_transaksi.idbuku";
      $result = $db->query($query);
      if (!$result) {
        die("Could not query the database: <br />" . $db->error . "<br />Query: " . $query);
      }
      // Fetch and display the results
      while ($row = $result->fetch_object()) {
        echo '<tr>';
        echo '<td>' . $row->idbuku . '</td>';
        $image = $row->file_gambar;
        echo '<td>' . '<img src="./images/' . $image . '" width="100">' . '</td>';
        echo '<td>' . $row->judul . '</td>';
        echo '<td>' . $row->tgl_pinjam . '</td>';
        echo '<td>' . $row->bataswaktu . '</td>';
        echo '</tr>';
      }
      echo '</table>';
      $result->free();
      $db->close();
      ?>
    </table>
  </div>
</div>
</div>
<?php include('footer.html'); ?>