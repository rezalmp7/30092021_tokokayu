
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Edit Ukuran <b><?php echo $paket['nama']; ?></b>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/paket/aksi_list_tambah">
                                <input type="hidden" name="id_paket" value="<?php echo $id_paket; ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Produk</label>
                                    <select name="produk" class="form-select" onchange="location = this.value;" required>
                                        <option value="list_tambah?id_pkt=<?php echo $paket['id']; ?>">--Pilih Produk--</option>
                                        <?php
                                        foreach ($produk as $a) {
                                        ?>
                                        <option value="list_tambah?id_pkt=<?php echo $paket['id']; ?>&id_produk=<?php echo $a['id']; ?>" <?php if($produk_select == $a['id']) echo 'selected'; ?>><?php echo $a['nama']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="id_produk" value="<?php echo $produk_select; ?>">
                                </div>
                                <?php
                                if($ukuran_produk == null)
                                {
                                }
                                else {
                                ?>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ukuran</label>
                                    <select class="form-select" aria-label="Default select example" name="ukuran" required>
                                        <option selected>-- Pilih Ukuran --</option>
                                        <?php
                                        foreach($ukuran_produk as $b) {
                                        ?>
                                        <option value="<?php echo $b['id']; ?>"><?php echo $b['ukuran']; ?>(<?php echo $b['stock']; ?>)</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                                }
                                ?>
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>