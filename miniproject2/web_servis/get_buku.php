<?php
include('../db_login.php');
$query = $db->query('SELECT *, kategori.nama AS kategori FROM buku JOIN kategori ON buku.idkategori = kategori.idkategori order by judul');
$array = array();
if (!$query) {
    die($db->error);
} else {
    while ($row = $query->fetch_object()) {
        array_push($array, $row);
    }
}
echo json_encode($array);
