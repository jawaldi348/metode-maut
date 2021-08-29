<?php
$sql = "SELECT RIGHT(kode_kriteria,3) AS kode FROM kriteria ORDER BY kode_kriteria DESC LIMIT 1";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) <> 0) {
    $row = mysqli_fetch_assoc($result);
    $dt = $row['kode'];
    $kode = intval($dt) + 1;
} else {
    $kode = 1;
}
$kodemax  = str_pad($kode, 3, "0", STR_PAD_LEFT);
$kodejadi = "K-" . $kodemax;

$error = '';
if (isset($_POST['tambah'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $bobot = $_POST['bobot'];
    $min = $_POST['min'];
    $max = $_POST['max'];
    if ($kode == '' || $nama == '' || $bobot == '' || $min == '' || $min == '') {
        $error = 'Nama kriteria atau bobot kriteria tidak boleh kosong!';
    } else {
        $query = "INSERT INTO kriteria VALUES ('$kode','$nama','$bobot','$min','$max')";
        $simpan = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $query - Error: " . mysqli_error($link), E_USER_ERROR);
        if ($simpan) {
            echo '<script type="text/javascript">window.location.replace("home.php?page=kriteria");</script>';
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
                <h3 class="box-title">Tambah Kriteria</h3>
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
                        <label>Nama Kriteria</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Bobot</label>
                        <input type="text" name="bobot" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nilai Minimum</label>
                        <input type="text" name="min" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nilai Maximum</label>
                        <input type="text" name="max" class="form-control">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" name="tambah"><i class="icon-floppy-disk"></i> Simpan</button>
                    <a href="?page=kriteria" class="btn btn-danger" data-dismiss="modal"><i class="fa  fa-angle-double-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>