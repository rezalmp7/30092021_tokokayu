
        <div class="col-12 m-0 p-3 row" id="body">
            <div class="col-md-8 m-0 p-3" id="semua_produk">
                <h5>Keranjang</h5>
                <div class="col-12 m-0 p-0 clearfix">
					<a href="<?php echo base_url(); ?>keranjang" class="btn btn-warning btn-sm m-1"><i class="fa fa-angle-left"></i> Cart</a>
                </div>
                <table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Produk</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
						</tr>
					</thead>
					<tbody>
                        <?php
                        $total_harga = 0;
						$i = 0;
                        foreach ($keranjang as $a) {
                        ?>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 d-none d-md-block"><img class="col-12" src="<?php echo base_url(); ?>assets/img/produk/<?php echo $a['foto']; ?>" alt="..." class="img-responsive"/></div>
									<div class="col-sm-10">
										<h6 class="nomargin"><?php echo $a['nama'].' '.$a['ukuran']; ?></h6>
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
							<td data-th="Subtotal" class="text-center">Rp. <?php echo number_format($sub_total,0,',','.'); ?></td>
						</tr>
                        <?php 
                        $total_harga = $total_harga+$sub_total;
                        }
                        ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2"></td>
							<td colspan="2" class="hidden-xs text-center"><strong>Total Rp <?php echo number_format($total_harga,0,',','.'); ?></strong></td>
						</tr>
					</tfoot>
				</table>
            </div>
			<div class="col-md-4 pt-5">
				<form method="POST" action="<?php echo base_url(); ?>keranjang/bayar_aksi">
					<div class="card card-default col-12">
						<div class="card-body">
							<h5 class="card-title">Alamat</h5>
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
										<input type="hidden" name="harga[]" value="<?php echo $a['harga']; ?>">
										<input type="hidden" name="qty[]" value="<?php echo $a['qty']; ?>">
										<td data-th="Product">
											<div class="row">
												<div class="col-sm-12">
													<h6 class="nomargin"><?php echo $a['nama'].' '.$a['ukuran']; ?></h6>
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
									
										<input type="hidden" name="nama" value="<?php echo $post['nama']; ?>">
										<input type="hidden" name="no_hp" value="<?php echo $post['no_hp']; ?>">
										<input type="hidden" name="wilayah" value="<?php echo $post['wilayah']; ?>">
										<input type="hidden" name="alamat" value="<?php echo $post['alamat']; ?>">
										<input type="hidden" name="metode" value="<?php echo $post['pembayaran']; ?>">
									<tr>
										<td colspan="2"><b>Total Harga</b></td>
										<td class="text-end">Rp <?php echo number_format($total_harga,0,',','.'); ?></td>
								</tbody>
							</table>
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Nama : </label>
								<?php echo $post['nama']; ?>
							</div>
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">No HP : </label>
								<?php echo $post['no_hp']; ?>
							</div>
							<div class="mb-3">
								<label for="exampleFormControlTextarea1" class="form-label">Wilayah Alamat : </label>
								<?php echo $ongkir['nama'].' (Rp '.number_format($ongkir['biaya']).')'; ?>
							</div>
							<div class="mb-3">
								<label for="exampleFormControlTextarea1" class="form-label">Alamat : </label>
								<?php echo $post['alamat']; ?>
							</div>
							<div class="mb-3">
								<label for="exampleFormControlTextarea1" class="form-label">Metode Pembayaran : </label>
								<?php echo $pembayaran['data'][0]['name'].' (Rp '.number_format($pembayaran['data'][0]['total_fee']['flat'],0,',','.').')'; ?>
							</div>
							<table class="table table-hover table-condensed">
								<tbody>
									<tr>
										<td colspan="3"></td>
									</tr>
									<?php $harga_dibayar = $total_harga+$ongkir['biaya']+$pembayaran['data'][0]['total_fee']['flat']; ?>
									<?php $amount = $total_harga+$ongkir['biaya']; ?>
									<tr>
										<td colspan="2"><b>Harga yang harus dibayar</b></td>
										<td class="text-end">Rp <?php echo number_format($harga_dibayar,0,',','.'); ?></td>
										<input type="hidden" name="amount" value="<?php echo $amount; ?>">
										<input type="hidden" name="harga_akhir" value="<?php echo $harga_dibayar; ?>">
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-12 mt-2 mb-2 p-0 clearfix">
						<input type="submit" class="btn btn-success btn-sm float-end" value="Bayar">
					</div>
				</form>
			</div>
        </div>