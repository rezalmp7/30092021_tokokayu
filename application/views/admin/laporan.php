
                <div class="col-12 m-0 p-5" id="content">
                    <div class="col-12 m-0 pt-3 pb-3">
                        <a target="_blank" href="<?php echo base_url(); ?>admin/laporan/cetak" class="btn btn-success btn-sm"><span class="iconify" data-icon="bytesize:print"></span> Cetak</a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Laporan Transaksi
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Info Penerima</th>
                                    <th>Info Pesanan</th>
                                    <th>Harga Akhir</th>
                                    <th>Daftar Produk</th>
                                <?php
                                $i = 1;
                                foreach ($transaksi as $a) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <b><?php echo $a['ref']; ?></b><br>
                                        <b>Nama Penerima</b>: <?php echo $a['nama_penerima']; ?><br>
                                    </td>
                                    <td>
                                        <b>Metode Pembayaran</b>: <?php echo $a['metode']; ?><br>
                                        <b>No Hp</b>: <?php echo $a['no_hp_penerima']; ?><br>
                                        <b>Alamat</b>: <?php echo $a['alamat']; ?>
                                    </td>
                                    <td>Rp. <?php echo number_format($a['harga_akhir'],0,',','.'); ?></td>
                                    <td>
                                        <ul class="list-group list-group-flush">
                                            <?php
                                            foreach ($pesanan[$a['id']] as $b) {
                                            ?>
                                            <li class="list-group-item"><?php echo $b['nama']; ?> <?php echo $b['ukuran']; ?></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>