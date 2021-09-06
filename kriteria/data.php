<div class="box box-default">
    <div class="box-header with-border">
        <!-- <a class="btn btn-social btn-flat btn-success btn-sm" href="?page=kriteria&form=tambah_kriteria"><i class="icon-plus3"></i> Tambah Kriteria</a> -->
        <!-- <a class="btn btn-social btn-flat bg-purple btn-sm" href="?page=kriteria&form=tambah_kriteria_nilai"><i class="icon-plus3"></i> Tambah Nilai Kriteria</a> -->
        <h3 class="box-title">Data Kriteria</h3>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="data-tabel">
            <thead>
                <tr>
                    <th class="text-center" width="25px">No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th class="text-right">Minimum</th>
                    <th class="text-right">Maximum</th>
                    <th class="text-right">Bobot</th>
                    <th class="text-center" width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $sql = "SELECT * FROM kriteria";
                $result = mysqli_query($link, $sql);
                while ($d = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td><?= $d['kode_kriteria'] ?></td>
                        <td><?= $d['nama_kriteria'] ?></td>
                        <td class="text-right"><?= $d['nilai_min'] ?></td>
                        <td class="text-right"><?= $d['nilai_max'] ?></td>
                        <td class="text-right"><?= $d['bobot'] ?></td>
                        <td class="text-center">
                            <a href="?page=kriteria&form=edit_kriteria&kode=<?= $d['kode_kriteria'] ?>"><i class="icon-pencil7 text-green"></i></a>
                            <!-- <a href="?page=kriteria&form=hapus_kriteria&kode=$d['kode_kriteria']"><i class="icon-trash text-red"></i></a> -->
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>