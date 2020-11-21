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
              <h2>Daftar dan Login di</h2>
              <p>Tokecang (Toko Grosir Ekonomi Curug Agung Sagala Herang)</p>
              <a class="button button-hero" href="<?= base_url('Home/daftar'); ?>">Daftar</a>
              <a class="button button-hero" href="<?= base_url('Home/login'); ?>">Login</a>

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
                  <li>Perlu Login Untuk Beli / Info Lebih Lanjut</li>
                </ul>
              </div>
              <div class="card-body">
                <p><?= $produk['kategori']; ?></p>
                <h4 class="card-product__title"><a onclick="alert('Login Untuk Cek Produk');"><?= $produk['nama_produk'];  ?></a></h4>
                <p class="card-product__price"><?= "Rp. ".$produk['harga_jual']; ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ trending product section end ================= -->  



  </main>

