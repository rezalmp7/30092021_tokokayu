
        <div class="col-12 m-0 p-3 row" id="body">
            <div class="col-md-8 m-0 p-3" id="semua_produk">
                <h5>Keranjang</h5>
                <div class="col-12 m-0 p-0 clearfix">
					<a href="<?php echo base_url(); ?>produk" class="btn btn-warning btn-sm m-1"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                </div>
				<form method="POST" action="<?php echo base_url(); ?>keranjang/update_cart">
                <table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Produk</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                        <?php
                        $total_harga = 0;
                        foreach ($keranjang as $a) {
                        ?>
						<tr>
							<input type="hidden" name="id[]" value="<?php echo $a['id']; ?>">
							<input type="hidden" name="id_ukuran[]" value="<?php echo $a['id_ukuran']; ?>">
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 d-none d-md-block"><img class="col-12" src="<?php echo base_url(); ?>assets/img/produk/<?php echo $a['foto']; ?>" alt="..." class="img-responsive"/></div>
									<div class="col-sm-10">
										<h6 class="nomargin"><?php echo $a['nama']; ?></h6>
										<small>Rp. <?php echo number_format($a['harga'],0,',','.'); ?></small>
									</div>
								</div>
							</td>
							<td data-th="Quantity">
								<input type="number" name="qty[]" class="form-control text-center" id="qty_keranjang" value="<?php echo $a['qty']; ?>">
							</td>
                            <?php
                            $sub_total = $a['harga']*$a['qty'];
                            ?>
							<td data-th="Subtotal" class="text-center">Rp. <?php echo number_format($sub_total,0,',','.'); ?></td>
							<td class="actions" data-th="">
								<a href="<?php echo base_url(); ?>keranjang/hapus?id=<?php echo $a['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>								
							</td>
						</tr>
                        <?php 
                        $total_harga = $total_harga+$sub_total;
                        }
                        ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2"><input type="submit" class="btn btn-primary float-end btn-sm m-1" value="Update Kerajang">
							<td colspan="2" class="hidden-xs text-center"><strong>Total Rp <?php echo number_format($total_harga,0,',','.'); ?></strong></td>
						</tr>
					</tfoot>
				</table>
				</form>
            </div>
			<div class="col-md-4 pt-5">
				<form method="POST" action="<?php echo base_url(); ?>keranjang/checkout">
					<div class="card card-default col-12">
						<div class="card-body">
							<h5 class="card-title">Alamat</h5>
							<small class="text-danger">Cek Produk Dibawah Apakah sudah sesuai? jika belum klik tombol update keranjang</small>
							<table class="table table-hover table-condensed">
								<tbody>
									<?php
									$total_harga = 0;
									foreach ($keranjang as $a) {
									?>
									<tr>
										<input type="hidden" name="id[]" value="<?php echo $a['id']; ?>">
										<input type="hidden" name="id_produk[]" value="<?php echo $a['id_produk']; ?>">
										<input type="hidden" name="id_ukuran[]" value="<?php echo $a['id_ukuran']; ?>">
										<input type="hidden" name="qty[]" value="<?php echo $a['qty']; ?>">
										<td data-th="Product">
											<div class="row">
												<div class="col-sm-12">
													<h6 class="nomargin"><?php echo $a['nama']; ?></h6>
													<small>Rp. <?php echo number_format($a['harga'],0,',','.'); ?></small>
												</div>
											</div>
										</td>
										<td data-th="Quantity">
											<?php echo $a['qty']; ?>
										</td>
										<?php
										$sub_total = $a['harga']*$a['qty'];
										?>
										<td data-th="Subtotal" class="text-end">Rp. <?php echo number_format($sub_total,0,',','.'); ?></td>
									</tr>
									<?php 
									$total_harga = $total_harga+$sub_total;
									}
									?>
									<tr>
										<td colspan="2"><b>Total Harga</b></td>
										<td class="text-end">Rp <?php echo number_format($total_harga,0,',','.'); ?></td>
								</tbody>
							</table>
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Nama</label>
								<input type="text" name="nama" class="form-control" id="exampleFormControlInput1">
							</div>
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">No HP</label>
								<input type="text" name="no_hp" class="form-control" id="exampleFormControlInput1">
							</div>
							<div class="mb-3">
								<label for="exampleFormControlTextarea1" class="form-label">Wilayah Alamat</label>
								<select class="form-select" name="wilayah" aria-label="Default select example">
									<option selected>Wilayah Pengiriman</option>
									<?php
									foreach ($ongkir as $a) {
									?>
									<option value="<?php echo $a['id']; ?>"><?php echo $a['nama']; ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="mb-3">
								<label for="exampleFormControlTextarea1" class="form-label">Alamat Lengkap</label>
								<textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3"></textarea>
							</div>
							<div class="mb-3">
								<label for="exampleFormControlTextarea1" class="form-label">Metode Pembayaran</label>
								<select name="pembayaran" class="form-select" aria-label="Default select example">
									<option value="">-- Pilih Metode Pembayaran --</option>
									<?php 
									foreach ($channel['data'] as $a) {
										if($a['active'] != true)
										{
											continue;
										}
									?>
									<option value="<?php echo $a['code']; ?>"><?php echo $a['name']; ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-12 mt-2 mb-2 p-0 clearfix">
						<div class="col-12 m-0 p-0 text-end text-danger">Update keranjang terlebih dahulu sebelum Checkout</div>
						<input type="submit" class="btn btn-success btn-sm float-end" value="Checkout">
					</div>
				</form>
			</div>
        </div>