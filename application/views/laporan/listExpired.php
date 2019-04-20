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

				<?php if ($this->session->flashdata('danger')): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $this->session->flashdata('danger'); ?>
				</div>
				<?php endif; ?>

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
					<a href="<?php echo site_url('overview') ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead class="thead-dark">
									<tr>
										<th>Nomor Batch</th>
										<th>Nama Produk</th>
										<th>Rak</th>
										<th>Jumlah</th>
										<th>Sisa Hari</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($kdl as $kdl): ?>
									<tr>
										<td>
											<?php echo $kdl->noBatch ?>
										</td>
										<td>
											<?php echo $kdl->namaProduk ?>
										</td>
										<td>
											<?php echo $kdl->namaRak ?>
										</td>
										<td>
											<?php echo $kdl->jumlah ?>
										</td>
										<td>
											<?php echo $kdl->Sisa ?>
										</td>
										<td width="250">
										<?php if($this->session->userdata('idJabatan')==1){ ?>
											<a onclick="deleteConfirm('<?php echo site_url('laporan/delete/'. $kdl->idBatch) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
										<?php } else{ ?>
											<span class='text-danger'> -Login sebagai admin-</span>
										<?php } ?>
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