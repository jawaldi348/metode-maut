<?php $idkriteria = $_GET['idkriteria'];?>
<div class="form-group">
    <label>Nilai Kriteria</label><br>
    <?php if($idkriteria =='K-001'){?>
        <input type="radio" name="nilai" id="nilai" value="1"> Kurang Sesuai<br>
        <input type="radio" name="nilai" id="nilai" value="2"> Cukup Sesuai<br>
        <input type="radio" name="nilai" id="nilai" value="3"> Sangat Baik<br>
    <?php } else if($idkriteria =='K-002'){?>
        <input type="radio" name="nilai" id="nilai" value="1"> 26&deg; - 30&deg; C<br>
        <input type="radio" name="nilai" id="nilai" value="2"> 21&deg; - 25&deg; C<br>
        <input type="radio" name="nilai" id="nilai" value="3"> 15&deg; - 20&deg; C<br>
    <?php } else if($idkriteria =='K-003'){?>
        <input type="radio" name="nilai" id="nilai" value="1"> 301 mm - 400 mm<br>
        <input type="radio" name="nilai" id="nilai" value="2"> 201 mm - 300 mm<br>
        <input type="radio" name="nilai" id="nilai" value="3"> 151 mm - 200 mm<br>
    <?php } else if($idkriteria =='K-004'){?>
        <input type="radio" name="nilai" id="nilai" value="1"> < 60%<br>
        <input type="radio" name="nilai" id="nilai" value="2"> 60% - 80%<br>
        <input type="radio" name="nilai" id="nilai" value="3"> > 80%<br>
    <?php } else if($idkriteria =='K-005'){?>
        <input type="radio" name="nilai" id="nilai" value="1"> Kurang Lancar<br>
        <input type="radio" name="nilai" id="nilai" value="2"> Cukup<br>
        <input type="radio" name="nilai" id="nilai" value="3"> Lancar<br>
    <?php } else if($idkriteria =='K-006'){?>
        <input type="radio" name="nilai" id="nilai" value="1"> Rendah<br>
        <input type="radio" name="nilai" id="nilai" value="2"> Menengah<br>
        <input type="radio" name="nilai" id="nilai" value="3"> Tinggi<br>
    <?php }?>
</div>