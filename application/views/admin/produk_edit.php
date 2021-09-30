
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Edit Produk
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/produk/edit_aksi">
                                <input type="hidden" name="id" value="<?php echo $produk['id']; ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" value="<?php echo $produk['nama']; ?>" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Kualitas</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="kualitas" value="<?php echo $produk['kualitas']; ?>" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Foto</label>
                                    <br>
                                    <input type="hidden" name="foto_lama" value="<?php echo $produk['foto']; ?>">
                                    <img class="mb-2 mt-2" style="height: 100px" src="<?php echo base_url(); ?>assets/img/produk/<?php echo $produk['foto']; ?>">
                                    <input class="form-control" id="formFileSm" type="file" name="foto">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3"><?php echo $produk['keterangan']; ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>