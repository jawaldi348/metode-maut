<?php
$kode = $_GET['kode'];
$sql = "SELECT kode_nilai,nama_tanaman,nama_kriteria,nilai_tanaman FROM tanaman JOIN nilai_tanaman ON tanaman.kode_tanaman=nilai_tanaman.kode_tanaman
JOIN kriteria ON kriteria.kode_kriteria=nilai_tanaman.kode_kriteria WHERE kode_nilai='$kode'";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($result);

$error = '';
if (isset($_POST['edit'])) {
    $kode = $_POST['kode'];
    $nilai = $_POST['nilai'];
    if ($kode == '' || $nilai == '') {
        $error = 'Nilai tidak boleh kosong!';
    } else {
        $query = "UPDATE nilai_tanaman SET nilai_tanaman='$nilai' WHERE kode_nilai='$kode'";
        $edit = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $query - Error: " . mysqli_error($link), E_USER_ERROR);
        if ($edit) {
            echo '<script type="text/javascript">window.location.replace("home.php?page=penilaian");</script>';
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
                <h3 class="box-title">Edit Penilaian Kriteria</h3>
            </div>
            <form action="" method="post">
                <input type="hidden" name="kode" value="<?= $data['kode_nilai'] ?>">
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
                        <label>Tanaman</label>
                        <input type="text" class="form-control" value="<?= $data['nama_tanaman'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Kriteria</label>
                        <input type="text" class="form-control" value="<?= $data['nama_kriteria'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <input type="text" name="nilai" id="nilai" class="form-control" value="<?= $data['nilai_tanaman'] ?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" name="edit"><i class="icon-floppy-disk"></i> Edit</button>
                    <a href="?page=penilaian" class="btn btn-danger" data-dismiss="modal"><i class="fa  fa-angle-double-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>