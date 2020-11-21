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
        <p style="color:black;">Catatan <span style="color: red;">(Penting!)</span>  :</p>
      <p style="color:black;">*Klik "Siap Ambil" ketika produk sudah tersedia dan siap diambil pelanggan </p>
      <p style="color:red;">*Klik "Selesai" ketika produk sudah dipastikan diambil pelanggan dan uang sudah diterima (Transaksi Selesai)  </p>
        <div class="card-body">
        <div class="table-responsive">             
        <table class="table table-striped" id="dataTable">
				  <thead>
				    <tr align="center">
				    <th scope="col">Kode pesanan</th>
                    <th scope="col">Kode Produk</th>
                    <th scope="col">Nama Produk</th>
              		<th scope="col">Nama Pemesan</th>
              		<th scope="col">Tanggal Pemesanan</th>
                    <th scope="col">Jumlah Pembelian</th>
                    <th scope="col">Harga Produk</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php foreach ($pesanan as $psn): ?>
				    <tr align="center">
						<td><?= $psn['id_pemesanan'];?></td>
		                <td><?= $psn['kode_produk'];?></td>
		                <td><?= $psn['nama_produk'];?></td>
		              	<td align="center"><?= $psn['nama_pelanggan'] ?></td>
		                <td> <?= date('d M Y',$psn['tanggal_pemesanan']); ?></td>
		              	<td> <?= $psn['jumlah']; ?></td>
		                 
                    <td>
                     <?php if($psn['grup_pel'] == "Member") { ?>
                        <?= $psn['harga_jual'];?>
                      <?php } else {  ?>
                      <?= $psn['harga_pokok']; ?>
                      <?php } ?>
                    </td> 
                    <td>
                      <?php if($psn['grup_pel'] == "Member") { ?>
                      <?= $psn['harga_jual']*$psn['jumlah']; ?>  
                        <?php } else { ?>
                      <?= $psn['harga_pokok']*$psn['jumlah']; ?>  
                      <?php } ?>
                    </td>
          
		                <td> <?= $psn['status']; ?></td>
	                <td>
                  <?php  if($psn['status'] == 'Siap Ambil') { ?>
                  <a href="<?= base_url('admin/changeStatusToDone/').$psn['id_pemesanan'];?>" class="badge badge-success">Selesai</a>
                <?php } else { ?>
                  <a href="<?= base_url('admin/changeStatusToReady/').$psn['id_pemesanan'];?>" class="badge badge-info">Siap Ambil</a>
                  <a href="<?= base_url('admin/changeStatusToDone/').$psn['id_pemesanan'];?>" class="badge badge-success">Selesai</a>
                <?php } ?>
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