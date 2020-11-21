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

        <div class="card-body">
        <div class="table-responsive">             
        <table class="table table-striped" id="dataTable">
				  <thead>
				    <tr align="center">
                    <th scope="col">Kode Produk</th>
                    <th scope="col">Nama Produk</th>
              		<th scope="col">Tanggal Pemesanan</th>
                    <th scope="col">Jumlah Pembelian</th>
                    <th scope="col">Harga Produk</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach ($pesanan as $psn): ?>
				    <tr align="center">
		                <td><?= $psn['kode_produk'];?></td>
		                <td><?= $psn['nama_produk'];?></td>
		                <td> <?= date('d M Y',$psn['tanggal_pemesanan']); ?></td>
		              	<td> <?= $psn['jumlah']; ?></td>
		                <td>
                     <?php if($status == "Member") { ?>
                        <?= $psn['harga_jual'];?>
                      <?php } else {  ?>
                      <?= $psn['harga_pokok']; ?>
                      <?php } ?>
                    </td> 
                    <td>
                      <?php if($status == "Member") { ?>
                      <?= $psn['harga_jual']*$psn['jumlah']; ?>  
                        <?php } else { ?>
                      <?= $psn['harga_pokok']*$psn['jumlah']; ?>  
                      <?php } ?>
                    </td>
		                <td> <?= $psn['status']; ?></td>
				      
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