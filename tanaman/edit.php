<?php
$kode = $_GET['kode'];
$sql = "SELECT * FROM tanaman WHERE kode_tanaman='$kode'";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($result);

$error = '';
if (isset($_POST['edit'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    if ($kode == '' || $nama == '') {
        $error = 'Nama tanaman tidak boleh kosong!';
    } else {
        $query = "UPDATE tanaman SET nama_tanaman='$nama' WHERE kode_tanaman='$kode'";
        $edit = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $query - Error: " . mysqli_error($link), E_USER_ERROR);
        if ($edit) {
            echo '<script type="text/javascript">window.location.replace("home.php?page=tanaman");</script>';
        } else {
            $error = 'Data gagal dirubah';
        }
    }
}
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Tanaman</h3>
            </div>
            <form action="" method="post">
                <div class="box-body">
                    <?php
                    if ($error != '') {
                        echo '
                    <div class="alert alert-danger">
                    ' . $error . '
                    </div>
                    ';
                    }
                    ?>
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" name="kode" class="form-control" value="<?= $data['kode_tanaman'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Tanaman</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data['nama_tanaman'] ?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" name="edit"><i class="icon-floppy-disk"></i> Edit</button>
                    <a href="?page=tanaman" class="btn btn-danger" data-dismiss="modal"><i class="fa  fa-angle-double-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>