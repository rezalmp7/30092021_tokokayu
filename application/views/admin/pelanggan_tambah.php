
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Tambah Pelanggan
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/pelanggan/tambah_aksi">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">No HP</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="no_hp" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Foto</label>
                                    <input class="form-control" id="formFileSm" type="file" name="foto" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                                </div>
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>