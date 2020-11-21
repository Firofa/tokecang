        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


          <div class="row">
          	<div class="col-lg-6">
              <?= $this->session->flashdata('message'); ?>
            </div>
          	<div class="col-lg-8">
          		
          		  
				<?= form_open_multipart('admin/doeditbarang'); ?>
				<div class="form-group">
			    <label for="id_produk" class="col-sm-2 col-form-label">Id Produk</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="id_produk" name="id_produk" value="<?= $id_produk; ?>" READONLY>
			      <?= form_error('id','<small class="text-danger pl-3">', '</small>');    ?>
			    </div>
			    </div> 
			    <div class="form-group">
			    <label for="kode_produk" class="col-sm-2 col-form-label">Kode Produk</label>
          <div class="col-sm-10">
    			<input type="text" class="form-control" id="kode_produk" name="kode_produk" value="<?= $kode_produk;  ?>">
    			<?= form_error('kode_produk','<small class="text-danger pl-3">', '</small>');    ?>
        	</div>
          </div>

          <div class="form-group">
          <label for="nama_produk" class="col-sm-2 col-form-label">Produk</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $nama_produk;  ?>">
          <?= form_error('nama_produk','<small class="text-danger pl-3">', '</small>');    ?>
          </div>
          </div>
        	
          <div class="form-group">
            <label for="image" class="col-sm-2 col-form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" value="<?= $image;  ?>" >
            <?= form_error('image','<small class="text-danger pl-3">', '</small>');    ?>
          </div>

          <div class="form-group">
          <label for="stok_produk" class="col-sm-2 col-form-label">Stok Produk</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id="stok_produk" name="stok_produk" value="<?= $stok_produk;  ?>">
          <?= form_error('stok_produk','<small class="text-danger pl-3">', '</small>');    ?>
          </div>
          </div>

          <div class="form-group">
          <label for="stok_produk" class="col-sm-2 col-form-label">Satuan</label>
          <div class="col-sm-10">
          <select name="id_satuan" id="id_satuan" class="form-control">
            <option value="<?= $id_satuan;  ?>">Pilih Satuan Stok</option>
            <?php foreach ($satuan as $stn) :?>
            <option value="<?= $stn['id']; ?>"><?= $stn['satuan']; ?></option>
            <?php endforeach; ?>
          </select>
          <?= form_error('stok_produk','<small class="text-danger pl-3">', '</small>');    ?>
          </div>
          </div>

          <div class="form-group">
          <label for="stok_produk" class="col-sm-2 col-form-label">Kategori</label>
          <div class="col-sm-10">
          <select name="id_kategori" id="id_kategori" class="form-control">
            <option value="<?= $id_kategori;  ?>">Pilih Kategori</option>
            <?php foreach ($kategori as $ktg) :?>
            <option value="<?= $ktg['id']; ?>"><?= $ktg['kategori']; ?></option>
            <?php endforeach; ?>
          </select>
          <?= form_error('stok_produk','<small class="text-danger pl-3">', '</small>');    ?>
          </div>
          </div>

          <div class="form-group">
          <label for="harga_pokok" class="col-sm-2 col-form-label">Harga Pokok</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id="harga_pokok" name="harga_pokok" value="<?= $harga_pokok;  ?>">
          <?= form_error('harga_pokok','<small class="text-danger pl-3">', '</small>');    ?>
          </div>
          </div>

          <div class="form-group">
          <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="<?= $harga_jual;  ?>">
          <?= form_error('harga_jual','<small class="text-danger pl-3">', '</small>');    ?>
          </div>
          </div>

          <div class="form-group">
          <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
          <div class="col-sm-10">
          <input type="textarea" class="form-control" id="keterangan" name="keterangan" value="<?= $keterangan;  ?>">
          <?= form_error('keterangan','<small class="text-danger pl-3">', '</small>');    ?>
          </div>
          </div>


				<div class="form-group row justify-content-end">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Edit</button>
					</div>
				</div>
			            			




          		</form>


          	</div>
          </div>

          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      