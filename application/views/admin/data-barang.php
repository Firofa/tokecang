        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          	<div class="row">  
              <div class="col-lg">
                <div class="col-lg-10"> 
                  <?php   if(validation_errors()) : ?>
                    <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?= validation_errors(); ?>
                    </div>
                  <?php   endif; ?>

                  <?= $this->session->flashdata('message');    ?>
                </div>
              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newJualanModal">Tambah Barang Baru</a>

        <div class="card-body">
        <div class="table-responsive">             
        <table class="table table-striped" id="dataTable">
				  <thead>
				    <tr align="center">
				      	    <th scope="col">Kode Produk</th>
                    <th scope="col">Nama Produk</th>
              			<th scope="col">Gambar Produk</th>
              			<th scope="col">Stok</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga Pokok</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Terakhir Diupdate</th>
                    <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach ($produks as $produk): ?>
				    <tr align="center">
				      	<td><?= $produk['kode_produk'];?></td>
                <td><?= $produk['nama_produk'];?></td>
              	<td align="center"><img src="<?= base_url('assets/img/product/').$produk['image'];?>" class="img-thumbnail" style="width:75px; height:75px;"></td>
              	<td> <?= $produk['stok_produk']; ?></td>
                <td> <?= $produk['satuan']; ?></td>
                <td> <?= $produk['kategori']; ?></td>
                <td> <?= $produk['harga_pokok']; ?></td>
                <td> <?= $produk['harga_jual']; ?></td>
                <td> <?= date('d M Y',$produk['date_updated']); ?></td>
                <td>
                  <a href="<?= base_url('admin/editdatabarang/').$produk['id_produk']; ?>" class="badge badge-success">Edit</a>
                <a href="<?= base_url('admin/deletedatabarang/').$produk['id_produk']; ?>" class="badge badge-danger">Delete</a>
                </td>
				      
				    </tr>		
				  	<?php endforeach ?>
				  </tbody>
			</table>
    </div>
  </div>

          	</div>

          </div>
          <!-- Akhir Konten Tabel -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


<!-- Input Modal -->
<div class="modal fade" id="newJualanModal" tabindex="-1" role="dialog" aria-labelledby="newJualanLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newJualanLabel">Tambah Barang Jualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('admin/databarang'); ?>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="kode_produk" name="kode_produk" placeholder="Kode Produk">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk">
        </div>
        <div class="form-group">
          <label for="image">Masukan Gambar Produk :</label>
          <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="stok_produk" name="stok_produk" placeholder="Stok Produk">
        </div>
        <div class="form-group">
          <select name="id_satuan" id="id_satuan" class="form-control">
            <option value="">Pilih Satuan Stok</option>
            <?php foreach ($satuan as $stn) :?>
            <option value="<?= $stn['id']; ?>"><?= $stn['satuan']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <select name="id_kategori" id="id_kategori" class="form-control">
            <option value="">Pilih Kategori</option>
            <?php foreach ($kategori as $ktg) :?>
            <option value="<?= $ktg['id']; ?>"><?= $ktg['kategori']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>


        <div class="form-group">
          <input type="text" class="form-control" id="harga_pokok" name="harga_pokok" placeholder="Masukan Harga Pokok">
        </div>

        


        <div class="form-group">
          <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukan Harga Jual">
        </div>
        <div class="form-group">
          <input type="textarea" class="form-control" id="keterangan" name="keterangan" placeholder="Masukan Keterangan">
        </div>
        
  </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
        </div>
        </form>
    </div>
  </div>
</div>


      
      