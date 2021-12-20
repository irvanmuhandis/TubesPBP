<?php
require_once('db_login.php');

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $result = $db->query("SELECT detail_transaksi.idtransaksi, detail_transaksi.idbuku, judul, tgl_kembali FROM `peminjaman` JOIN detail_transaksi ON peminjaman.idtransaksi = detail_transaksi.idtransaksi JOIN buku ON detail_transaksi.idbuku = buku.idbuku WHERE nim =".$id." AND ISNULL(tgl_kembali)");?>
  <option value="none">--Pilih buku--</option>;
  <?php
  while($data = $result->fetch_object()):?>
  <option value="<?php echo $data->idbuku ?>"><?php echo $data->judul ?></option>
  <?php
  endwhile;
}
?>
