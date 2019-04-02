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
				
				<!-- /.container-fluid -->
				<div class="table-responsive">
					<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Nama Produk</th>
								<th>No Batch</th>
								<th>Tanggal Kadaluarsa</th>
								<th>jumlah</th>
								<th>Harga Satuan</th>
								<th>Diskon</th>
								<th>Harga</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($batchProduk as $data): ?>
								<tr>
									<td width="150">
										<?php echo $data->namaProduk ?>
									</td>
									<td>
										<?php echo $data->noBatch ?>
									</td>
									<td>
										<?php echo $data->tanggalKadaluarsa ?>
									</td>
									<td>
										<?php echo $data->jumlahBeli ?>
									</td>
									<td>
										<?php echo $data->hargaSatuan ?>
									</td>
									<td>
										<?php echo $data->diskon ?>
									</td>
									<td>
										<?php echo $data->hargaBeli ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</body>
					</table>
				</div>
			<!-- Sticky Footer -->
			<?php $this->load->view("admin/_partials/footer.php") ?>
		</div>
			<!-- /.content-wrapper -->

	</div>
		<!-- /#wrapper -->


		<?php $this->load->view("admin/_partials/scrolltop.php") ?>
		<?php $this->load->view("admin/_partials/modal.php") ?>

		<?php $this->load->view("admin/_partials/js.php") ?>
		<script>
			function deleteConfirm(url){
				$('#btn-delete').attr('href', url);
				$('#deleteModal').modal();
				}
		</script>
</body>
</html>