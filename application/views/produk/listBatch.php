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

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('produk/') ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-small" id="dataTable" width="100%" cellspacing="0">
								<thead class="thead-dark">
									<tr>
										<th>Tanggal</th>
										<th>Jenis</th>
										<th>No Batch</th>
										<th>Expired Date</th>
										<th>Jumlah</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($laporan as $data): ?>
									<tr>
										<td>
											<?php echo $data->tanggalLaporan ?>
										</td>
										<td>
											<?php if($data->jenisLaporan==0){
                                                    echo "<span class='text-success'>MASUK</span>";
                                                }else{
                                                    echo "<span class='text-danger'>KELUAR</span>";
												}
											?>
										</td>
										<td>
											<?php echo $data->noBatch ?>
										</td>
										<td>
											<?php echo $data->tanggalKedaluwarsa ?>
										</td>
										<td>
											<?php echo $data->jumlahBeli ?>
										</td>
										<td>
											<?php echo $data->sisa ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</body>
							</table>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="text-right">
						<a href="<?php echo site_url('produk/print/'.$produk->idProduk) ?>"
						class="btn btn-small text-warning"><i class="fas fa-file"></i> Cetak</a>
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
</body>

</html>