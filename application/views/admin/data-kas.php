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
				            <th scope="col">Kode pesanan</th>
                    <th scope="col">Pendapatan</th>

				    </tr>
				  </thead>
				  <tbody>
            <?php  $total = 0; ?>
				  	<?php foreach ($kas as $psn): ?>
				    <tr align="center">
						        <td><?= $psn['id_pemesanan'];?></td>

		                <td>
                     <?php if($psn['grup_pel'] == "Member") { ?>
                        <?= $psn['harga_jual'];?>
                        <?php $total += $psn['harga_jual']*$psn['jumlah']; ?>
                      <?php } else {  ?>
                      <?= $psn['harga_pokok']; ?>
                        <?php $total += $psn['harga_pokok']*$psn['jumlah']; ?>
                      <?php } ?>
                    </td> 
	                 
				      
				    </tr>		
				  	<?php endforeach ?>
				  </tbody>
			</table>
      <p style="color: blue;">Total Pendapatan : <?= $total; ?></p>
    </div>
  </div>

          	</div>

          </div>
          <!-- Akhir Konten Tabel -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->