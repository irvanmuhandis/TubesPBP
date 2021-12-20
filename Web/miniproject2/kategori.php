<?php
require('./header3.php');
require_once('./db_login.php');
?>
<br>
<div class="card">
    <div class="card-header">
        List Kategori Buku
    </div>
    <div class="card-body">
        <div class="text-right p-2">
            <a class="btn btn-primary  " href="add_kategori.php">+ Tambah Kategori</a>

        </div>

        <div id="hasil">
            <table class="table table-striped">
                <tr>
                    <th>Nama Kategori</th>
                    <th>Action</th>
                </tr>
                <?php
                $query = "SELECT * FROM kategori";
                $result = $db->query($query);
                if (!$result) {
                    die("Could not query the database: <br />" . $db->error . "<br />Query: " . $query);
                }
                // Fetch and display the results
                while ($row = $result->fetch_object()) {
                    echo '<tr>';
                    echo '<td>' . $row->nama . '</td>';
                    echo '<div id="edit" name="edit"></div>';
                    echo '<td>'; ?>
                    <a class="btn btn-primary  " href="edit_kategori.php?id=<?= $row->idkategori ?>">Edit Kategori</a>
                    <a class="btn btn-danger " href="delete_kategori.php?id=<?= $row->idkategori ?>" onclick="confirm('Apakah Anda Yakin')">Delete</a>
        </div>
        </td>
    <?php echo '</tr>';
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