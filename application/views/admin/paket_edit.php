
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Edit Paket
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/paket/edit_aksi">
                                <input type="hidden" name="id" value="<?php echo $paket['id']; ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" value="<?php echo $paket['nama']; ?>" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Harga</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="harga" value="<?php echo $paket['harga']; ?>" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Foto</label>
                                    <input type="hidden" name="foto_lama" value="<?php echo $paket['foto']; ?>"><br>
                                    <img style="height: 80px" src="<?php echo base_url(); ?>assets/img/produk/<?php echo $paket['foto']; ?>" class="mb-2">
                                    <input class="form-control" id="formFileSm" type="file" name="foto">
                                </div>
                                <button type="submit" class="btn btn-warning">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>