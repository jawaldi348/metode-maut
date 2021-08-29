<?php
$sql = "SELECT RIGHT(kode_tanaman,2) AS kode FROM tanaman ORDER BY kode_tanaman DESC LIMIT 1";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) <> 0) {
    $row = mysqli_fetch_assoc($result);
    $dt = $row['kode'];
    $kode = intval($dt) + 1;
} else {
    $kode = 1;
}
$kodemax  = str_pad($kode, 2, "0", STR_PAD_LEFT);
$kodejadi = "TA-" . $kodemax;

$error = '';
if (isset($_POST['tambah'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    if ($kode == '' || $nama == '') {
        $error = 'Nama tanaman tidak boleh kosong!';
    } else {
        $query = "INSERT INTO tanaman VALUES ('$kode','$nama')";
        $simpan = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $query - Error: " . mysqli_error($link), E_USER_ERROR);
        if ($simpan) {
            echo '<script type="text/javascript">window.location.replace("home.php?page=tanaman");</script>';
        } else {
            $error = 'Data gagal disimpan';
        }
    }
}
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Tanaman</h3>
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
                        <input type="text" name="kode" class="form-control" value="<?= $kodejadi ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Tanaman</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" name="tambah"><i class="icon-floppy-disk"></i> Simpan</button>
                    <a href="?page=tanaman" class="btn btn-danger" data-dismiss="modal"><i class="fa  fa-angle-double-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>