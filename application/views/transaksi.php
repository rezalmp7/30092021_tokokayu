
        <div class="col-12 m-0 p-5" id="body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Proses Pembayaran</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Transaksi Selesai</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="table table-hover">
                        <?php
                        foreach ($transaksi as $a) {
                        ?>
                        <tr>
                            <td>
                                <b><?php echo $a['ref']; ?></b><br>
                                <b>Nama Penerima</b>: <?php echo $a['nama_penerima']; ?><br>
                                <b>No Hp</b>: <?php echo $a['no_hp_penerima']; ?>
                            </td>
                            <td>
                                <b>Metode Pembayaran</b>: <?php echo $a['metode']; ?><br>
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
                                <a href="<?php echo base_url(); ?>transaksi/detail?ref=<?php echo $a['ref']; ?>" class="btn btn-primary btn-sm"><span class="iconify" data-icon="icon-park-outline:doc-detail"></span></a>
                                <a target="_blank" href="<?php echo base_url(); ?>transaksi/cetak?ref=<?php echo $a['ref']; ?>" class="btn btn-primary btn-sm"><span class="iconify" data-icon="fluent:print-16-regular"></span></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <table class="table table-hover">
                        <?php
                        foreach ($transaksi_pembayaran as $b) {
                        ?>
                        <tr>
                            <td>
                                <b><?php echo $b['ref']; ?></b><br>
                                <b>Nama Penerima</b>: <?php echo $b['nama_penerima']; ?><br>
                                <b>No Hp</b>: <?php echo $b['no_hp_penerima']; ?>
                            </td>
                            <td>
                                <b>Metode Pembayaran</b>: <?php echo $b['metode']; ?><br>
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
                                <a href="<?php echo base_url(); ?>transaksi/detail?ref=<?php echo $b['ref']; ?>" class="btn btn-primary btn-sm"><span class="iconify" data-icon="icon-park-outline:doc-detail"></span></a>
                                <a href="<?php echo base_url(); ?>transaksi/cetak?ref=<?php echo $a['ref']; ?>" class="btn btn-primary btn-sm"><span class="iconify" data-icon="fluent:print-16-regular"></span></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <table class="table table-hover">
                        <?php
                        foreach ($transaksi_selesai as $a) {
                        ?>
                        <tr>
                            <td>
                                <b><?php echo $a['ref']; ?></b><br>
                                <b>Nama Penerima</b>: <?php echo $a['nama_penerima']; ?><br>
                                <b>No Hp</b>: <?php echo $a['no_hp_penerima']; ?>
                            </td>
                            <td>
                                <b>Metode Pembayaran</b>: <?php echo $a['metode']; ?><br>
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
                                <a href="<?php echo base_url(); ?>transaksi/detail?ref=<?php echo $a['ref']; ?>" class="btn btn-primary btn-sm"><span class="iconify" data-icon="icon-park-outline:doc-detail"></span></a>
                                <a href="<?php echo base_url(); ?>transaksi/cetak?ref=<?php echo $a['ref']; ?>" class="btn btn-primary btn-sm"><span class="iconify" data-icon="fluent:print-16-regular"></span></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>