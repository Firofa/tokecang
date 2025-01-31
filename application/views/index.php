<!DOCTYPE HTML>
<!--
	Intensify by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title><?= $title ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="<?= base_url('assets/'); ?>css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<nav class="left">
					<a href="#menu"><span>Menu</span></a>
				</nav>
				<a href="#" class="logo"><?= $title; ?></a>
				<nav class="right">
					<a href="<?= base_url('Home/login'); ?>" class="button alt">Log in</a>
				</nav>
			</header>

		<!-- Menu -->
			<nav id="menu">
				<ul class="links">
					<li><a href="<?= base_url(); ?>">Home</a></li>
					<li><a href="#">Tentang</a></li>
					<li><a href="<?= base_url('Home/login'); ?>">Login</a></li>
				</ul>
				<ul class="actions vertical">
					<li><a href="#" class="button fit">Login</a></li>
				</ul>
			</nav>

		<!-- Banner -->
			<section id="banner" style="background-image: url(<?=base_url('assets/'); ?>img/warung-banner.jpeg);">
				<div class="content">
					<h1><?= $title; ?></h1>
					<p style="color:white;">Selamat Datang di Toko Ekonomi Curug Agung Sagalaherang<br />Selamat Belanja.</p>
					<ul class="actions">
						<li><a href="#one" class="button scrolly">Get Started</a></li>
					</ul>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="wrapper">
				<div class="inner flex flex-3">
					<div class="flex-item left">
						<div>
							<h3>Magna ultricies</h3>
							<p>Morbi in sem quis dui plalorem ipsum<br /> euismod in, pharetra sed ultricies.</p>
						</div>
						<div>
							<h3>Ipsum adipiscing lorem</h3>
							<p>Tristique yonve cursus jam nulla quam<br /> loreipsu gravida adipiscing lorem</p>
						</div>
					</div>
					<div class="flex-item image fit round">
						<img src="<?= base_url('assets/'); ?>img/pic01.jpg" alt="" />
					</div>
					<div class="flex-item right">
						<div>
							<h3>Tempus nullam</h3>
							<p>Sed adipiscing ornare risus. Morbi estes<br /> blandit sit et amet, sagittis magna.</p>
						</div>
						<div>
							<h3>Suscipit nibh dolore</h3>
							<p>Pellentesque egestas sem. Suspendisse<br /> modo ullamcorper feugiat lorem.</p>
						</div>
					</div>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style1 special">
				<div class="inner">
					<h2>Feugiat lorem</h2>
					<figure>
					    <blockquote>
					        "Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra<br /> magna etiam lorem ultricies in diam. Sed arcu cras consequat."
					    </blockquote>
					    <footer>
					        <cite class="author">Jane Anderson</cite>
					        <cite class="company">CEO, Untitled</cite>
					    </footer>
					</figure>
				</div>
			</section>

		<!-- Three -->
			<section id="three" class="wrapper">
				<div class="inner flex flex-3">
					<div class="flex-item box">
						<div class="image fit">
							<img src="<?= base_url('assets/'); ?>img/pic02.jpg" alt="" />
						</div>
						<div class="content">
							<h3>Consequat</h3>
							<p>Placerat ornare. Pellentesque od sed euismod in, pharetra ltricies edarcu cas consequat.</p>
						</div>
					</div>
					<div class="flex-item box">
						<div class="image fit">
							<img src="<?= base_url('assets/'); ?>img/pic03.jpg" alt="" />
						</div>
						<div class="content">
							<h3>Adipiscing</h3>
							<p>Morbi in sem quis dui placerat Pellentesque odio nisi, euismod pharetra lorem ipsum.</p>
						</div>
					</div>
					<div class="flex-item box">
						<div class="image fit">
							<img src="<?= base_url('assets/'); ?>img/pic04.jpg" alt="" />
						</div>
						<div class="content">
							<h3>Malesuada</h3>
							<p>Nam dui mi, tincidunt quis, accu an porttitor, facilisis luctus que metus vulputate sem magna.</p>
						</div>
					</div>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<h2>Get In Touch</h2>
					<ul class="actions">
						<li><span class="icon fa-phone"></span> <a href="#">(000) 000-0000</a></li>
						<li><span class="icon fa-envelope"></span> <a href="http://mail.google.com/">frgaruda@gmail.com</a></li>
						<li><span class="icon fa-map-marker"></span> Desa Curugagung RT/RW 09/03 Kecamatan Sagalaherang Kab. Subang, Jawa Barat</li>
					</ul>
				</div>
				<div class="copyright">
					&copy; Untitled. Design <a href="https://templated.co">TEMPLATED</a>. images <a href="https://unsplash.com">Unsplash</a>.
				</div>
			</footer>

		

		<!-- Scripts -->
			<script src="<?= base_url('assets/'); ?>js/jquery.min.js"></script>
			<script src="<?= base_url('assets/'); ?>js/jquery.scrolly.min.js"></script>
			<script src="<?= base_url('assets/'); ?>js/skel.min.js"></script>
			<script src="<?= base_url('assets/'); ?>js/util.js"></script>
			<script src="<?= base_url('assets/'); ?>js/main.js"></script>

	</body>
</html>