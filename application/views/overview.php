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

				<!-- 
        karena ini halaman overview (home), kita matikan partial breadcrumb.
        Jika anda ingin mengampilkan breadcrumb di halaman overview,
        silahkan hilangkan komentar (//) di tag PHP di bawah.
        -->
				<?php //$this->load->view("_partials/breadcrumb.php") ?>

				<!-- Icon Cards-->
				<div class="row">
					<?php if($this->session->userdata('idJabatan')<=2){ ?>
					<div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-success o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon">
									<i class="fas fa-fw fa-money"></i>
								</div>
								<div class="mr-5">Jumlah Tunggakan</div>
								<?php foreach ($tunggak as $data): ?>
								<div class="h4">Rp <?php echo number_format($data->hutang,0,',','.')?></div>
								<?php endforeach; ?>
							</div>
							<a class="card-footer text-white clearfix small z-1"
								href="<?php echo site_url('kontraBon/indexFinal') ?>">
								<span class="float-left">View Details</span>
								<span class="float-right">
									<i class="fas fa-angle-right"></i>
								</span>
							</a>
						</div>
					</div>
					<?php } ?>
					<div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white o-hidden h-100" style="background-color: #ff8000">
							<div class="card-body">
								<div class="card-body-icon">
									<i class="fas fa-fw fa-money"></i>
								</div>
								<div class="mr-5">Jumlah Produk</div>
								<div class="h4"><?php echo $prdk->jumlah ?></div>
							</div>
							<a class="card-footer text-white clearfix small z-1"
								href="<?php echo site_url('produk') ?>">
								<span class="float-left">View Details</span>
								<span class="float-right">
									<i class="fas fa-angle-right"></i>
								</span>
							</a>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-danger o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon">
									<i class="fas fa-fw fa-warning"></i>
								</div>
								<div class="h4"><?php echo $kdl ?></div>
								<div class="mr-5">Produk Segera Kedaluwarsa</div>
							</div>
							<a class="card-footer text-white clearfix small z-1"
								href="<?php echo site_url('laporan/expiredReport') ?>">
								<span class="float-left">View Details</span>
								<span class="float-right">
									<i class="fas fa-angle-right"></i>
								</span>
							</a>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-warning o-hidden h-100">
							<div class="card-body">
								<div class="card-body-icon">
									<i class="fas fa-fw fa-money"></i>
								</div>
								<div class="h4"><?php echo $exp ?></div>
								<div class="mr-5">Kontra Bon habis < 7 hari </div>
							</div>
							<a class="card-footer text-white clearfix small z-1"
								href="<?php echo site_url('kontrabon/indexFinal') ?>">
								<span class="float-left">View Details</span>
								<span class="float-right">
									<i class="fas fa-angle-right"></i>
								</span>
							</a>
						</div>
					</div>
					
				</div>

				<div class="card mb-3">
					<div class="card-header">
						<div class="h4"><?php echo $hbs ?></div>
						PRODUK SEGERA HABIS
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-sm" width="100%" cellspacing="0">
								<thead class="thead-dark">
									<tr>
										<th>Nama Produk</th>
										<th>Minimal Stok</th>
										<th>Jumlah</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($habis as $data): ?>
									<tr>
										<td>
											<?php echo $data->namaProduk ?>
										</td>
										<td>
											<?php echo $data->minimalStok ?>
										</td>
										<td>
											<?php echo $data->jumlah ?>
										</td>
									</tr>
									<?php endforeach; ?>
</body>
</table>
<div class="text-right">
	<a href="<?php echo site_url('laporan') ?>" class="btn btn-primary"> Lihat lebih banyak</a>
</div>
</div>
</div>
</div>

<!-- Area Chart Example
		<div class="card mb-3">
			<div class="card-header">
			<i class="fas fa-chart-area"></i>
			Visitor Stats</div>
			<div class="card-body">
			<canvas id="myAreaChart" width="100%" height="30"></canvas>
			</div>
			<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
		</div>
		


		</div> -->
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
