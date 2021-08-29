<div class="box box-default">
    <div class="box-header with-border">
        <a class="btn btn-social btn-flat btn-success btn-sm" href="?page=user&form=tambah"><i class="icon-plus3"></i> Tambah Data</a>
        <h3 class="box-title pull-right">Data User</h3>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="data-tabel">
            <thead>
                <tr>
                    <th class="text-center" width="25px">No</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th class="text-center" width="100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $sql = "SELECT * FROM user";
                $result = mysqli_query($link, $sql);
                while ($d = mysqli_fetch_array($result)) {
                    if ($d['level_user'] == 1) :
                        $level = 'Admin';
                    elseif ($d['level_user'] == 2) :
                        $level = 'BPP';
                    else :
                        $level = 'Kepala Bagian Tanaman Pangan';
                    endif;
                ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td><?= $d['username'] ?></td>
                        <td><?= $level ?></td>
                        <td class="text-center">
                            <a href="?page=user&form=edit&kode=<?= $d['id_user'] ?>"><i class="icon-pencil7 text-green"></i></a>
                            <a href="?page=user&form=hapus&kode=<?= $d['id_user'] ?>"><i class="icon-trash text-red"></i></a>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>