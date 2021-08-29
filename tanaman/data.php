<div class="box box-default">
    <div class="box-header with-border">
        <a class="btn btn-social btn-flat btn-success btn-sm" href="?page=tanaman&form=tambah"><i class="icon-plus3"></i> Tambah Data</a>
        <h3 class="box-title pull-right">Data Tanaman</h3>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="data-tabel">
            <thead>
                <tr>
                    <th class="text-center" width="25px">No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th class="text-center" width="100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $sql = "SELECT * FROM tanaman";
                $result = mysqli_query($link, $sql);
                while ($d = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td><?= $d['kode_tanaman'] ?></td>
                        <td><?= $d['nama_tanaman'] ?></td>
                        <td class="text-center">
                            <a href="?page=tanaman&form=edit&kode=<?= $d['kode_tanaman'] ?>"><i class="icon-pencil7 text-green"></i></a>
                            <a href="?page=tanaman&form=hapus&kode=<?= $d['kode_tanaman'] ?>"><i class="icon-trash text-red"></i></a>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>