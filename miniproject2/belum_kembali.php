<?php include('header3.php'); ?>
<br>
<div class="card">
  <div class="card-header h4">
    Anggota Belum Mengembalikan Buku
  </div>
  <div class="card-body">
    <br>
    <div class="alert alert-info">
      <small>
        * Waktu peminjaman buku hanya 14 hari / 2 Minggu<br />
        * Set waktu > 14 hari sebelum tanggal sekarang<br />
        * Denda keterlambatan 1000/hari<br />
      </small>
    </div>
    <table class="table table-striped">
      <tr>
        <th>NIM</th>
        <th>Nama Anggota</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Batas Pengembalian</th>
      </tr>
      <?php
      require_once('db_login.php');
      $query = "SELECT anggota.nim, anggota.nama, buku.judul, peminjaman.tgl_pinjam ,date_add(tgl_pinjam,INTERVAL 12 day)  as bataswaktu,total_denda
                  FROM peminjaman JOIN anggota ON peminjaman.nim = anggota.nim
                  JOIN detail_transaksi ON peminjaman.idtransaksi=detail_transaksi.idtransaksi
                  JOIN buku ON detail_transaksi.idbuku=buku.idbuku
                  WHERE detail_transaksi.tgl_kembali IS NULL
                  ORDER BY anggota.nim;";
      $result = $db->query($query);
      if (!$result) {
        die("Could not query the database: <br />" . $db->error . "<br />Query: " . $query);
      }
      // Fetch and display the results
      while ($row = $result->fetch_object()) {
        echo '<tr>';
        echo '<td>' . $row->nim . '</td>';
        echo '<td>' . $row->nama . '</td>';
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