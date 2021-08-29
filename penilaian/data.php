<div class="box box-default">
    <div class="box-header with-border">
        <a class="btn btn-social btn-flat btn-success btn-sm" href="?page=penilaian&form=tambah"><i class="icon-plus3"></i> Tambah Data</a>
        <h3 class="box-title pull-right">Penilaian Kriteria</h3>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped" id="data-tabel">
            <thead>
                <tr>
                    <th class="text-center" width="25px">No</th>
                    <th>Tanaman</th>
                    <th>Kriteria</th>
                    <th>Nilai</th>
                    <th class="text-center" width="100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $sql = "SELECT kode_nilai,nama_tanaman,nama_kriteria,nilai_tanaman FROM tanaman JOIN nilai_tanaman ON tanaman.kode_tanaman=nilai_tanaman.kode_tanaman
                JOIN kriteria ON kriteria.kode_kriteria=nilai_tanaman.kode_kriteria";
                $result = mysqli_query($link, $sql);
                while ($d = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td><?= $d['nama_tanaman'] ?></td>
                        <td><?= $d['nama_kriteria'] ?></td>
                        <td><?= $d['nilai_tanaman'] ?></td>
                        <td class="text-center">
                            <a href="?page=penilaian&form=edit&kode=<?= $d['kode_nilai'] ?>"><i class="icon-pencil7 text-green"></i></a>
                            <a href="?page=penilaian&form=hapus&kode=<?= $d['kode_nilai'] ?>"><i class="icon-trash text-red"></i></a>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>