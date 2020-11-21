  
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block"><img src="<?= base_url('assets/');?>img/grocery1.jpg" style="width: 500px; height: 600px;"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Lupa Password?</h1>
                  </div>
                  <hr>
                   <?= $this->session->flashdata('message');  ?>

                  <form class="user" method="POST" action="<?= base_url('home/forgotpassword');?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukan Email.." > 
                      <?= form_error('email', '<small class="text-danger pl-3">','</small>') ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Reset Password
                    </button>
                    <hr>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('home/login'); ?>">Back To Login</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('home') ?>/daftar">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
