<?php
$kode = $_GET['kode'];
$sql = "SELECT * FROM user WHERE id_user='$kode'";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($result);

$error = '';
if (isset($_POST['edit'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $pass = $_POST['pass'];
    $level = $_POST['level'];
    if ($kode == '' || $nama == '' || $level == '') {
        $error = 'Username, password dan level tidak boleh kosong!';
    } else {
        if ($pass == '') {
            $query = "UPDATE user SET username='$nama',level_user='$level' WHERE id_user='$kode'";
        } else {
            $query = "UPDATE user SET username='$nama',password='$pass',level_user='$level' WHERE id_user='$kode'";
        }
        $edit = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $query - Error: " . mysqli_error($link), E_USER_ERROR);
        if ($edit) {
            echo '<script type="text/javascript">window.location.replace("home.php?page=user");</script>';
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
                <h3 class="box-title">Edit User</h3>
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
                        <input type="text" name="kode" class="form-control" value="<?= $data['id_user'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data['username'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control">
                        <p class="help-block">Kosongkan jika tidak ingin merubah password.</p>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="1" <?= $data['level_user'] == 1 ? 'selected' : '' ?>>Admin</option>
                            <option value="2" <?= $data['level_user'] == 2 ? 'selected' : '' ?>>BPP</option>
                            <option value="3" <?= $data['level_user'] == 3 ? 'selected' : '' ?>>Kepala Bagian Tanaman Pangan</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" name="edit"><i class="icon-floppy-disk"></i> Edit</button>
                    <a href="?page=user" class="btn btn-danger" data-dismiss="modal"><i class="fa  fa-angle-double-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>