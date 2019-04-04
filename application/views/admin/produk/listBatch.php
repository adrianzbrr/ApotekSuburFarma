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

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header"></div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-small" id="dataTable" width="100%" cellspacing="0">
								<thead class="thead-dark">
									<tr>
										<th>Tanggal Masuk</th>
										<th>Nama</th>
										<th>Expired Date</th>
										<th>Kuota</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($batch as $data): ?>
									<tr>
										<td>
											<?php echo $data->tanggalCetak ?>
										</td>
										<td width="150">
											<?php echo $data->noBatch ?>
										</td>
										<td>
											<?php echo $data->tanggalKadaluarsa ?>
										</td>
										<td>
											<?php echo $data->jumlah ?>
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
			<?php $this->load->view("admin/_partials/footer.php") ?>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


	<?php $this->load->view("admin/_partials/scrolltop.php") ?>
	<?php $this->load->view("admin/_partials/modal.php") ?>

	<?php $this->load->view("admin/_partials/js.php") ?>
</body>

</html>