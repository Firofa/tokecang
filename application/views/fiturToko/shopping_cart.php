  <!-- ================ start banner area ================= --> 
  <section class="blog-banner-area" id="category">
    <div class="container h-100">
      <div class="blog-banner">
        <div class="text-center">
          <h1>Shopping Cart</h1>
          <nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Tokecang</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ end banner area ================= -->
  
  

  <!--================Cart Area =================-->
  <section class="cart_area">
      <div class="container">
        <?= $this->session->flashdata('message');    ?>   
          <div class="cart_inner">
              <div class="table-responsive">
                  <table class="table" id="dataTable">
                      <thead>
                          <tr>
                              <th scope="col">Produk</th>
                              <th scope="col">Harga</th>
                              <th scope="col">Kuantitas</th>
                              <th scope="col">Sub Total</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php   $total = 0;   ?>
                      <?php foreach ($cekKeranjang as $ck): ?>
                          <tr>
                              <td>
                                  <div class="media">
                                      <div class="d-flex">
                                          <img src="<?= base_url('assets/img/product/').$ck['image']; ?>" style="width:50px; height:50px;" alt="">
                                      </div>
                                      <div class="media-body">
                                          <p><?= $ck['nama_produk']; ?></p>
                                      </div>
                                  </div>
                              </td>
                              <td>
                                  <h5><?php if($status == 'Member') { ?>
                                    <?= "Rp .".number_format($ck['harga_jual']); ?>
                                  <?php } else { ?>
                                    <?= "Rp. ".number_format($ck['harga_pokok']); ?>
                                  <?php } ?>
                                    
                                  </h5>
                              </td>
                              <td>
                                  <div class="product_count">
                                      <input type="number" name="qty" id="qty" value="<?= $ck['jumlah'] ?>"
                                          class="input-text-qty" data-id="<?= $ck['no_keranjang']; ?>">
                                  </div>
                              </td>
                             
                              <td>
                                  <h5> <?php if($status == 'Member') { ?>
                      <?= "Rp .".number_format($ck['harga_jual']*$ck['jumlah']); ?>
                    <?php $total += $ck['harga_jual']*$ck['jumlah']; ?>
                    <?php } else { ?>
                      <?= "Rp. ".number_format($ck['harga_pokok']*$ck['jumlah']);   ?>
                      <?php $total += $ck['harga_pokok']*$ck['jumlah']; ?>
                    <?php } ?>
</h5>
                              </td>
                          </tr>
                          <?php endforeach ?>
                          <tr>
                              <td>

                              </td>
                              <td>

                              </td>
                              <td>
                                  <h5>Total Belanja</h5>
                              </td>
                              <td>
                                  <h5><?= "Rp. ".$total; ?></h5>
                              </td>
                          </tr>
                          <tr class="out_button_area">
                              <td class="">
                              </td>
                              <td>
                              </td>
                              <td>
                                  <div class="checkout_btn_inner d-flex align-items-center">
                                      <a class="gray_btn" href="<?= base_url('Shop'); ?>">Continue Shopping</a>
                                      <a class="primary-btn ml-2" href="<?= base_url('Shop/checkout'); ?>">Proceed to checkout</a>
                                  </div>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </section>
  <!--================End Cart Area =================-->



 