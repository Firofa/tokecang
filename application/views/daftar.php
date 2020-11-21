
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block"><img src="<?= base_url('assets/');?>img/grocery2.jpg" style="width: 503px; height: 605px;"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Form Daftar Member</h1>
              </div>
              <form class="user" method="POST" action="<?= base_url('Home/daftar'); ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="nama_pelanggan" name="nama_pelanggan" placeholder="Full Name" value="<?= set_value('nama_pelanggan'); ?>" />
                  <?= form_error('nama_pelanggan','<small class="text-danger pl-3">', '</small>');    ?> 
                  
                </div>
                <div class="form-group">
                  <input type="textarea" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Alamat" value="<?= set_value('alamat'); ?>" />
                  <?= form_error('alamat','<small class="text-danger pl-3">', '</small>');    ?> 
                  
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="kontak" name="kontak" placeholder="Kontak" value="<?= set_value('kontak'); ?>" />
                  <?= form_error('kontak','<small class="text-danger pl-3">', '</small>');    ?> 
                  
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>" />
                  <?= form_error('username','<small class="text-danger pl-3">', '</small>');    ?> 
                  
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>" />
                  <?= form_error('email','<small class="text-danger pl-3">', '</small>');    ?> 
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                    <?= form_error('password1','<small class="text-danger pl-3">', '</small>');    ?> 
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Daftar Member
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?= base_url('home/forgotpassword'); ?>">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= base_url('Home/login'); ?>">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>