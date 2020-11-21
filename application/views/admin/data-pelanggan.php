        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          	
          	<!-- Konten Tabel -->
          	<div class="row">	
                <div class="col-lg"> 
                  <?php   if(validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
                  <?php   endif; ?>
          				<?= $this->session->flashdata('message'); 	 ?>
          <div class="card-body">
          <div class="table-responsive"> 
          <table class="table table-bordered" id="dataTable">
				  <thead>
				    <tr>
				      	<th scope="col">Nama</th>
				      	<th scope="col">Status</th>
              	<th scope="col">Alamat</th>
              	<th scope="col">No. Hp</th>
              	<th scope="col">Email</th>
              	<th scope="col">Photo</th>
              	<th scope="col">Sejak</th>
                <th scope="col">Ganti Status</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 	$i = 1; ?>
				  	<?php foreach ($pelanggan as $user): ?>
				    <tr>
				      	<td><?= $user['nama_pelanggan'];?></td>
              			<td><?= $user['grup_pel'];?></td>
              			<td><?= $user['alamat']?></td>
              			<td><?= $user['kontak'];?></td>
              			<td><?= $user['email'];?></td>
              			<td><img src="<?= base_url('assets/img/profiles/').$user['image'];?>" class="img-thumbnail" style="width:75px; height:75px;"></td>
              			<td> <?= date('d M Y', $user['date_created']); ?></td>
                    <td align="center">
                      <?php  if($user['grup_pel'] == 'Member') { ?>
                  <a href="<?= base_url('admin/changeStatusToPemilik/').$user['no_pelanggan'];?>" class="badge badge-success">Ubah Penjual</a>
                <?php } else { ?>
                  <a href="<?= base_url('admin/changeStatusToMember/').$user['no_pelanggan'];?>" class="badge badge-info">Ubah Member</a>
                <?php } ?>
                    </td>
				      <?php $i++; ?>
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

      