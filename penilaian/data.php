<?php function nilai_kriteria($id=null,$nilai=null)
{
    if($id =='K-001'){
        if($nilai=='1'){
            $keterangan = 'Kurang Sesuai';
        }else if($nilai=='2'){
            $keterangan = 'Cukup Sesuai';
        }else if($nilai=='3'){
            $keterangan = 'Sangat Baik';
        }
    } else if($id =='K-002'){
        if($nilai=='1'){
            $keterangan = '26&deg; - 30&deg; C';
        }else if($nilai=='2'){
            $keterangan = '21&deg; - 25&deg; C';
        }else if($nilai=='3'){
            $keterangan = '15&deg; - 20&deg; C';
        }
    } else if($id =='K-003'){
        if($nilai=='1'){
            $keterangan = '301 mm - 400 mm';
        }else if($nilai=='2'){
            $keterangan = '201 mm - 300 mm';
        }else if($nilai=='3'){
            $keterangan = '151 mm - 200 mm';
        }
    } else if($id =='K-004'){
        if($nilai=='1'){
            $keterangan = '< 60%';
        }else if($nilai=='2'){
            $keterangan = '60% - 80%';
        }else if($nilai=='3'){
            $keterangan = '> 80%';
        }
    } else if($id =='K-005'){
        if($nilai=='1'){
            $keterangan = 'Kurang Lancar';
        }else if($nilai=='2'){
            $keterangan = 'Cukup';
        }else if($nilai=='3'){
            $keterangan = 'Lancar';
        }
    } else if($id =='K-006'){
        if($nilai=='1'){
            $keterangan = 'Rendah';
        }else if($nilai=='2'){
            $keterangan = 'Menengah';
        }else if($nilai=='3'){
            $keterangan = 'Tinggi';
        }
    }
    return $keterangan;
}?>
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
                    <th>Keterangan</th>
                    <th>Nilai</th>
                    <th class="text-center" width="100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $sql = "SELECT kode_nilai,nama_tanaman,kriteria.kode_kriteria AS idkriteria,nama_kriteria,nilai_tanaman FROM tanaman JOIN nilai_tanaman ON tanaman.kode_tanaman=nilai_tanaman.kode_tanaman
                JOIN kriteria ON kriteria.kode_kriteria=nilai_tanaman.kode_kriteria";
                $result = mysqli_query($link, $sql);
                while ($d = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td><?= $d['nama_tanaman'] ?></td>
                        <td><?= $d['nama_kriteria'] ?></td>
                        <td><?= nilai_kriteria($d['idkriteria'],$d['nilai_tanaman'])?></td>
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