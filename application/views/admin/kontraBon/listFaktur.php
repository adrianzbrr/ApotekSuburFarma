<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">
				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>
				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php endif; ?>
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/kontraBon/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Nomor Faktur</th>
									<th>Perusahaan</th>
									<th>Total Pembayaran</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($noFaktur as $data): ?>
								<tr>
									<td width="150">
										<?php echo $data->noFaktur ?>
									</td>
									<td>
										<?php echo $data->namaPerusahaan ?>
									</td>
									<td>
										<?php echo $data->totalPembayaran ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</body>
						</table>
					</div>
					<a href="<?php echo site_url('admin/kontraBon/paid/'.$noKontraBon->noKontraBon) ?>"
					class="btn btn-small text-success"><i class="fas fa-check-square"></i> Paid</a>
					</div>	
				</div>
			<!-- Sticky Footer -->
			<?php $this->load->view("admin/_partials/footer.php") ?>
		</div>
			<!-- /.content-wrapper -->

	</div>
		<!-- /#wrapper -->


		<?php $this->load->view("admin/_partials/scrolltop.php") ?>

		<?php $this->load->view("admin/_partials/js.php") ?>
		<script>
			function deleteConfirm(url){
				$('#btn-delete').attr('href', url);
				$('#deleteModal').modal();
				}
		</script>

</body>

</html>