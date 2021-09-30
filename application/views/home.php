
        <div class="col-12 m-0 p-3" id="body">
            <div class="col-12 m-0 p-0 row" id="top">
                <div class="col-lg-4 m-0 p-3 pt-0" id="rekomendasi">
                    <h4>Terfavorit</h4>
                    <div id="carouselExampleCaptions" class="carousel slide carousel-dark" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php
                            $count_terfavorit = count($terfavorit_produk);
                            ?>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                            <?php
                            $count_terfavorit = $count_terfavorit-1;
                            $o = 1;
                            for ($i=0; $i < $count_terfavorit; $i++) { 
                            ?>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $o; ?>"
                                aria-label="Slide 2"></button>
                            <?php
                            $o++;
                            }
                            ?>
                        </div>
                        <div class="carousel-inner">
                            <?php
                            $i = 0;
                            foreach ($terfavorit_produk as $a) {
                            ?>
                            <div class="carousel-item <?php if($i==0) echo 'active'; ?>">
                                <div class="col-12 bg_gambar_produk" style="height: 500px; background-image: url('<?php echo base_url(); ?>assets/img/produk/<?php echo $a['foto']; ?>');" class="d-block w-100"></div>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><?php echo $a['nama']; ?></h5>
                                </div>
                            </div>
                            <?php
                            $i++;
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-8 d-none d-lg-block p-2 m-0">
                    <div class="container col-12 m-0 p-0" id="daftar_produk">
                        <div class="row">
                            <?php
                            foreach ($produk as $b) {
                            ?>
                            <div class="col-6 col-md-3 col-lg-3 p-0" id="produk">
                                <a href="<?php echo base_url(); ?>produk/detail?id=<?php echo $b['id']; ?>" class="d-block col-12 m-0 p-0">
                                    <div class="col-12 p-3">
                                        <div class="col-12 bg_gambar_produk" style="height:200px; background-image: url('<?php echo base_url(); ?>assets/img/produk/<?php echo $b['foto']; ?>');">
                                        </div>
                                    </div>
                                    <div class="col-12 p-3 pt-0">
                                        <small class="col-12 d-block p-0 m-0 text-center">Rp <?php echo number_format($harga_produk['min'][$b['id']]['harga'],0,',','.'); ?> - Rp <?php echo number_format($harga_produk['max'][$b['id']]['harga'],0,',','.'); ?> </small>
                                        <h6 class="text-center"><?php echo $b['nama']; ?> <?php echo $b['kualitas']; ?></h6>
                                    </div>
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 m-0 p-3" id="semua_produk">
                <h5>Produk Terbaru</h5>
                <div class="col-12 m-0 p-0 row">
                    <?php
                    foreach ($produk_terbaru as $c) {
                    ?>
                    <div class="col-6 col-md-3 col-lg-2 p-0" id="produk">
                        <a href="<?php echo base_url(); ?>produk/detail?id=<?php echo $b['id']; ?>" class="d-block col-12 m-0 p-0">
                            <div class="col-12 p-3">
                                <div class="col-12 bg_gambar_produk"
                                    style="height:200px; background-image: url('<?php echo base_url(); ?>assets/img/produk/<?php echo $c['foto']; ?>');">
                                </div>
                            </div>
                            <div class="col-12 p-3 pt-0">
                                <small class="col-12 d-block p-0 m-0 text-center">Rp <?php echo number_format($harga_produk_terbaru['min'][$b['id']]['harga'], 0, ',','.'); ?> - Rp <?php echo number_format($harga_produk_terbaru['max'][$b['id']]['harga'],0,',','.'); ?> </small>
                                <h6 class="text-center"><?php echo $c['nama']; ?> <?php echo $c['kualitas']; ?></h6>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>