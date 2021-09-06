<?php
$tanaman = mysqli_query($link, "SELECT * FROM tanaman");
$kriteria = mysqli_query($link, "SELECT * FROM kriteria");
if ($level == 1) :
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Normalisasi Matrik</h3>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <?php foreach ($tanaman as $tn) { ?>
                        <th class="text-center" colspan="2"><?= $tn['nama_tanaman'] ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kriteria as $k) { ?>
                    <tr>
                        <?php foreach ($tanaman as $tn) {
                            $id_tanaman = $tn['kode_tanaman'];
                            $id_kriteria = $k['kode_kriteria'];
                            $result = mysqli_query($link, "SELECT * FROM nilai_tanaman WHERE kode_tanaman='$id_tanaman' AND kode_kriteria='$id_kriteria'");
                            $nilai = mysqli_fetch_assoc($result);
                            $zero = ($k['nilai_max'] - $k['nilai_min']);
                            $matrik = ($zero != 0) ? ($nilai['nilai_tanaman'] - $k['nilai_min']) / $zero : 0;
                            $nilai_bobot = $nilai == null ? 0 : $nilai['nilai_tanaman'];
                        ?>
                            <td><?= $k['nama_kriteria'] ?></td>
                            <td>= <?= $nilai_bobot . ' - ' . $k['nilai_min'] . ' / ' . $k['nilai_max'] . ' - ' . $k['nilai_min'] . ' = ' . $matrik ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <?php foreach ($tanaman as $tn) { ?>
                        <th colspan="2">Nama Tanaman : <?= $tn['nama_tanaman'] ?></th>
                    <?php } ?>
                </tr>
                <tr>
                    <th>Normalisasi Matrik Nilai</th>
                </tr>
                <tr>
                    <?php foreach ($tanaman as $tn2) {
                        $hitung_matrik = '';
                        $hitung_matrik1 = '';
                        $total_matrik = 0;
                    ?>
                        <td colspan="2">
                            <strong><?= $tn2['kode_tanaman'] ?></strong> =
                            <?php foreach ($kriteria as $k1) {
                                $id_tanaman1 = $tn2['kode_tanaman'];
                                $id_kriteria1 = $k1['kode_kriteria'];
                                $result = mysqli_query($link, "SELECT * FROM nilai_tanaman WHERE kode_tanaman='$id_tanaman1' AND kode_kriteria='$id_kriteria1'");
                                $nilai1 = mysqli_fetch_assoc($result);
                                $zero1 = ($k1['nilai_max'] - $k1['nilai_min']);
                                $nilai_bobot1 = $nilai1 == null ? 0 : $nilai1['nilai_tanaman'];
                                $matrik1 = ($zero1 != 0) ? ($nilai_bobot1 - $k1['nilai_min']) / $zero1 : 0;
                                $hitung_matrik .= '(' . $k1['bobot'] . ' * ' . $matrik1 . ') + ';
                                $hitung_matrik1 .= $k1['bobot'] * $matrik1 . ' + ';
                                $total_matrik = $total_matrik + ($k1['bobot'] * $matrik1);
                            ?>
                            <?php } ?>
                            <?= rtrim($hitung_matrik, ' + ') ?>
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=
                            <?= rtrim($hitung_matrik1, ' + ') ?>
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=
                            <?= $total_matrik ?>
                        </td>
                    <?php } ?>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php endif;
foreach ($tanaman as $tn2) {
    $hitung_matrik = '';
    $hitung_matrik1 = '';
    $total_matrik = 0;
    foreach ($kriteria as $k1) {
        $id_tanaman1 = $tn2['kode_tanaman'];
        $id_kriteria1 = $k1['kode_kriteria'];
        $result = mysqli_query($link, "SELECT * FROM nilai_tanaman WHERE kode_tanaman='$id_tanaman1' AND kode_kriteria='$id_kriteria1'");
        $nilai1 = mysqli_fetch_assoc($result);
        $zero1 = ($k1['nilai_max'] - $k1['nilai_min']);
        $nilai_bobot1 = $nilai1 == null ? 0 : $nilai1['nilai_tanaman'];
        $matrik1 = ($zero1 != 0) ? ($nilai_bobot1 - $k1['nilai_min']) / $zero1 : 0;
        $hitung_matrik .= '(' . $k1['bobot'] . ' * ' . $matrik1 . ') + ';
        $hitung_matrik1 .= $k1['bobot'] * $matrik1 . ' + ';
        $total_matrik = $total_matrik + ($k1['bobot'] * $matrik1);
    }
    $results[] = [
        'tanaman' => $tn2['nama_tanaman'],
        'nilai' => $total_matrik
    ];
} ?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Perhitungan Metode <i>Multi Attribute Utility Theory</i></h3>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center" width="100px">Rangking</th>
                    <th class="text-center">Nama Tanaman</th>
                    <th class="text-center" width="200px">Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                $columns = array_column($results, 'nilai');
                array_multisort($columns, SORT_DESC, $results);
                foreach ($results as $value) {
                    // $max = max($results);
                ?>
                    <tr>
                        <td class="text-center"><?= $i ?></td>
                        <td class="text-center"><?= $value['tanaman'] ?></td>
                        <td class="text-center"><?= $value['nilai'] ?></td>
                    </tr>
                <?php 
                // $keys = array_search($max, $results);    
                // unset($results[$keys]);
                // if(sizeof($results) >0)
                // if(!in_array($max,$results))
                    $i++;
            }?>
            </tbody>
        </table>
    </div>
</div>