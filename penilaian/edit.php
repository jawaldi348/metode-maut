<?php
$kode = $_GET['kode'];
$sql = "SELECT kode_nilai,nama_tanaman,kriteria.kode_kriteria AS idkriteria,nama_kriteria,nilai_tanaman FROM tanaman JOIN nilai_tanaman ON tanaman.kode_tanaman=nilai_tanaman.kode_tanaman
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
                        <label>Nilai Kriteria</label><br>
                        <?php if($data['idkriteria'] =='K-001'){?>
                            <input type="radio" name="nilai" id="nilai" value="1" <?= $data['nilai_tanaman']=='1' ? 'checked' : '' ?>> Kurang Sesuai<br>
                            <input type="radio" name="nilai" id="nilai" value="2" <?= $data['nilai_tanaman']=='2' ? 'checked' : '' ?>> Cukup Sesuai<br>
                            <input type="radio" name="nilai" id="nilai" value="3" <?= $data['nilai_tanaman']=='3' ? 'checked' : '' ?>> Sangat Baik<br>
                        <?php } else if($data['idkriteria'] =='K-002'){?>
                            <input type="radio" name="nilai" id="nilai" value="1" <?= $data['nilai_tanaman']=='1' ? 'checked' : '' ?>> 26&deg; - 30&deg; C<br>
                            <input type="radio" name="nilai" id="nilai" value="2" <?= $data['nilai_tanaman']=='2' ? 'checked' : '' ?>> 21&deg; - 25&deg; C<br>
                            <input type="radio" name="nilai" id="nilai" value="3" <?= $data['nilai_tanaman']=='3' ? 'checked' : '' ?>> 15&deg; - 20&deg; C<br>
                        <?php } else if($data['idkriteria'] =='K-003'){?>
                            <input type="radio" name="nilai" id="nilai" value="1" <?= $data['nilai_tanaman']=='1' ? 'checked' : '' ?>> 301 mm - 400 mm<br>
                            <input type="radio" name="nilai" id="nilai" value="2" <?= $data['nilai_tanaman']=='2' ? 'checked' : '' ?>> 201 mm - 300 mm<br>
                            <input type="radio" name="nilai" id="nilai" value="3" <?= $data['nilai_tanaman']=='3' ? 'checked' : '' ?>> 151 mm - 200 mm<br>
                        <?php } else if($data['idkriteria'] =='K-004'){?>
                            <input type="radio" name="nilai" id="nilai" value="1" <?= $data['nilai_tanaman']=='1' ? 'checked' : '' ?>> < 60%<br>
                            <input type="radio" name="nilai" id="nilai" value="2" <?= $data['nilai_tanaman']=='2' ? 'checked' : '' ?>> 60% - 80%<br>
                            <input type="radio" name="nilai" id="nilai" value="3" <?= $data['nilai_tanaman']=='3' ? 'checked' : '' ?>> > 80%<br>
                        <?php } else if($data['idkriteria'] =='K-005'){?>
                            <input type="radio" name="nilai" id="nilai" value="1" <?= $data['nilai_tanaman']=='1' ? 'checked' : '' ?>> Kurang Lancar<br>
                            <input type="radio" name="nilai" id="nilai" value="2" <?= $data['nilai_tanaman']=='2' ? 'checked' : '' ?>> Cukup<br>
                            <input type="radio" name="nilai" id="nilai" value="3" <?= $data['nilai_tanaman']=='3' ? 'checked' : '' ?>> Lancar<br>
                        <?php } else if($data['idkriteria'] =='K-006'){?>
                            <input type="radio" name="nilai" id="nilai" value="1" <?= $data['nilai_tanaman']=='1' ? 'checked' : '' ?>> Rendah<br>
                            <input type="radio" name="nilai" id="nilai" value="2" <?= $data['nilai_tanaman']=='2' ? 'checked' : '' ?>> Menengah<br>
                            <input type="radio" name="nilai" id="nilai" value="3" <?= $data['nilai_tanaman']=='3' ? 'checked' : '' ?>> Tinggi<br>
                        <?php }?>
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