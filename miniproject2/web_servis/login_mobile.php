<?php
include('../db_login.php');
$query = $db->prepare('select * from anggota where nama=? and password=?');
$query->bind_param("ss", $_GET['nama'], md5($_GET['pwd']));
$query->execute();
$rs = $query->get_result();
if ($rs->num_rows != 0) {
    echo 1;
} else {
    echo 0;
}
