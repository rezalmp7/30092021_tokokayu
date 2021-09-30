                
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Data User
                        </div>
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Hasil Perhitungan</button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Kriteria</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <?php
                                    // --  Pengambilan Nilai Kriteria
                                    //-- menyiapkan variable penampung berupa array
                                    $kriteria=array();
                                    $bobot=array();
                                    //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
                                    foreach ($wp_criterias as $row) {
                                        $kriteria[$row['id_criteria']]=array($row['criteria'],$row['attribute']);
                                        $bobot[$row['id_criteria']]=$row['weight']/100;
                                    }

                                    //  --  Pengambilan Nilai Alternatif
                                    //-- menyiapkan variable penampung berupa array
                                    $alternatif=array();
                                    //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
                                    foreach ($alternative as $row) {
                                        $alternatif[$row['id']]=$row['nama'];
                                    }

                                    // -- Pengambilan Nilai Penilaian
                                    //-- menyiapkan variable penampung berupa array
                                    $sample=array();
                                    //-- melakukan iterasi pengisian array untuk tiap record data yang didapat
                                    foreach ($wp_evaluations_order_by as $row) {
                                        //-- jika array $sample[$row['id_alternatif']] belum ada maka buat baru
                                        //-- $row['id_alternatif'] adalah id kandidat/alternatif
                                        if (!isset($sample[$row['id_alternative']])) {
                                            $sample[$row['id_alternative']] = array();
                                        }
                                        $sample[$row['id_alternative']][$row['id_criteria']] = $row['value'];
                                    }

                                    // -- Membuat Matrik Keputusan (X)
                                    ?>
                                    <h3 class="mt-4">Point Table</h3>
                                    <table class="table table-bordered">
                                        <tr>
                                            <?php
                                            foreach ($wp_criterias as $a) {
                                                echo "<th>".$a['criteria']."</th>";
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                    //-- menjadikan data $sample sebagai matrik keputusan $X
                                    $X=$sample;
                                    //-- melakukan iterasi utk setiap alternatif
                                    foreach ($X as $id_alternatif=>$a_kriteria) {
                                        echo "<tr>";
                                        //-- melakukan iterasi utk setiap kriteria
                                        foreach($a_kriteria as $id_kriteria=>$nilai){
                                            echo "<td>{$nilai}</td>";
                                        }
                                        echo "</tr>";
                                    }
                                    ?>
                                    </table>
                                    <?php
                                    // -- Membuat Matrik Normalisasi (R)
                                    //-- inisialisasi array pembagi
                                    $pembagi=array();
                                    //-- melakukan iterasi utk setiap kriteria
                                    foreach($kriteria as $id_kriteria=>$value){
                                        $pembagi[$id_kriteria]=0;
                                        //-- melakukan iterasi utk setiap alternatif
                                        foreach($alternatif as $id_alternatif=>$a_value){
                                            $pembagi[$id_kriteria]=pow($X[$id_alternatif][$id_kriteria],2);
                                        }
                                    }
                                    //-- inisialisasi matrik Normalisasi R
                                    $R=array();
                                    //-- melakukan iterasi utk setiap alternatif
                                    foreach($X as $id_alternatif=>$a_kriteria) {
                                        $R[$id_alternatif]=array();
                                        //-- melakukan iterasi utk setiap kriteria
                                        foreach($a_kriteria as $id_kriteria=>$nilai){
                                            $R[$id_alternatif][$id_kriteria]= ($nilai ?: 1)/(sqrt($pembagi[$id_kriteria]) ?: 1);
                                        }
                                    }

                                    // -- Membuat Matrik Normalisasi Terbobot (Y)
                                    //-- inisialisasi matrik Normalisasi Terbobot Y
                                    $Y=array();
                                    //-- melakukan iterasi utk setiap alternatif
                                    foreach($R as $id_alternatif=>$a_kriteria) {
                                        $Y[$id_alternatif]=array();
                                        //-- melakukan iterasi utk setiap kriteria
                                        foreach($a_kriteria as $id_kriteria=>$nilai){
                                            $Y[$id_alternatif][$id_kriteria] = $nilai * $bobot[$id_kriteria];
                                        }
                                    }   
                                    
                                    // -- Perhitungan Solusi Ideal (A)
                                    //-- inisialisasi Solusi Ideal A Positif dan Negatif 
                                    $A_max=$A_min=array();
                                    //-- melakukan iterasi utk setiap kriteria
                                    foreach($kriteria as $id_kriteria=>$a_kriteria) {
                                        $A_max[$id_kriteria]=0;
                                        $A_min[$id_kriteria]=100;
                                        //-- melakukan iterasi utk setiap alternatif
                                        foreach($alternatif as $id_alternatif=>$nilai){
                                            if($A_max[$id_kriteria]<$Y[$id_alternatif][$id_kriteria]){
                                                $A_max[$id_kriteria] = $Y[$id_alternatif][$id_kriteria];
                                            }
                                            if($A_min[$id_kriteria]>$Y[$id_alternatif][$id_kriteria]){
                                                $A_min[$id_kriteria] = $Y[$id_alternatif][$id_kriteria];
                                            };
                                        }
                                    }   
                                    
                                    // -- Perhitungan Jarak Solusi Ideal (D)
                                    //-- inisialisasi Jarak Solusi Ideal Positif/Negatif
                                    $D_plus=$D_min=array();
                                    //-- melakukan iterasi utk setiap alternatif
                                    foreach($Y as $id_alternatif=>$n_a){
                                        $D_plus[$id_alternatif]=0;
                                        $D_min[$id_alternatif]=0;
                                        //-- melakukan iterasi utk setiap kriteria
                                        foreach($n_a as $id_kriteria=>$y){
                                            $D_plus[$id_alternatif]+=pow($y-$A_max[$id_kriteria],2);
                                            $D_min[$id_alternatif]+=pow($y-$A_min[$id_kriteria],2);
                                        }
                                        $D_plus[$id_alternatif]=sqrt($D_plus[$id_alternatif]);
                                        $D_min[$id_alternatif]=sqrt($D_min[$id_alternatif]);
                                    }

                                    //-- inisialisasi variabel array V 
                                    $V=array();
                                    //-- melakukan iterasi utk setiap alternatif
                                    foreach($D_min as $id_alternatif=>$d_min){
                                        //-- perhitungan nilai Preferensi V dari nilai jarak solusi ideal D
                                        if($D_plus[$id_alternatif] != 0)
                                        {
                                            $DevisionZero = true;
                                            $V[$id_alternatif] = $d_min/($d_min + $D_plus[$id_alternatif]);
                                        }
                                        else {
                                            $DevisionZero = false;
                                        }

                                    }

                                    if($DevisionZero == true)
                                    {
                                        // PERANKINGAN
                                        //--mengurutkan data secara descending dengan tetap mempertahankan key/index array-nya
                                        arsort($V);
                                        //-- mendapatkan key/index item array yang pertama
                                        $index=key($V);
                                        //-- menampilkan hasil akhir:
                                        
                                        ?>
                                        <h3 class="mt-4">Hasil Perankingan / Produk Terfavorit</h3>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Total Poin</th>
                                            </tr>
                                            <?php
                                            $i = 1 ;
                                            foreach ($alternatif as $a) {
                                                echo "<tr>";
                                                echo "<td>".$alternatif[$i]."</td>";
                                                echo "<td>".$V[$i]."</td>";
                                                echo "</tr>";
                                                $i++;
                                            }
                                            ?>
                                        </table>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    Data ada yang bertotal 0 Proses tidak bisa diteruskan
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="tab-pane fade p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <form method="POST" action="<?php echo base_url(); ?>admin/terfavorit/criteria_edit_aksi">
                                        <table id="datatables" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Kriteria</th>
                                                    <th>Bobot</th>
                                                    <th>Atribut</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($wp_criterias as $a) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $a['criteria']; ?></td>
                                                    <td>
                                                        <input type="hidden" name="id[]" value="<?php echo $a['id_criteria']; ?>">
                                                        <input class="form-control" name="weight[]" type="text" value="<?php echo $a['weight']; ?>">
                                                    </td>
                                                    <td>
                                                        <select class="form-select" name="attribute[]" aria-label="Default select example">
                                                            <option selected>Pilih Atribut</option>
                                                            <option value="benefit" <?php if($a['attribute'] == 'benefit') echo "selected"; ?>>Benefit</option>
                                                            <option value="cost" <?php if($a['attribute'] == 'cost') echo "selected"; ?>>Cost</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <?php
                                                $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <input type="submit" class="btn btn-warning" value="update">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>