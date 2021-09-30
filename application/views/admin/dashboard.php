
                <div class="col-12 m-0 p-5" id="content">
                    <div class="row col-12 row-cols-4 m-0 p-0" id="top_bar">
                        <div class="p-3 m-0">
                            <div class="col-12 m-0 p-3 card-body rounded">
                                <h4>Produk</h4>
                                <div class="col-12 m-0"><?php echo $jumlah_produk; ?></div>
                            </div>
                        </div>
                        <div class="p-3 m-0">
                            <div class="col-12 m-0 p-3 card-body rounded">
                                <h4>Pelanggan</h4>
                                <div class="col-12 m-0"><?php echo $jumlah_pelanggan; ?></div>
                            </div>
                        </div>
                        <div class="p-3 m-0">
                            <div class="col-12 m-0 p-3 card-body rounded">
                                <h4>Pesanan Selesai</h4>
                                <div class="col-12 m-0"><?php echo $jumlah_pesanan_selesai; ?></div>
                            </div>
                        </div>
                        <div class="p-3 m-0">
                            <div class="col-12 m-0 p-3 card-body rounded">
                                <h4>Pesanan Batal</h4>
                                <div class="col-12 m-0"><?php echo $jumlah_pesanan_batal; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 m-0 p-0">
                        <canvas id="myChart" class="col-12"></canvas>
                        <script>
                            var ctx = document.getElementById('myChart');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: ["<?php echo date('F Y', strtotime('-4 month')); ?>", "<?php echo date('F Y', strtotime('-3 month')); ?>", "<?php echo date('F Y', strtotime('-2 month')); ?>", "<?php echo date('F Y', strtotime('-1 month')); ?>", "<?php echo date('F Y'); ?>"],
                                    datasets: [{
                                        label: 'Transaksi Selesai Perbulan',
                                        backgroundColor: 'rgb(80, 137, 198)',
                                        borderColor: 'rgb(0, 30, 108)',
                                        data: [<?php echo $transaksi; ?>, <?php echo $transaksi1; ?>, <?php echo $transaksi2; ?>, <?php echo $transaksi3; ?>, <?php echo $transaksi4; ?>],
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>