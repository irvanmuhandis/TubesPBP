<?php
include('../db_login.php');
$query = $db->prepare("SELECT dt.idtransaksi, buku.file_gambar, buku.judul, peminjaman.tgl_pinjam,
date_add(tgl_pinjam,INTERVAL 14 day) AS bataswaktu, dt.denda
FROM anggota
JOIN peminjaman ON anggota.nim=peminjaman.nim
JOIN detail_transaksi AS dt ON peminjaman.idtransaksi=dt.idtransaksi
JOIN buku ON dt.idbuku=buku.idbuku
WHERE nama= ? AND dt.tgl_kembali is null");
$query->bind_param("s", $_GET['nama']);
$query->execute();
$array = array();
$st = $query->get_result();
if (!$query) {
    die($db->error);
} else {
    while ($row = $st->fetch_object()) {
        array_push($array, $row);
    }
}
echo json_encode($array);


