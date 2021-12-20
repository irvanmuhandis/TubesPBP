<?php
include('../db_login.php');
$query = $db->prepare('select * from anggota where nama=? and password=?');
$pwd = md5($_GET['pwd']);
$query->bindValue("ss", $_GET['nama'], $pwd);
$query->execute();
$rs = $query->get_result();
if ($rs->num_rows != 0) {
    echo 1;
} else {
    echo 0;
}
