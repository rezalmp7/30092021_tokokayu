
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Edit Pelanggan
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/pelanggan/edit_aksi">
                                <input type="hidden" name="id" value="<?php echo $pelanggan['id']; ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" value="<?php echo $pelanggan['nama']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">No HP</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="no_hp" aria-describedby="emailHelp" value="<?php echo $pelanggan['no_hp']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Ganti Foto</label><br>
                                    <input type="hidden" name="foto_lama" value="<?php echo $pelanggan['foto']; ?>">
                                    <?php
                                    if($pelanggan['foto'] != null)
                                    {
                                    ?>
                                    <img style="height: 100px" class="mb-2" src="<?php echo base_url(); ?>assets/img/pelanggan/<?php echo $pelanggan['foto']; ?>">
                                    <?php
                                    }
                                    ?>
                                    <input class="form-control" id="formFileSm" type="file" name="foto">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="hidden" name="password_lama" value="<?php echo $pelanggan['password']; ?>">
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <button type="submit" class="btn btn-warning">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>