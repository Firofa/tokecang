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
              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKategoriModal">Tambah Satuan Baru</a>

        <div class="card-body">
        <div class="table-responsive">             
        <table class="table table-striped" id="dataTable">
				  <thead>
				    <tr align="center">
				        <th scope="col">Kode Satuan</th>
                <th scope="col">Nama Satuan</th>
                <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach ($satuan as $stn): ?>
				    <tr align="center">
				      	<td><?= $stn['id'];?></td>
                		<td><?= $stn['satuan'];?></td>
              	
		                <td>
		                	<a href="<?= base_url('admin/deletedatasatuan/').$stn['id']; ?>" class="badge badge-danger">Delete</a>
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
<div class="modal fade" id="newKategoriModal" tabindex="-1" role="dialog" aria-labelledby="newKategoriLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newKategoriLabel">Tambah Satuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('admin/datasatuan'); ?>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Nama Satuan">
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


      
      