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
</head>

<body>
    
    
    <div class="col-12 m-0 p-0" id="home">
        <div class="col-12 m-0 p-0" id="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img style="height: 30px;" src="<?php echo base_url(); ?>assets/img/website/logo.png"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse nav justify-content-end mt-3 mt-sm-0" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link pe-3 ps-3 active" aria-current="page" href="<?php echo base_url(); ?>home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pe-3 ps-3" href="<?php echo base_url(); ?>produk">Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pe-3 ps-3" href="<?php echo base_url(); ?>kontak">Kontak</a>
                            </li>
                            <?php
                            if($this->session->userdata('status_kayu') == 'login_kayu')
                            {
                            ?>
                                <li class="nav-item">
                                    <div class="dropdown float-end">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                            aria-expanded="false" style="border: 0px; background-color:transparent;">
                                            <img style="height: 30px; width: 30px" src="<?php echo base_url(); ?>assets/img/website/logo.png">
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>login/logout"><span class="iconify" data-icon="carbon:logout" data-inline="false"></span> Logout</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>keranjang/wishlist"><span class="iconify" data-icon="icon-park-outline:like" data-inline="false"></span> Suka</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>keranjang"><span class="iconify" data-icon="ant-design:shopping-cart-outlined" data-inline="false"></span> Keranjang</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>transaksi"><span class="iconify" data-icon="clarity:list-outline-badged"></span> Transaksi</a></li>
                                        </ul>
                                    </div>
                                </li>
                            <?php
                            }
                            else {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link pe-3 ps-3" href="<?php echo base_url(); ?>login">Masuk/Daftar</a>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
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

