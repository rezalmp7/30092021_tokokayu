
        <div class="col-12 m-0 p-5" id="body">
            <div class="col-12 m-0 p-0 row">
                <div class="col-4 m-0 p-3">
                    <img class="col-12 m-0 p-0" src="<?php echo base_url(); ?>assets/img/produk/produk_1.png">
                </div>
                <div class="col-6 m-0 p-3">
                    <h3><?php echo $produk['nama']; ?></h3>
                    <div><?php echo $produk['kualitas']; ?></div>
                    <div><?php echo round($rating['rating'],3); ?></div>
                    <div class="pt-2 pb-2"><?php echo $produk['keterangan']; ?></div>
                    <form class="col-12 mt-4 p-0" method="POST" action="<?php echo base_url(); ?>keranjang/tambah_aksi">
                        <input type="hidden" name="id_produk" value="<?php echo $produk['id']; ?>">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Ukuran</label>
                            <select class="form-select" aria-label="Default select example" name="ukuran" required>
                                <option value="" selected>-- Pilih Ukuran --</option>
                                <?php
                                foreach ($ukuran as $a) {
                                ?>
                                <option value="<?php echo $a['id']; ?>"><?php echo $a['ukuran']; ?> Rp.<?php echo number_format($a['harga'],0,',','.'); ?> [<?php echo $a['stock']; ?>]</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Qty</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="qty">
                        </div>
                        <input type="submit" class="btn btn-success"  value="Keranjang">
                        <a class="btn btn-primary" href="<?php echo base_url(); ?>keranjang/tambah_wishlist?id_prd=<?php echo $produk['id']; ?>"><span class="iconify" data-icon="icon-park-outline:like" data-inline="false"></span> Suka</a>
                    </form>
                </div>
            </div>
            <div class="col-12 mt-4 p-3">
                <?php
                $status_login = $this->session->userdata('status_kayu');
                if($status_login == 'login_kayu')
                {
                ?>
                <form method="POST" action="<?php echo base_url(); ?>produk/tambah_rating">
                    <h5>Ulasan</h5>
                    <input type="hidden" name="id_produk" value="<?php echo $produk['id']; ?>">
                    <div class="col-12 m-0 p-3">
                        <div class="rating" style="font-size: 20px">
                            <i class="fa fa-star" data-rate="1"></i>
                            <i class="fa fa-star" data-rate="2"></i>
                            <i class="fa fa-star" data-rate="3"></i>
                            <i class="fa fa-star" data-rate="4"></i>
                            <i class="fa fa-star" data-rate="5"></i>
                            <input type="hidden" id="rating-count" name="rating" value="0">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ulasan" placeholder="ulasan"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <input type="submit" class="btn btn-success" value="Kirim">
                        </div>
                    </div>
                </form>
                <?php
                }
                else {
                ?>
                Silahkan <a href="<?php echo base_url(); ?>login">Login</a> Terlebih dahulu jika ingin menggunakan fitur ulasan
                <?php
                }
                ?>
            </div>
            <?php
            foreach ($ulasan as $b) {
            ?>
            <hr>
            <div class="col-12 m-0 p-0">
                <figure>
                    <blockquote class="blockquote">
                        <p class="uk-padding-remove uk-margin-remove"><span class="iconify" data-icon="emojione:star" data-inline="false"></span> <?php echo $b['rating']; ?></p>
                        <p class="uk-padding-remove uk-margin-remove"><?php echo $b['comment']; ?></p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Dari <?php echo $b['nama_pelanggan']; ?> <cite title="Source Title"><?php echo date('d F Y',strtotime($b['comment_at'])); ?></cite>
                    </figcaption>
                </figure>
                <?php
                if($b['replay'] != null)
                {
                ?>
                <div class="col-12 m-0 ps-5">
                    <figure>
                        <blockquote class="blockquote">
                            <p><?php echo $b['replay']; ?></p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            Dibalas Oleh <?php echo $b['nama']; ?> <cite title="Source Title"><?php echo date('d F Y', strtotime($b['replay_at'])); ?></cite>
                        </figcaption>
                    </figure>
                </div>
                <?php
                }
                ?>
            </div>
            <?php
            }
            ?>
        </div>