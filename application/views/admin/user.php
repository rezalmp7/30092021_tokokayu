
                <div class="col-12 m-0 p-5" id="content">
                    <div class="card">
                        <div class="card-header">
                            Data User
                        </div>
                        <div class="card-body">
                            <div class="clearfix text-end">
                                <a href="<?php echo base_url(); ?>admin/user/tambah" class="btn btn-success btn-sm"><span class="iconify" data-icon="akar-icons:plus" data-inline="false"></span> Tambah</a>
                            </div>
                            <table id="datatables" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($user as $a) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $a['nama']; ?></td>
                                        <td><?php echo $a['username']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>admin/user/edit?id=<?php echo $a['id']; ?>" class="btn btn-warning btn-sm"><span class="iconify" data-icon="akar-icons:edit" data-inline="false"></span></a>
                                            <a href="<?php echo base_url(); ?>admin/user/hapus?id=<?php echo $a['id']; ?>" class="btn btn-danger btn-sm"><span class="iconify" data-icon="akar-icons:trash-can" data-inline="false"></span></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>