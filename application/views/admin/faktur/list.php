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
					<div class="card-header">
						<a href="<?php echo site_url('admin/faktur/tambahFaktur') ?>"><i class="fas fa-plus"></i> Tambah</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nomor Faktur</th>
										<th>Tanggal Cetak</th>
										<th>Tanggal Jatuh Tempo</th>
										<th>Perusahaan</th>
										<th>Jumlah Produk</th>
										<th>Total Pembayaran</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($faktur as $faktur): ?>
									<tr>
										<td width="150">
										<a href="<?php echo site_url('admin/faktur/tambahProduk/'.$faktur->noFaktur) ?>">
											<?php echo $faktur->noFaktur ?>
											</a>
										</td>
										<td>
											<?php echo $faktur->tanggalCetak ?>
										</td>
										<td>
											<?php echo $faktur->tanggalJatuhTempo ?>
										</td>
										<td>
											<?php echo $faktur->namaPerusahaan ?>
										</td>
										<td>
											<?php echo $faktur->jumlahProduk ?>
										</td>
										<td>
											<?php echo $faktur->totalPembayaran ?>
										</td>

										<td width="250">
											<a href="<?php echo site_url('admin/faktur/tambahProduk/'.$faktur->noFaktur) ?>"
											 class="btn btn-small text-success"><i class="fas fa-plus-circle"></i>Tambah Produk</a>
											<a href="<?php echo site_url('admin/faktur/edit/'.$faktur->noFaktur) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('admin/faktur/delete/'.$faktur->noFaktur) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
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

    <script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
        }
    </script>

</body>

</html>