
        <div class="col-12 m-0 p-5" id="body">
            <div class="col-12 m-0 p-0 row">
                <div class="col-6 m-0 p-3" id="login">
                    <h5>Login</h5>
                    <form method="POST" action="<?php echo base_url(); ?>login/aksi_login">
                        <label for="basic-url" class="form-label">No HP</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" id="basic-url" name="no_hp" required>
                        </div>
                        
                        <label for="basic-url" class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="basic-url" name="password" required>
                        </div>
                        
                        <div class="input-group">
                            <input type="submit" value="Login" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <div class="col-6 m-0 p-3" id="Register">
                    <h5>Login</h5>
                    <form method="POST" action="<?php echo base_url(); ?>login/aksi_daftar">

                        <label for="basic-url" class="form-label">Nama</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="basic-url" name="nama">
                        </div>

                        <label for="basic-url" class="form-label">No Telephone/WA</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" id="basic-url" name="no_hp">
                        </div>

                        <label for="basic-url" class="form-label">Kata Sandi</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="basic-url" name="password">
                        </div>

                        <label for="basic-url" class="form-label">Konfirmasi Kata Sandi</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="basic-url" name="kpassword">
                        </div>
                
                        <div class="input-group">
                            <input type="submit" value="Daftar" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>