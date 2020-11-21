	
	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="blog">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Detail Produk Tokecang</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('shop'); ?>">Kembali Ke Shop</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('shop/cart'); ?>">Cek Keranjang Belanja</a></li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->


  <!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-5">
					<div class="owl-theme s_Product_carousel">
						<div class="single-prd-item">
							<img class="img-fluid" src="<?= base_url('assets/img/product/').$detail_produk['image'];?>">

						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3><?= $detail_produk['nama_produk']; ?></h3>
						<h2><?php if($status == 'Member') { ?>
											<?= "Rp .".number_format($detail_produk['harga_jual']); ?>
										<?php } else { ?>
											<?= "Rp. ".number_format($detail_produk['harga_pokok']); ?>
										<?php } ?>	</h2>
						<ul class="list">
							<li><a class="active" href="#"><span>Category</span> : <?= $detail_produk['kategori'] ?></a></li>
							<li><a href="#"><span>Availibility</span> : <?= ($detail_produk['stok_produk'] == 0 ? "Stok Habis" : "Stok Tersedia");  ?></a></li>
						</ul>
						<p><?= ($detail_produk['keterangan'] == '' ? 'Tidak Ada Keterangan Untuk Produk Ini' : $detail_produk['keterangan']) ?></p>
						<div class="product_count">
              <label for="qty">Quantity:</label>          				
							<input type="text" name="qty" id="sst" size="2" maxlength="12" value="1" title="Quantity:" class="input-text qty" disabled>
							<a class="button primary-btn" href="<?= base_url('shop/addtocart/').$detail_produk["id_produk"];  ?>">Add to Cart</a>               
						</div>
						<div class="card_area d-flex align-items-center">
							<?php 	
								$a = $detail_produk['id_produk'] - 1;
								$b = $detail_produk['id_produk'] + 1;
							?>
							<a class="icon_btn" href="<?= base_url('shop/singleproduct/').$a; ?>"><i class="lnr lnr lnr-diamond"></i></a>
							<a class="icon_btn" href="<?= base_url('shop/singleproduct/').$b; ?>"><i class="lnr lnr lnr-heart"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
					 aria-selected="false">Specification</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p><?= ($detail_produk['keterangan'] == '' ? 'Tidak Ada Keterangan Untuk Produk Ini' : $detail_produk['keterangan']) ?> </p>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<h5>Nama Produk</h5>
									</td>
									<td>
										<h5><?= $detail_produk['nama_produk']; ?></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Harga</h5>
									</td>
									<td>
										<h5>
											<?php if($status == 'Member') { ?>
											<?= "Rp .".number_format($detail_produk['harga_jual']); ?>
										<?php } else { ?>
											<?= "Rp. ".number_format($detail_produk['harga_pokok']); ?>
										<?php } ?>	
										</h5>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				
				
		</div>
	</section>
	<!--================End Product Description Area =================-->

	<!--================ Start related Product area =================-->  
	<section class="related-product-area section-margin--small mt-0">
		<div class="container">
			<div class="section-intro pb-60px">
        <p>Popular Item in the market</p>
        <h2>Top <span class="section-intro__style">Product</span></h2>
      </div>
		<div class="row mt-30">

		<?php foreach ($produks as $produk) : ?>
        <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
          <div class="single-search-product-wrapper">
            <div class="single-search-product d-flex">
              <a href='<?= base_url('shop/singleproduct/').$produk["id_produk"]; ?>'><img src="<?= base_url('assets/img/product/').$produk['image'];?>" alt=""></a>
              <div class="desc">
                  <a href='<?= base_url('shop/singleproduct/').$produk["id_produk"]; ?>' class="title"><?= $produk['nama_produk'];  ?></a>
                  <div class="price"><?php if($status == 'Member') { ?>
											<?= "Rp .".number_format($detail_produk['harga_jual']); ?>
										<?php } else { ?>
											<?= "Rp. ".number_format($detail_produk['harga_pokok']); ?>
										<?php } ?></div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
     </div>
		</div>
	</section>
	<!--================ end related Product area =================-->  	
