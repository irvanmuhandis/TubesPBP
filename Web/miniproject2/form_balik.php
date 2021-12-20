<?php include('header3.php');
require_once('db_login.php');
if (!isset($_SESSION['username']) || $_SESSION['user'] != 'admin') {
  header('Location: login.php');
}
?>
<br>
<div class="card">
  <div class="card-header h4">
    Form Pengembalian
  </div>
  <div class="card-body">
    <?php
    if (isset($_POST['submit'])) {
      $valid = TRUE;

      $nim = test_input($_POST['nim']);
      if ($nim == '') {
        $error_anggota = "Anggota harus dipilih";
        $valid = FALSE;
      }

      $idb = test_input($_POST['buku']);
      if ($idb == '') {
        $error_buku = "Buku harus dipilih";
        $valid = FALSE;
      }

      if ($valid) {
        $result = $db->query("SELECT tgl_pinjam, detail_transaksi.idtransaksi, idbuku, current_date FROM peminjaman JOIN detail_transaksi ON peminjaman.idtransaksi=detail_transaksi.idtransaksi WHERE detail_transaksi.idbuku = $idb AND peminjaman.nim = $nim AND ISNULL(detail_transaksi.tgl_kembali)");
        $hari0 = $result->fetch_object();
        $hari = new DateTime($hari0->tgl_pinjam);
        $hari2 = new DateTime($hari0->current_date);
        $idt = $hari0->idtransaksi;
        $jml = $hari2->diff($hari)->format("%a");
        if ($jml > 14) {
          $jml = $jml - 14;
          $result2 = $db->query("UPDATE detail_transaksi SET tgl_kembali = current_date, denda = $jml * 1000 WHERE idtransaksi = $idt AND idbuku = $idb");
          $result3 = $db->query("UPDATE peminjaman SET total_denda = total_denda + $jml * 1000 WHERE idtransaksi = $idt");
        } else {
          $result2 = $db->query("UPDATE detail_transaksi SET tgl_kembali = current_date, denda = 0 WHERE idtransaksi = $idt AND idbuku = $idb ");
          $result3 = $db->query("UPDATE peminjaman SET total_denda = total_denda + 0 WHERE idtransaksi = $idt ");
        }

        $db->query("UPDATE buku SET stok_tersedia = stok_tersedia + 1 WHERE idbuku = " . $idb);
        if ($result) {
          echo '<div class="alert alert-success">Buku berhasil dikembalikan</div>';
          $result4 = $db->query("SELECT denda, total_denda FROM detail_transaksi JOIN peminjaman ON detail_transaksi.idtransaksi=peminjaman.idtransaksi WHERE detail_transaksi.idtransaksi = $idt AND idbuku = $idb");
          $row = $result4->fetch_object();
          echo '<div class="alert alert-danger">Denda: ' . $row->denda . '<br>Total Denda: ' . $row->total_denda . '</div>';
        }
      }
    }
    ?>
    <form class="" method="post">
      <div class="form-group">
        <label for="idTransaksi">Nama Anggota:</label>
        <select name="nim" id="nim" class="form-control" onchange="pilihBuku(this.value)">
          <option value="">--Pilih Anggota--</option>
          <?php
          require_once('db_login.php');
          //Asign a query
          $query = " SELECT DISTINCT peminjaman.nim, nama FROM peminjaman JOIN detail_transaksi ON peminjaman.idtransaksi = detail_transaksi.idtransaksi JOIN anggota ON peminjaman.nim = anggota.nim WHERE detail_transaksi.tgl_kembali is NULL ORDER BY anggota.nama";
          $result = $db->query($query);
          if (!$result) {
            die("Could not query the database: <br />" . $db->error);
          }
          // Fetch and display the results
          while ($row = $result->fetch_object()) {
            echo '<option value="' . $row->nim . '">' . $row->nama . '</option>';
          }
          $result->free();
          ?>
        </select>
        <div class="text-danger" id="error_anggota"><?php if (isset($error_anggota)) echo $error_anggota; ?></div>
      </div>
      <div class="form-group">
        <label for="idBuku">Judul Buku:</label>
        <select name="buku" id="buku" class="form-control">
          <option value="">--Pilih buku--</option>;
        </select>
        <div class="text-danger" id="error_buku"><?php if (isset($error_buku)) echo $error_buku; ?></div>
      </div>
      <button type="submit" class="btn btn-primary" value="submit" name="submit">Submit</button>
    </form>
  </div>
</div>
<?php include('footer.html'); ?>