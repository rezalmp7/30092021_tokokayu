<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url(); ?>assets/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo base_url(); ?>assets/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>assets/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.js"
        integrity="sha512-XcsV/45eM/syxTudkE8AoKK1OfxTrlFpOltc9NmHXh3HF+0ZA917G9iG6Fm7B6AzP+UeEzV8pLwnbRNPxdUpfA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style_admin.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <title>Arina Jati</title>
</head>

<body>
    <div class="col-12 m-0 p-0" id="dashboard">
        <div class="col-12 m-0 p-0 row">
            <div class="col-2 m-0 p-0" id="sidebar">
                <div class="col-12 m-0 p-3 row" id="logo">
                    <img class="col-3 m-0" src="<?php echo base_url(); ?>assets/img/website/logo.png">
                    <span class="col-auto">Arina Jati</span>
                </div>
                <ul class="nav flex-column mt-3 p-3">
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>admin/dashboard" class="nav-link active" aria-current="page"><span class="iconify"
                                data-icon="ant-design:dashboard-outlined" data-inline="false"></span> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>admin/user" class="nav-link"><span class="iconify" data-icon="ant-design:user-outlined"
                                data-inline="false"></span> User</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>admin/pelanggan" class="nav-link"><span class="iconify" data-icon="clarity:users-line" data-inline="false"></span>
                            Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>admin/terfavorit" class="nav-link"><span class="iconify" data-icon="clarity:users-line" data-inline="false"></span>
                            Produk Terfavorit</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>admin/produk" class="nav-link"><span class="iconify" data-icon="eos-icons:product-classes-outlined" data-inline="false"></span> Produk</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>admin/pesanan" class="nav-link"><span class="iconify" data-icon="el:list-alt"
                                data-inline="false"></span> Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>admin/laporan" class="nav-link"><span class="iconify" data-icon="heroicons-solid:document-report"
                                data-inline="false"></span> Laporan</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-10 m-0 p-0" id="body">
                <div class="col-12 m-0 p-3 clearfix" id="header">
                    <div class="dropdown float-end">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img style="height: 30px; width: 30px" src="<?php echo base_url(); ?>assets/img/website/logo.png">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>admin/login/logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <?php
if($this->session->flashdata('error') != '')
{
?>
<script>
    swal.fire({
        title: "Error!",
        text: "<?php echo $this->session->flashdata('error'); ?>",
        icon: "error",
    });
</script>
<?php
    $this->session->set_flashdata('error', '');
}
if($this->session->flashdata('success') != '')
{
?>
<script>
    swal.fire({
        title: "Good Job!",
        text: "<?php echo $this->session->flashdata('success'); ?>",
        icon: "success",
    });
</script>
<?php
    $this->session->set_flashdata('success', '');
}
?>

