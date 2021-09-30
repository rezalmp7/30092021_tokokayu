
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Data Pesanan
                        </div>
                        <div class="card-body row">
                            <div class="col-md-8 m-0 p-3" id="semua_produk">
                                <h3>Cara Pembayaran</h3>
                                <div class="col-12 m-0 p-0">
                                    <?php
                                    foreach($pembayaran->instructions as $a) {
                                    ?>
                                    <h5><?php echo $a->title; ?></h5>
                                    <div>
                                        <ul>
                                        <?php
                                        foreach ($a->steps as $b) {
                                            echo '<li>'.$b.'</li>';
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4 pt-5">
                                <div class="card card-default col-12">
                                    <div class="card-body">
                                        <h5 class="card-title">Alamat</h5>
                                        <table class="table table-hover table-condensed">
                                            <tbody>
                                                <?php
                                                $total_harga = 0;
                                                foreach ($pesanan as $a) {
                                                ?>
                                                <tr>
                                                    <td data-th="Product">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <h6 class="nomargin"><?php echo $a['nama'].' '.$a['ukuran']; ?></h6>
                                                                <small>Rp. <?php echo number_format($a['harga'],0,',','.'); ?></small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td data-th="Quantity">
                                                        <?php echo $a['qty']; ?>
                                                    </td>
                                                    <?php
                                                    $sub_total = $a['harga']*$a['qty'];
                                                    ?>
                                                    <td data-th="Subtotal" class="text-end">Rp. <?php echo number_format($sub_total,0,',','.'); ?></td>
                                                </tr>
                                                <?php 
                                                $total_harga = $total_harga+$sub_total;
                                                }
                                                ?>
                                                    
                                                <tr>
                                                    <td colspan="2"><b>Total Harga</b></td>
                                                    <td class="text-end">Rp <?php echo number_format($total_harga,0,',','.'); ?></td>
                                            </tbody>
                                        </table>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Nama : </label>
                                            <?php echo $transaksi['nama_penerima']; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">No HP : </label>
                                            <?php echo $transaksi['no_hp_penerima']; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Wilayah Alamat : </label>
                                            <?php echo $ongkir['nama'].' (Rp '.number_format($ongkir['biaya']).')'; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Alamat : </label>
                                            <?php echo $transaksi['alamat']; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Metode Pembayaran : </label>
                                            <?php echo $pembayaran->payment_name; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Admin : </label>
                                            Rp <?php echo number_format($pembayaran->total_fee,0,',','.'); ?>
                                        </div>
                                        <table class="table table-hover table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td colspan="3"></td>
                                                </tr>
                                                <?php $harga_dibayar = $total_harga+$ongkir['biaya']+$pembayaran->total_fee; ?>
                                                <?php $amount = $total_harga+$ongkir['biaya']; ?>
                                                <tr>
                                                    <td colspan="2"><b>Harga yang harus dibayar</b></td>
                                                    <td class="text-end">Rp <?php echo number_format($harga_dibayar,0,',','.'); ?></td>
                                            </tbody>
                                        </table>
                                        <div class="col-12 mt-2 p-0">
                                            <?php
                                            if($transaksi['status'] == '2')
                                            {
                                            ?>
                                            <a href="#" class="btn btn-success btn-sm">Kirim Barang</a>
                                            <?php
                                            }
                                            if($transaksi['status'] == '3')
                                            {
                                            ?>
                                            <a href="#" class="btn btn-success btn-sm">Selesai</a>
                                            <a href="#" class="btn btn-success btn-sm">Kembali</a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>