
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Data Ulasan Produk <?php echo $produk['nama']; ?>
                        </div>
                        <div class="card-body">
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
                                else {
                                ?>
                                <form method="POST" action="<?php echo base_url(); ?>admin/produk/update_ulasan">
                                    <input type="hidden" name="id" value="<?php echo $b['id']; ?>">
                                    <input type="hidden" name="id_produk" value="<?php echo $produk['id']; ?>">
                                    <div class="col-12 m-0 p-3">
                                        
                                        <div class="mb-3">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="jawaban" placeholder="Balas"></textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <input type="submit" class="btn btn-success" value="Kirim">
                                        </div>
                                    </div>
                                </form>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>