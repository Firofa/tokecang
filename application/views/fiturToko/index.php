  <main class="site-main">
    
    <!--================ Hero banner start =================-->
    <section class="hero-banner">
      <div class="container">
        <div class="row no-gutters align-items-center pt-60px">
          <div class="col-5 d-none d-sm-block">
            <div class="hero-banner__img">
              <img class="img-fluid" src="<?= base_url('assets/aroma/'); ?>img/home/hero-banner.png" alt="">
            </div>
          </div>
          <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
            <div class="hero-banner__content">
              <h1>Belanja Yuk</h1>
              <h2>Jelajahi Produk Grosir Kami di</h2>
              <p>Tokecang (Toko Grosir Ekonomi Curug Agung Sagala Herang)</p>
              <a class="button button-hero" href="<?= base_url('user'); ?>">My Profile</a>
              <a class="button button-hero" href="#OurProduct">Jelajahi Tokecang</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero banner start =================-->
    <!-- ================ trending product section start ================= -->  
    <section class="section-margin calc-60px" >
      <div class="container">
        <div class="section-intro pb-60px">
          <a  name="OurProduct">Popular Item in the grocery</a>
          <h2>Our <span class="section-intro__style">Product</span></h2>
        </div>
        <div class="row">
          <?php foreach ($produks as $produk) : ?>
            <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card text-center card-product">
              <div class="card-product__img">
                <img style="width:255px; height:273px;" class="card-img" src="<?= base_url('assets/img/product/').$produk['image'];?>" alt="">
                <ul class="card-product__imgOverlay">
                  <li><button onClick="window.location.href='<?= base_url('shop/singleproduct/').$produk["id_produk"]; ?>'"><i class="ti-search"></i></button></li>
                  <li><button  onclick="window.location.href='<?= base_url('shop/addtocart/').$produk["id_produk"];  ?>'"><i class="ti-shopping-cart"></i></button></li>
                </ul>
              </div>
              <div class="card-body">
                <p><?= $produk['kategori']; ?></p>
                <h4 class="card-product__title"><a href="<?= base_url('shop/singleproduct/'.$produk["id_produk"].''); ?>"><?= $produk['nama_produk'];  ?></a></h4>
                <p>Stok Produk : <?= $produk['stok_produk']; ?> <?= $produk['satuan']; ?></p>
                <?php if ($status == 'member')  {?>                    
                <p class="card-product__price"><?= "Rp. ".$produk['harga_jual']; ?></p>
                <?php } else { ?>
                  <p class="card-product__price"><?= "Rp. ".$produk['harga_pokok']; ?></p>
                <?php } ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ trending product section end ================= -->  


    <!-- ================ offer section start ================= --> 
    <section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
      <div class="container">
        <div class="row">
          <div class="col-xl-5">
            <div class="offer__content text-center">
              <h3>Cek Produk Lain Kami</h3>
              <h4>Best Of Tokecang</h4>
             
              <a class="button button--active mt-3 mt-xl-4" href="#Popular">Check Now</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ offer section end ================= --> 

    <!-- ================ Best Selling item  carousel ================= --> 
    <section class="section-margin calc-60px" >
      <div class="container">
        <div class="section-intro pb-60px">
          <a name="Popular">Popular Item in the grocery</a>
          <h2>Best <span class="section-intro__style">Sellers</span></h2>
        </div>
        <div class="row">
          <?php foreach ($produks as $produk) : ?>
            <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card text-center card-product">
              <div class="card-product__img">
                <img style="width:255px; height:273px;" class="card-img" src="<?= base_url('assets/img/product/').$produk['image'];?>" alt="">
                <ul class="card-product__imgOverlay">
                  <li><button onClick="window.location.href='<?= base_url('shop/singleproduct/').$produk["id_produk"]; ?>'"><i class="ti-search"></i></button></li>
                  <li><button  onclick="window.location.href='<?= base_url('shop/addtocart/').$produk["id_produk"];  ?>'"><i class="ti-shopping-cart"></i></button></li>
                </ul>
              </div>
              <div class="card-body">
                <p><?= $produk['kategori']; ?></p>
                <h4 class="card-product__title"><a href="<?= base_url('shop/singleproduct/'.$produk["id_produk"].''); ?>"><?= $produk['nama_produk'];  ?></a></h4>
                 <p>Stok Produk : <?= $produk['stok_produk']; ?> <?= $produk['satuan']; ?></p>
                <p class="card-product__price"><?= "Rp. ".$produk['harga_jual']; ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          </div>
      </div>
    </section>
    <!-- ================ Best Selling item  carousel end ================= -->
    

  </main>

