<?php
//File      : add_buku.php
//Deskripsi : menampilkan form add data buku dan mengupdate ke database
require('./header3.php');
require_once('db_login.php');
if (isset($_POST["submit"])) {
    $valid = TRUE; //flag validasi


    //update data into database
    if ($valid) {
        //escape inputs data
        $nama = test_input($_POST['kategori']); //menghapus tanda petik
        //asign a query
        $query = " INSERT INTO kategori (nama) VALUES ('$nama') ";
        //execute the query
        $result = $db->query($query);
        if (!$result) {
            die("Could not the query the database: <br />" . $db->error . '<br>Query:' . $query);
        } else {
            $db->close();
            header('Location: kategori.php');
        }
    }
}

?>
<br>
<div class="container">
    <div class="card">
        <div class="card-header">Tambah Kategori</div>
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">

                <div class="form-group">
                    <label for="pengarang">Nama Kategori:</label>
                    <input type="text" class="form-control" required id="kategori" name="kategori" value="<?php if (isset($nama)) echo $nama; ?>">
                    <div class="text-danger"><?php if (isset($error_nama)) echo $error_nama; ?></div>
                </div>


                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <a href="kategori.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php
$db->close();
?>