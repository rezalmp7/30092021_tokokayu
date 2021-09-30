<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>assets/<?php echo base_url(); ?>assets/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendor/RatingForm/css/better-rating.css" rel="stylesheet" type="text/css" media="screen" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.js"></script>
    <title>Arina Jati</title>
    <script>
        window.print();
    </script>
</head>

<body>
    
    
    <div class="col-12 m-0 p-0" id="home">
        <div class="col-12 m-0 p-0">
            <h3 class="text-center">Arina Jati</h3>
            <small class="col-12 m-0 p-0 d-block text-center">Petekeyan, RT20 RW 04, Kec. Tahunan, Kab. Jepara</small>
        <div class="col-12 m-0 p-3 row" id="body">
			<div class="col-12 pt-5">
					<div class="card card-default col-12">
						<div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Ref</td>
                                    <td>: <?php echo $pembayaran->reference; ?></td>
                                    <td>Status</td>
								    <td class="fw-bold">: 
                                        <?php
                                                switch ($transaksi['status']) {
                                                    case 0:
                                                        echo "Cancel";
                                                        break;
                                                    case 1:
                                                        echo "Belum Lunas";
                                                        break;
                                                    case 2:
                                                        echo "Lunas";
                                                        break;
                                                    case 3:
                                                        echo "Lunas";
                                                        break;
                                                    case 4:
                                                        echo "Lunas";
                                                        break;
                                                    case 5:
                                                        echo "Return";
                                                        break;
                                                    case 6:
                                                        echo "Gagal";
                                                        break;    
                                                    case 7:
                                                        echo "Gagal";
                                                        break; 
                                                    case 8:
                                                        echo "Gagal";
                                                        break;                                 
                                                    default:
                                                        echo "Error Status";
                                                        break;
                                                }
                                            ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?php echo $transaksi['nama_penerima']; ?></td>
                                    <td>No HP</td>
								    <td>: <?php echo $transaksi['no_hp_penerima']; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
								    <td>: <?php echo $transaksi['alamat']; ?></td>
							        <td>Metode Pembayaran</td>
								    <td>: <?php echo $pembayaran->payment_name; ?></td>
                                </tr>
                            </table>
                            <hr>
							<h5 class="card-title">Daftar Barang</h5>
							<table class="table table-hover table-condensed">
								<tbody>
									<?php
									$total_harga = 0;
									foreach ($pesanan as $a) {
									?>
									<tr>
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
                                    $harga_dibayar = $total_harga+$ongkir['biaya']+$pembayaran->total_fee;
									}
									?>
									
									<tr>
										<td colspan="2"><b>Total Harga</b></td>
										<td class="text-end">Rp <?php echo number_format($total_harga,0,',','.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><b>Admin</b></td>
                                        <td class="text-end">Rp <?php echo number_format($pembayaran->total_fee,0,',','.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><b>Harga Akhir</b></td>
                                        <td class="text-end">Rp <?php echo number_format($harga_dibayar,0,',','.'); ?>                                    
								</tbody>
							</table>
						</div>
					</div>
                </div>
            </div>
        
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/RatingForm/js/better-rating.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>