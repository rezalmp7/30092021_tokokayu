
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Tambah Produk
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/produk/tambah_aksi">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Kualitas</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="kualitas" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Foto</label>
                                    <input class="form-control" id="formFileSm" type="file" name="foto" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>