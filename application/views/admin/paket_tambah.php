
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Tambah Paket
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/paket/tambah_aksi">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Harga</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="harga" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Foto</label>
                                    <input class="form-control" id="formFileSm" type="file" name="foto" required>
                                </div>
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>