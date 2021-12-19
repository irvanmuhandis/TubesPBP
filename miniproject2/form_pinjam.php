<?php include('header3.php');
require_once('db_login.php');
if (!isset($_SESSION['username']) || $_SESSION['user'] != 'admin') {
    header('Location: login.php');
}
?>
<br>
<div class="card">
    <div class="card-header h4">Form Peminjaman</div>
    <div class="card-body">
        <?php
        //File      : add_buku.php
        //Deskripsi : menampilkan form add data buku dan mengupdate ke database

        if (isset($_POST["submit"])) {
            $valid = TRUE; //flag validasi

            $nama = $_POST['nama'];
            if ($nama == '') {
                $error_nama = "Nama harus diisi";
                $valid = FALSE;
            }

            $judul = $_POST['judul'];
            $judul2 = $_POST['judul2'];
            if ($judul == '' && $judul2 == '') {
                $error_judul = "Judul buku harus diisi";
                $valid = FALSE;
            }

            if ($valid) {
                if ($judul != '') {
                    $qoeri = "SELECT stok_tersedia from buku where idbuku=" . $_POST["judul"];
                    $hasil = $db->query($qoeri);
                    if (!$hasil) {
                        die($db->error);
                    } else {
                        $brs = $hasil->fetch_object();
                        if ($brs->stok_tersedia == 0) {
                            die('Stok judul 1 habis! ');
                        }
                    }
                }
                if ($judul2 != '') {
                    $qoeri2 = "SELECT stok_tersedia from buku where idbuku=" . $_POST["judul2"];
                    $hasil2 = $db->query($qoeri2);
                    if (!$hasil2) {
                        die($db->error);
                    } else {
                        $brs2 = $hasil2->fetch_object();
                        if ($brs2->stok_tersedia == 0) {
                            die('Stok judul 2 habis! ');
                        }
                    }
                }

                $query = " INSERT INTO peminjaman (nim, tgl_pinjam, idpetugas) VALUES (" . $_POST['nama'] . ", current_date,
                    (SELECT idpetugas FROM petugas WHERE nama='" . $_SESSION['username'] . "')) ";
                $result = $db->query($query);

                if ($judul != '') {
                    $query2 = " INSERT INTO detail_transaksi (idtransaksi, idbuku) VALUES (
                        (SELECT idtransaksi FROM peminjaman ORDER BY idtransaksi DESC LIMIT 1),
                        (SELECT idbuku FROM buku WHERE idbuku=" . $judul . ")
                        )";
                    $result2 = $db->query($query2);

                    $query3 = "UPDATE buku SET stok_tersedia = " . ($brs->stok_tersedia - 1) . " where idbuku = " . $judul;
                    $result3 = $db->query($query3);
                }

                if ($judul2 != '') {
                    $query2b = " INSERT INTO detail_transaksi (idtransaksi, idbuku) VALUES (
                        (SELECT idtransaksi FROM peminjaman ORDER BY idtransaksi DESC LIMIT 1),
                        (SELECT idbuku FROM buku WHERE idbuku=" . $judul2 . ")
                        )";
                    $result2b = $db->query($query2b);

                    $query3b = "UPDATE buku SET stok_tersedia = " . ($brs->stok_tersedia - 1) . " where idbuku = " . $judul2;
                    $result3b = $db->query($query3b);
                }

                if (!$result) {
                    die("Could not the query the database: <br />" . $db->error . '<br>Query:' . $query);
                } else if (!$result2) {
                    die("Could not the query the database: <br />" . $db->error . '<br>Query:' . $query2);
                } else {
                    echo '<div class="alert alert-success">Peminjaman berhasil ditambahkan.</div>';
                }
            }
        }
        ?>
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nama">Nama Anggota:</label>
                <select name="nama" id="nama" class="form-control" onchange="cekNim(this.value)">
                    <option value="">--Pilih nama--</option>
                    <?php
                    //Asign a query
                    $query = " SELECT * FROM anggota ORDER BY nim ";
                    $result = $db->query($query);
                    if (!$result) {
                        die("Could not query the database: <br />" . $db->error);
                    }
                    // Fetch and display the results
                    while ($row = $result->fetch_object()) {
                        echo '<option value="' . $row->nim . '">' . $row->nama . '</option>';
                    }
                    $result->free();
                    ?>
                </select>
                <div class="text-danger" id="error_anggota"><?php if (isset($error_nama)) echo $error_nama; ?></div>
            </div>
            <div class="form-group">
                <label for="judul">Judul Buku:</label>
                <select name="judul" id="judul" class="form-control">
                    <option value="">--Pilih judul--</option>
                    <?php
                    //Asign a query
                    $query = " SELECT * FROM buku ORDER BY idbuku";
                    $result = $db->query($query);
                    if (!$result) {
                        die("Could not query the database: <br />" . $db->error);
                    }
                    // Fetch and display the results
                    while ($row = $result->fetch_object()) {
                        echo '<option value="' . $row->idbuku . '">' . $row->judul . '</option>';
                    }
                    $result->free();
                    ?>
                </select>
                <div class="text-danger"><?php if (isset($error_judul)) echo $error_judul; ?></div>
            </div>
            <div class="form-group">
                <label for="judul2">Judul Buku 2:</label>
                <select name="judul2" id="judul2" class="form-control">
                    <option value="">--Pilih judul--</option>
                    <?php
                    //Asign a query
                    $query = " SELECT * FROM buku ORDER BY idbuku";
                    $result = $db->query($query);
                    if (!$result) {
                        die("Could not query the database: <br />" . $db->error);
                    }
                    // Fetch and display the results
                    while ($row = $result->fetch_object()) {
                        echo '<option value="' . $row->idbuku . '">' . $row->judul . '</option>';
                    }
                    $result->free();
                    ?>
                </select>
                <div class="text-danger"><?php if (isset($error_judul2)) echo $error_judul2; ?></div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
        </form>
    </div>
</div>
<?php include('footer.html'); ?>