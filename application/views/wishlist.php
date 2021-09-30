
        <div class="col-12 m-0 p-5" id="body">
            <div class="container col-12 m-0 p-0" id="daftar_produk">
                <div class="row">
                    <?php
                    foreach ($wishlist as $b) {
                    ?>
                    <div class="col-6 col-md-3 col-lg-2 p-0" id="produk">
                        <a href="<?php echo base_url(); ?>produk/detail?id=<?php echo $b['id_produk']; ?>" class="d-block col-12 m-0 p-0">
                            <div class="col-12 p-3">
                                <div class="col-12 bg_gambar_produk" style="height:200px; background-image: url('<?php echo base_url(); ?>assets/img/produk/<?php echo $b['foto']; ?>');">
                                </div>
                            </div>
                            <div class="col-12 p-3 text-center">
                                <h6 class="text-center"><?php echo $b['nama']; ?> <?php echo $b['kualitas']; ?></h6>
                            </div>
                        </a>
                        <div class="col-12 m-0 text-center">
                            <a href="<?php echo base_url(); ?>keranjang/hapus_wishlist?id=<?php echo $b['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>