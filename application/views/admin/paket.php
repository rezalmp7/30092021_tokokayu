
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Data Paket
                        </div>
                        <div class="card-body">
                            <div class="clearfix text-end">
                                <a href="<?php echo base_url(); ?>admin/paket/tambah" class="btn btn-success btn-sm"><span class="iconify" data-icon="akar-icons:plus" data-inline="false"></span> Tambah Paket</a>
                            </div>
                            <table id="datatables" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Produk (Stok)</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($paket as $a) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $a['nama']; ?></td>
                                        <td>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><a href="<?php echo base_url(); ?>admin/paket/list_tambah?id_pkt=<?php echo $a['id']; ?>" class="btn btn-success btn-sm"><span class="iconify" data-icon="akar-icons:plus" data-inline="false"></span> Tambah Produk</a></li>
                                                <?php
                                                $id_pkt = $a['id'];
                                                foreach ($list_pkt[$id_pkt] as $b) {
                                                ?>
                                                <li class="list-group-item"><?php echo $b['ukuran']; ?>(<?php echo $b['stock']; ?>) <a href="<?php echo base_url(); ?>admin/paket/list_edit?id=<?php echo $b['id']; ?>&id_produk=<?php echo $b['id_produk']; ?>" class="btn btn-warning btn-sm"><span class="iconify" data-icon="akar-icons:edit" data-inline="false"></span></a>
                                                    <a href="<?php echo base_url(); ?>admin/paket/list_hapus?id=<?php echo $a['id']; ?>" class="btn btn-danger btn-sm"><span class="iconify" data-icon="akar-icons:trash-can" data-inline="false"></span></a></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </td>
                                        <td>Rp <?php echo number_format($a['harga'],0,',','.'); ?></td>
                                        <td><img style="height: 100px" src="<?php echo base_url(); ?>assets/img/produk/<?php echo $a['foto']; ?>"></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>admin/paket/edit?id=<?php echo $a['id']; ?>" class="btn btn-warning btn-sm"><span class="iconify" data-icon="akar-icons:edit" data-inline="false"></span></a>
                                            <a href="<?php echo base_url(); ?>admin/paket/hapus?id=<?php echo $a['id']; ?>" class="btn btn-danger btn-sm"><span class="iconify" data-icon="akar-icons:trash-can" data-inline="false"></span></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>