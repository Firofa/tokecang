<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= $title ?></title>
      <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/'); ?>css/fontawesome.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link rel="icon" href="<?= base_url('assets/aroma/'); ?>img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="<?= base_url('assets/aroma/'); ?>vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/aroma/'); ?>vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/aroma/'); ?>vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url('assets/aroma/'); ?>vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="<?= base_url('assets/aroma/'); ?>vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/aroma/'); ?>vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/aroma/'); ?>css/style.css">




</head>
<body>
  <!--================ Start Header Menu Area =================-->
	<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="<?= base_url('shop'); ?>"><h3>Tokecang</h3></a>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item"><a class="nav-link" href="<?= base_url('user'); ?>"><i class="ti-user"></i> My Profile</a></li>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('Shop'); ?>"><i class="fas fa-shopping-bag"></i> Shop</a></li>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('Shop/cart'); ?>"><i class="ti-shopping-cart"></i> Check Cart</a></li>
              <li class="nav-item"><a class="nav-link" href="<?= base_url('home/logout'); ?>"><i class="ti-power-off"></i> Log Out</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
	<!--================ End Header Menu Area =================-->

