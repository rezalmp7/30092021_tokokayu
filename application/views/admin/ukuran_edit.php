
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Edit Ukuran <b><?php echo $data_produk['nama']; ?></b>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/produk/aksi_edit_ukuran">
                                <input type="hidden" name="id" value="<?php echo $ukuran['id']; ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ukuran</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="ukuran" value="<?php echo $ukuran['ukuran']; ?>" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Stok</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="stok" value="<?php echo $ukuran['stock']; ?>" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="exampleInputEmail1" name="harga" value="<?php echo $ukuran['harga']; ?>" aria-describedby="emailHelp" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>