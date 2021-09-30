
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Edit User
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?php echo base_url(); ?>admin/user/edit_aksi">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" value="<?php echo $user['nama']; ?>" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="username" value="<?php echo $user['username']; ?>" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Ganti Password</label>
                                    <input type="hidden" name="password_lama" value="<?php echo $user['password']; ?>"> 
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>