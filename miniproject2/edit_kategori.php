<?php
require_once('./header3.php');
//File      : edit_buku.php
//Deskripsi : menampilkan form edit data buku dan mengupdate ke database

require_once('db_login.php');
$id = $_GET['id'];
// mengecek apakah user belum menekan tombol submit
if (isset($_POST['submit'])) {
    $valid = TRUE; //flag validasi
    $nama = $_POST['nama'];
    if ($valid) {
        //asign a query
        $query = " UPDATE kategori SET nama ='" . $nama . "'  where idkategori= " . $id;
        $result = $db->query($query);
        //execute the query
        if (!$result) {
            die("Could not the query the database: <br />" . $db->error . '<br>Query:' . $query);
        } else {
            $db->close();
            header('Location: kategori.php');
        }
    }
} else {
    $query = " SELECT * from kategori order by idkategori";
    //execute the query
    $result = $db->query($query);
    if (!$result) {
        die("Could not the query database: <br />" . $db->error);
    } else {
        while ($row = $result->fetch_object()) {
            $namas = $row->nama;
            $idnya = $row->idkategori;
        }
    }
} ?>

<br>
<div class="container">
    <div class="card">
        <div class="card-header">Edit Data Buku</div>
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
                <div class="form-group">
                    <label>Nama Kategori </label>
                    <input type="text" class="form-control" name="nama" required value="<?= $namas ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <a href="kategori.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php include('footer.html') ?>
<?php
$db->close();
?>