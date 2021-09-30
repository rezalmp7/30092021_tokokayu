
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Data Pelanggan
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-bayar" type="button" role="tab" aria-controls="pills-bayar" aria-selected="false">Proses Pembayaran</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-kirim" type="button" role="tab" aria-controls="pills-kirim" aria-selected="false">Proses Pengiriman</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-selesai" type="button" role="tab" aria-controls="pills-selesai" aria-selected="false">Transaksi Selesai</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                                    <table class="table table-hover">
                                        <?php
                                        foreach ($transaksi as $a) {
                                        ?>
                                        <tr>
                                            <td>
                                                <small><?php echo date('d F Y', strtotime($a['checkout_at'])); ?></small><br>
                                                <b><?php echo $a['ref']; ?></b><br>
                                                <b>Nama Penerima</b>: <?php echo $a['nama_penerima']; ?>
                                            </td>
                                            <td>
                                                <b>Metode Pembayaran</b>: <?php echo $a['metode']; ?><br>
                                                <b>No Hp</b>: <?php echo $a['no_hp_penerima']; ?><br>
                                                <b>Alamat</b>: <?php echo $a['alamat']; ?>
                                            </td>
                                            <td>Rp. <?php echo number_format($a['harga_akhir'],0,',','.'); ?></td>
                                            <td>
                                                <?php
                                                switch ($a['status']) {
                                                    case 0:
                                                        echo "Cancel";
                                                        break;
                                                    case 1:
                                                        echo "Menunggu Pembayaran";
                                                        break;
                                                    case 2:
                                                        echo "Pembayaran Terkonfirmasi";
                                                        break;
                                                    case 3:
                                                        echo "Pengiriman";
                                                        break;
                                                    case 4:
                                                        echo "Selesai";
                                                        break;
                                                    case 5:
                                                        echo "Return";
                                                        break;
                                                    case 6:
                                                        echo "Pembayaran Kadaluarsa";
                                                        break;    
                                                    case 7:
                                                        echo "Pembayaran Gagal";
                                                        break; 
                                                    case 8:
                                                        echo "Pembayaran Tidak Selesai";
                                                        break;                                 
                                                    default:
                                                        echo "Error Status";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($a['status'] == '2')
                                                {
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/aksi?id=<?php echo $a['id']; ?>&status=3" class="btn btn-success btn-sm">Kirim Barang</a>
                                                <?php
                                                }
                                                if($a['status'] == '3')
                                                {
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/aksi?id=<?php echo $a['id']; ?>&status=4" class="btn btn-success btn-sm">Selesai</a>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/aksi?id=<?php echo $a['id']; ?>&status=5" class="btn btn-danger btn-sm">Return</a>
                                                <?php
                                                }
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/detail?ref=<?php echo $a['ref']; ?>" class="btn btn-primary btn-sm"><span class="iconify" data-icon="bx:bx-detail"></span></a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="pills-bayar" role="tabpanel" aria-labelledby="pills-bayar-tab">
                                    <table class="table table-hover">
                                        <?php
                                        foreach ($transaksi_pembayaran as $b) {
                                        ?>
                                        <tr>
                                            <td>
                                                <small><?php echo date('d F Y', strtotime($b['checkout_at'])); ?></small><br>
                                                <b><?php echo $b['ref']; ?></b><br>
                                                <b>Nama Penerima</b>: <?php echo $b['nama_penerima']; ?>
                                            </td>
                                            <td>
                                                <b>Metode Pembayaran</b>: <?php echo $b['metode']; ?><br>
                                                <b>No Hp</b>: <?php echo $b['no_hp_penerima']; ?><br>
                                                <b>Alamat</b>: <?php echo $b['alamat']; ?>
                                            </td>
                                            <td>Rp. <?php echo number_format($b['harga_akhir'],0,',','.'); ?></td>
                                            <td>
                                                <?php
                                                switch ($b['status']) {
                                                    case 0:
                                                        echo "Cancel";
                                                        break;
                                                    case 1:
                                                        echo "Menunggu Pembayaran";
                                                        break;
                                                    case 2:
                                                        echo "Pembayaran Terkonfirmasi";
                                                        break;
                                                    case 3:
                                                        echo "Pengiriman";
                                                        break;
                                                    case 4:
                                                        echo "Selesai";
                                                        break;
                                                    case 5:
                                                        echo "Return";
                                                        break;
                                                    case 6:
                                                        echo "Pembayaran Kadaluarsa";
                                                        break;    
                                                    case 7:
                                                        echo "Pembayaran Gagal";
                                                        break; 
                                                    case 8:
                                                        echo "Pembayaran Tidak Selesai";
                                                        break;                                 
                                                    default:
                                                        echo "Error Status";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($a['status'] == '2')
                                                {
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/aksi?id=<?php echo $a['id']; ?>&status=3" class="btn btn-success btn-sm">Kirim Barang</a>
                                                <?php
                                                }
                                                if($a['status'] == '3')
                                                {
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/aksi?id=<?php echo $a['id']; ?>&status=4" class="btn btn-success btn-sm">Selesai</a>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/aksi?id=<?php echo $a['id']; ?>&status=5" class="btn btn-danger btn-sm">Return</a>
                                                <?php
                                                }
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/detail?ref=<?php echo $b['ref']; ?>" class="btn btn-primary btn-sm"><span class="iconify" data-icon="bx:bx-detail"></span></a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="pills-kirim" role="tabpanel" aria-labelledby="pills-kirim-tab">
                                    <table class="table table-hover">
                                        <?php
                                        foreach ($transaksi_kirim as $a) {
                                        ?>
                                        <tr>
                                            <td>
                                                <small><?php echo date('d F Y', strtotime($a['checkout_at'])); ?></small><br>
                                                <b><?php echo $a['ref']; ?></b><br>
                                                <b>Nama Penerima</b>: <?php echo $a['nama_penerima']; ?>
                                            </td>
                                            <td>
                                                <b>Metode Pembayaran</b>: <?php echo $a['metode']; ?><br>
                                                <b>No Hp</b>: <?php echo $a['no_hp_penerima']; ?><br>
                                                <b>Alamat</b>: <?php echo $a['alamat']; ?>
                                            </td>
                                            <td>Rp. <?php echo number_format($a['harga_akhir'],0,',','.'); ?></td>
                                            <td>
                                                <?php
                                                switch ($a['status']) {
                                                    case 0:
                                                        echo "Cancel";
                                                        break;
                                                    case 1:
                                                        echo "Menunggu Pembayaran";
                                                        break;
                                                    case 2:
                                                        echo "Pembayaran Terkonfirmasi";
                                                        break;
                                                    case 3:
                                                        echo "Pengiriman";
                                                        break;
                                                    case 4:
                                                        echo "Selesai";
                                                        break;
                                                    case 5:
                                                        echo "Return";
                                                        break;
                                                    case 6:
                                                        echo "Pembayaran Kadaluarsa";
                                                        break;    
                                                    case 7:
                                                        echo "Pembayaran Gagal";
                                                        break; 
                                                    case 8:
                                                        echo "Pembayaran Tidak Selesai";
                                                        break;                                 
                                                    default:
                                                        echo "Error Status";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($a['status'] == '2')
                                                {
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/aksi?id=<?php echo $a['id']; ?>&status=3" class="btn btn-success btn-sm">Kirim Barang</a>
                                                <?php
                                                }
                                                if($a['status'] == '3')
                                                {
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/aksi?id=<?php echo $a['id']; ?>&status=4" class="btn btn-success btn-sm">Selesai</a>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/aksi?id=<?php echo $a['id']; ?>&status=5" class="btn btn-danger btn-sm">Return</a>
                                                <?php
                                                }
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/detail?ref=<?php echo $a['ref']; ?>" class="btn btn-primary btn-sm"><span class="iconify" data-icon="bx:bx-detail"></span></a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="pills-selesai" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    <table class="table table-hover">
                                        <?php
                                        foreach ($transaksi_selesai as $a) {
                                        ?>
                                        <tr>
                                            <td>
                                                <small><?php echo date('d F Y', strtotime($a['checkout_at'])); ?></small><br>
                                                <b><?php echo $a['ref']; ?></b><br>
                                                <b>Nama Penerima</b>: <?php echo $a['nama_penerima']; ?>
                                            </td>
                                            <td>
                                                <b>Metode Pembayaran</b>: <?php echo $a['metode']; ?><br>
                                                <b>No Hp</b>: <?php echo $a['no_hp_penerima']; ?><br>
                                                <b>Alamat</b>: <?php echo $a['alamat']; ?>
                                            </td>
                                            <td>Rp. <?php echo number_format($a['harga_akhir'],0,',','.'); ?></td>
                                            <td>
                                                <?php
                                                switch ($a['status']) {
                                                    case 0:
                                                        echo "Cancel";
                                                        break;
                                                    case 1:
                                                        echo "Menunggu Pembayaran";
                                                        break;
                                                    case 2:
                                                        echo "Pembayaran Terkonfirmasi";
                                                        break;
                                                    case 3:
                                                        echo "Pengiriman";
                                                        break;
                                                    case 4:
                                                        echo "Selesai";
                                                        break;
                                                    case 5:
                                                        echo "Return";
                                                        break;
                                                    case 6:
                                                        echo "Pembayaran Kadaluarsa";
                                                        break;    
                                                    case 7:
                                                        echo "Pembayaran Gagal";
                                                        break; 
                                                    case 8:
                                                        echo "Pembayaran Tidak Selesai";
                                                        break;                                 
                                                    default:
                                                        echo "Error Status";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($a['status'] == '2')
                                                {
                                                ?>
                                                <a href="#" class="btn btn-success btn-sm">Kirim Barang</a>
                                                <?php
                                                }
                                                if($a['status'] == '3')
                                                {
                                                ?>
                                                <a href="#" class="btn btn-success btn-sm">Selesai</a>
                                                <a href="#" class="btn btn-danger btn-sm">Return</a>
                                                <?php
                                                }
                                                ?>
                                                <a href="<?php echo base_url(); ?>admin/pesanan/detail?ref=<?php echo $a['ref']; ?>" class="btn btn-primary btn-sm"><span class="iconify" data-icon="bx:bx-detail"></span></a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>