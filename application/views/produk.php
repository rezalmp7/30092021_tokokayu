
        <div class="col-12 m-0 p-5" id="body">
            <div class="col-12 m-0 p-3" id="semua_produk">
                <h5>Daftar Produk</h5>
                <div class="col-12 m-0 p-0">
                    <form method="POST" action="#">
                        <div class="input-group mb-3 me-0">
                            <input type="text" class="form-control" id="cari_produk" name="search" placeholder="Cari Produk">
                        </div>
                    </form>
                </div>
                <div class="col-12 m-0 p-0 row" id="daftar_produk">
                    
                    <?php
                    foreach ($produk as $a) {
                    ?>
                    <div class="col-6 col-md-3 col-lg-2 p-0" id="produk">
                        <a href="<?php base_url(); ?>produk/detail?id=<?php echo $a['id']; ?>" class="d-block col-12 m-0 p-0">
                            <div class="col-12 p-3">
                                <div class="col-12 bg_gambar_produk"
                                    style="height:200px; background-image: url('<?php echo base_url(); ?>assets/img/produk/<?php echo $a['foto']; ?>');">
                                </div>
                            </div>
                            <div class="col-12 p-3 pt-0">
                                <small class="m-0 p-0col-12 d-block text-center">Rp <?php echo number_format($harga_produk['min'][$a['id']]['harga'],0,',','.'); ?> - Rp <?php echo number_format($harga_produk['max'][$a['id']]['harga'],0,',','.'); ?></small>
                                <h6 class="text-center"><?php echo $a['nama']; ?></h6>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>