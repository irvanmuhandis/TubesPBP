<?php
include('../db_login.php');
$st = $db->prepare('select * from anggota where nama = ?');
$st->bind_param("s", $_GET['nama']);
$st->execute();
$pwd = md5($_GET['pwd']);
$rs = $st->get_result();
if ($rs->num_rows == 0) {
    $query = $db->prepare(" INSERT INTO anggota (nim, nama, password, alamat, kota, email, no_telp)
    VALUES (?,?,?, ?,?,?, ?) ");
    $query->bind_param("issssss", $_GET['nim'],  $_GET['nama'], $pwd, $_GET['almt'], $_GET['kota'], $_GET['email'], $_GET['hp']);
    $query->execute();
    echo 1;
} else {
    echo 0;
}
