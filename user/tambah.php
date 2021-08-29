<?php
$sql = "SELECT id_user AS kode FROM user ORDER BY id_user DESC LIMIT 1";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $dt = $row['kode'];
    $kode = intval($dt) + 1;
} else {
    $kode = 1;
}

$error = '';
if (isset($_POST['tambah'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $pass = $_POST['pass'];
    $level = $_POST['level'];
    if ($kode == '' || $nama == '' || $pass == '' || $level == '') {
        $error = 'Username, password dan level tidak boleh kosong!';
    } else {
        $query = "INSERT INTO user VALUES ('$kode','$nama','$pass','$level')";
        $simpan = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $query - Error: " . mysqli_error($link), E_USER_ERROR);
        if ($simpan) {
            echo '<script type="text/javascript">window.location.replace("home.php?page=user");</script>';
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
                <h3 class="box-title">Tambah User</h3>
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
                        <input type="text" name="kode" class="form-control" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="1">Admin</option>
                            <option value="2">BPP</option>
                            <option value="3">Kepala Bagian Tanaman Pangan</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" name="tambah"><i class="icon-floppy-disk"></i> Simpan</button>
                    <a href="?page=user" class="btn btn-danger" data-dismiss="modal"><i class="fa  fa-angle-double-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>