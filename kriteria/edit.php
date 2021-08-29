<?php
$kode = $_GET['kode'];
$sql = "SELECT * FROM kriteria WHERE kode_kriteria='$kode'";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($result);

$error = '';
if (isset($_POST['edit'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $bobot = $_POST['bobot'];
    $min = $_POST['min'];
    $max = $_POST['max'];
    if ($kode == '' || $nama == '' || $bobot == '' || $min == '' || $min == '') {
        $error = 'Nama kriteria atau bobot kriteria tidak boleh kosong!';
    } else {
        $query = "UPDATE kriteria SET nama_kriteria='$nama',bobot='$bobot',nilai_min='$min',nilai_max='$max' WHERE kode_kriteria='$kode'";
        $edit = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $query - Error: " . mysqli_error($link), E_USER_ERROR);
        if ($edit) {
            echo '<script type="text/javascript">window.location.replace("home.php?page=kriteria");</script>';
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
                <h3 class="box-title">Edit Kriteria</h3>
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
                        <input type="text" name="kode" class="form-control" value="<?= $data['kode_kriteria'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Tanaman</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data['nama_kriteria'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Bobot Kriteria</label>
                        <input type="text" name="bobot" class="form-control" value="<?= $data['bobot'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Nilai Minimum</label>
                        <input type="text" name="min" class="form-control" value="<?= $data['nilai_min'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Nilai Maximum</label>
                        <input type="text" name="max" class="form-control" value="<?= $data['nilai_max'] ?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" name="edit"><i class="icon-floppy-disk"></i> Edit</button>
                    <a href="?page=kriteria" class="btn btn-danger" data-dismiss="modal"><i class="fa  fa-angle-double-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>