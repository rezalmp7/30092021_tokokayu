
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Data Pelanggan
                        </div>
                        <div class="card-body">
                            <div class="clearfix text-end">
                                <a href="<?php echo base_url(); ?>admin/produk/tambah" class="btn btn-success btn-sm"><span class="iconify" data-icon="akar-icons:plus" data-inline="false"></span> Tambah Produk</a>
                            </div>
                            <table id="datatables" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Ukuran(Stok) Harga</th>
                                        <th>Kualitas</th>
                                        <th>Foto</th>
                                        <th>Rating</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($produk as $a) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $a['nama']; ?></td>
                                        <td>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><a href="<?php echo base_url(); ?>admin/produk/tambah_ukuran?id_pr=<?php echo $a['id']; ?>" class="btn btn-success btn-sm"><span class="iconify" data-icon="akar-icons:plus" data-inline="false"></span> Tambah Ukuran</a></li>
                                                <?php
                                                $id_prd = $a['id'];
                                                foreach ($ukuran[$id_prd] as $b) {
                                                ?>
                                                <li class="list-group-item"><?php echo $b['ukuran']; ?>(<?php echo $b['stock']; ?>) Rp.<?php echo number_format($b['harga'],0,',','.'); ?> <a href="<?php echo base_url(); ?>admin/produk/edit_ukuran?id=<?php echo $b['id']; ?>&id_pr=<?php echo $a['id']; ?>" class="btn btn-warning btn-sm"><span class="iconify" data-icon="akar-icons:edit" data-inline="false"></span></a>
                                                    <a href="<?php echo base_url(); ?>admin/produk/hapus_ukuran?id=<?php echo $a['id']; ?>" class="btn btn-danger btn-sm"><span class="iconify" data-icon="akar-icons:trash-can" data-inline="false"></span></a></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </td>
                                        <td><?php echo $a['kualitas']; ?></td>
                                        <td><img style="height: 100px" src="<?php echo base_url(); ?>assets/img/produk/<?php echo $a['foto']; ?>"></td>
                                        <td><?php echo $a['kualitas']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>admin/produk/comment?id=<?php echo $a['id']; ?>" class="btn btn-primary btn-sm"><span class="iconify" data-icon="ic:baseline-rate-review"></span></a>
                                            <a href="<?php echo base_url(); ?>admin/produk/edit?id=<?php echo $a['id']; ?>" class="btn btn-warning btn-sm"><span class="iconify" data-icon="akar-icons:edit" data-inline="false"></span></a>
                                            <a href="<?php echo base_url(); ?>admin/produk/hapus?id=<?php echo $a['id']; ?>" class="btn btn-danger btn-sm"><span class="iconify" data-icon="akar-icons:trash-can" data-inline="false"></span></a>
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