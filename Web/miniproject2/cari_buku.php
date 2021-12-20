<?php
require("./db_login.php");
$kata = $db->real_escape_string($_GET['judul']);
$query = "SELECT * FROM books where title LIKE '%$kata%'";
$result = $db->query($query);
if (!$result) {
    die("Could not query the database: <br />" . $db->error);
}
while ($row = $result->fetch_object()) {
    echo '<td><tr>ISBN : ' . $row->isbn . ' <br></tr>';
    echo '<tr> Judul : ' . $row->title . '<br> </tr>';
    echo '<tr> Pengarang : ' . $row->author . ' <br></tr>';
    echo '<tr> Harga : ' . $row->price . ' </tr></td><hr>';
}
$result->free();
$db->close();
