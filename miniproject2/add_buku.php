<?php
//File      : add_buku.php
//Deskripsi : menampilkan form add data buku dan mengupdate ke database

require_once('db_login.php');
if (isset($_POST["submit"])) {
    $valid = TRUE; //flag validasi
    $isbn = test_input($_POST['isbn']);
    $judul = test_input($_POST['judul']);
    $kategori = test_input($_POST['kategori']);
    $pengarang = test_input($_POST['pengarang']);
    $penerbit = test_input($_POST['penerbit']);
    $kota_terbit = test_input($_POST['kota_terbit']);
    $editor = test_input($_POST['editor']);
    $pengarang = test_input($_POST['pengarang']);

    $gambar = $_FILES['file_gambar']['name'];
    $path = $_FILES['file_gambar']['tmp_name'];
    move_uploaded_file($path, './images/' . $gambar);
    
    $tgl_insert = test_input($_POST['tgl_insert']);
    $tgl_update = test_input($_POST['tgl_update']);
    $stok = $_POST['stok'];
    $stok_tersedia = $_POST['stok_tersedia'];

    //update data into database
    if ($valid) {
        //escape inputs data
        $address = $db->real_escape_string($_POST['address']); //menghapus tanda petik
        //asign a query
        $query = " INSERT INTO buku (file_gambar, isbn, judul, idkategori, pengarang, penerbit, kota_terbit, editor, tgl_insert, tgl_update, stok, stok_tersedia)
                   VALUES ('$gambar', $isbn, '$judul', $kategori, '$pengarang', '$penerbit', '$kota_terbit', '$editor', CURRENT_DATE(), CURRENT_DATE(), $stok, $stok) ";
        //execute the query
        $result = $db->query($query);
        if (!$result) {
            die("Could not the query the database: <br />" . $db->error . '<br>Query:' . $query);
        } else {
            $db->close();
            header('Location: index2.php');
        }
    }
}
?>
<?php include('header3.php'); ?>
<br>
<div class="container">
    <div class="card">
        <div class="card-header h4">Tambah Buku</div>
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                <div class="form-group">
                    <label for="cover_buku">Cover Buku:</label>
                    <br>
                    <input type="file" name="file_gambar" required>
                    <div class="text-danger"><?php if (isset($error_file_gambar)) echo $error_file_gambar; ?></div>
                </div>

                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" class="form-control" id="isbn" required name="isbn" value="<?php if (isset($isbn)) echo $isbn; ?>">
                    <div class="text-danger"><?php if (isset($error_isbn)) echo $error_isbn; ?></div>
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select name="kategori" id="kategori" required class="form-control">
                        <option value="none" <?php if (isset($kategori)) echo 'selected="true"'; ?>>--Pilih kategori--</option>
                        <?php
                        require_once('db_login.php');
                        //Asign a query
                        $query = " SELECT * FROM kategori ORDER BY idkategori";
                        $result = $db->query($query);
                        if (!$result) {
                            die("Could not query the database: <br />" . $db->error);
                        }
                        // Fetch and display the results
                        while ($row = $result->fetch_object()) {
                            echo '<option value="' . $row->idkategori . '">' . $row->nama . '</option>';
                        }
                        $result->free();
                        ?>
                    </select>
                    <div class="text-danger"><?php if (isset($error_kategori)) echo $error_kategori; ?></div>
                </div>

                <div class="form-group">
                    <label for="judul">Judul:</label>
                    <input type="text" class="form-control" required id="judul" name="judul" value="<?php if (isset($judul)) echo $judul; ?>">
                    <div class="text-danger"><?php if (isset($error_judul)) echo $error_judul; ?></div>
                </div>

                <div class="form-group">
                    <label for="pengarang">Pengarang:</label>
                    <input type="text" class="form-control" required id="pengarang" name="pengarang" value="<?php if (isset($pengarang)) echo $pengarang; ?>">
                    <div class="text-danger"><?php if (isset($error_pengarang)) echo $error_pengarang; ?></div>
                </div>

                <div class="form-group">
                    <label for="penerbit">Penerbit:</label>
                    <input type="text" class="form-control" required id="penerbit" name="penerbit" value="<?php if (isset($penerbit)) echo $penerbit; ?>">
                    <div class="text-danger"><?php if (isset($error_penerbit)) echo $error_penerbit; ?></div>
                </div>

                <div class="form-group">
                    <label for="kota_terbit">Kota Terbit:</label>
                    <input type="text" class="form-control" required id="kota_terbit" name="kota_terbit" value="<?php if (isset($kota_terbit)) echo $kota_terbit; ?>">
                    <div class="text-danger"><?php if (isset($error_kota_terbit)) echo $error_kota_terbit; ?></div>
                </div>

                <div class="form-group">
                    <label for="editor">Editor:</label>
                    <input type="text" class="form-control" required id="editor" name="editor" value="<?php if (isset($editor)) echo $editor; ?>">
                    <div class="text-danger"><?php if (isset($error_editor)) echo $error_editor; ?></div>
                </div>
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" required min="0" class="form-control" id="stok" name="stok" value="<?php if (isset($stok)) echo $stok; ?>">
                    <div class="text-danger"><?php if (isset($error_stok)) echo $error_stok; ?></div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <a href="index2.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php
$db->close();
?>