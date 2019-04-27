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
						<a href="<?php echo site_url('pesanan/indexFinal') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
						<thead class="thead-dark">
							<tr>
								<th>Nama Produk</th>
								<th>Jumlah Beli</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($pesanan as $data): ?>
								<tr>
									<td>
										<?php echo $data->namaProduk ?>
									</td>
									<td>
										<?php echo $data->jumlahBeli ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</body>
					</table>
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