<?php
if (isset($_POST['tambah'])) {
    $tanaman = $_POST['tanaman'];
    $kriteria = $_POST['kriteria'];
    $nilai = $_POST['nilai'];
    $result = mysqli_query($link, "SELECT * FROM nilai_tanaman WHERE kode_tanaman='$tanaman' AND kode_kriteria='$kriteria'");
    $rows = mysqli_fetch_assoc($result);
    if ($rows == null) {
        $query = "INSERT INTO nilai_tanaman(kode_tanaman,kode_kriteria,nilai_tanaman) VALUES ('$tanaman','$kriteria','$nilai')";
        $create = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $query - Error: " . mysqli_error($link), E_USER_ERROR);
        if ($create) {
            echo '<script type="text/javascript">window.location.replace("home.php?page=penilaian");</script>';
        } else {
            $error = 'Data gagal disimpan';
        }
    } else {
        $error = 'Data sudah ada!';
    }
}
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Penilaian Kriteria</h3>
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
                        <label>Pilih Tanaman</label>
                        <select name="tanaman" id="tanaman" class="form-control">
                            <option value="">--- Pilih ---</option>
                            <?php
                            $tanaman = mysqli_query($link, "SELECT * FROM tanaman");
                            while ($d = mysqli_fetch_array($tanaman)) { ?>
                                <option value="<?= $d['kode_tanaman'] ?>"><?= $d['nama_tanaman'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Kriteria</label>
                        <select name="kriteria" id="kriteria" class="form-control">
                            <option value="">--- Pilih ---</option>
                            <?php $kriteria = mysqli_query($link, "SELECT * FROM kriteria");
                            while ($k = mysqli_fetch_array($kriteria)) { ?>
                                <option value="<?= $k['kode_kriteria'] ?>"><?= $k['nama_kriteria'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <input type="text" name="nilai" id="nilai" class="form-control">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" name="tambah"><i class="icon-floppy-disk"></i> Simpan</button>
                    <a href="?page=penilaian" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-angle-double-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>