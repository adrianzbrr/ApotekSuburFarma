<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

			<?php $this->load->view("_partials/breadcrumb.php") ?>
				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

                <?php if ($this->session->flashdata('danger')): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $this->session->flashdata('danger'); ?>
				</div>
				<?php endif; ?>

                <?php if ($this->session->flashdata('warning')): ?>
				<div class="alert alert-warning" role="alert">
					<?php echo $this->session->flashdata('warning'); ?>
				</div>
				<?php endif; ?>

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('faktur/add') ?>"><i class="fas fa-plus"></i> Tambah</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead class="thead-dark">
									<tr>
										<th>Nomor Faktur</th>
										<th>Tanggal Cetak</th>
										<th>Jatuh Tempo</th>
										<th>Perusahaan</th>
										<th>Jumlah</th>
										<th>Total Pembayaran</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($fakturNF as $faktur): ?>
									<tr>
										<td width="150">				
											<?php echo $faktur->noFaktur ?>
										</td>
										<td width="150">
											<?php echo $faktur->tanggalCetak ?>
										</td>
										<td width="140">
											<?php echo $faktur->tanggalJatuhTempo ?>
										</td>
										<td>
											<?php echo $faktur->namaPerusahaan ?>
										</td>
										<td>
											<?php echo $faktur->jumlahProduk ?>
										</td>
										<td width ="200">
											Rp <?php echo number_format($faktur->totalPembayaran,0,',','.')?>
										</td>
										<td width ="200">
											<a href="<?php echo site_url('faktur/addProduct/'.$faktur->idFaktur) ?>"
											 class="btn btn-small text-success"><i class="fas fa-plus-circle"></i> Tambah</a>
											 <?php if($this->session->userdata('idJabatan')==1){ ?>
												<a href="<?php echo site_url('faktur/edit/'.$faktur->idFaktur) ?>"
												class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
												<a onclick="deleteConfirm('<?php echo site_url('faktur/deleteFaktur/'.$faktur->idFaktur) ?>')"
												href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
											 <?php }?>
										</td>
									</tr>
									<?php endforeach; ?>
								</body>
							</table>
						</div>
						
					</div>
					</div>
			</div>
			
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<?php $this->load->view("_partials/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("_partials/scrolltop.php") ?>
	<?php $this->load->view("_partials/modal.php") ?>

	<?php $this->load->view("_partials/js.php") ?>

    <script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
        }
    </script>

</body>

</html>