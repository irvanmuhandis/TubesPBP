<?php include('header3.php'); ?>
<br>
<div class="card">
    <div class="card-header h4">
        Riwayat Peminjaman Buku
    </div>
    <div class="card-body">
        <br>
        <div class="alert alert-info">
            <small>
                * Waktu peminjaman buku hanya 14 hari / 2 Minggu<br />
                * Set waktu > 14 hari sebelum tanggal sekarang<br />
                * Denda keterlambatan 1000/hari<br />
            </small>
        </div>
        <table class="table table-striped">
            <tr>
                <th>NIM</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
            </tr>
            <?php
            require_once('db_login.php');
            $query = "SELECT * FROM detail_transaksi  join peminjaman on peminjaman.idtransaksi = detail_transaksi.idtransaksi JOIN anggota on peminjaman.nim = anggota.nim join buku on buku.idbuku = detail_transaksi.idbuku where tgl_kembali is not null order by tgl_kembali DESC;";
            $result = $db->query($query);
            if (!$result) {
                die("Could not query the database: <br />" . $db->error . "<br />Query: " . $query);
            }
            // Fetch and display the results
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>' . $row->nim . '</td>';
                echo '<td>' . $row->nama . '</td>';
                echo '<td>' . $row->judul . '</td>';
                echo '<td>' . $row->tgl_pinjam . '</td>';
                echo '<td>' . $row->tgl_kembali . '</td>';
                echo '<td>' . $row->denda . '</td>';

                echo '</tr>';
            }
            echo '</table>';
            $result->free();
            $db->close();
            ?>
        </table>
    </div>
</div>
</div>
<?php include('footer.html'); ?>