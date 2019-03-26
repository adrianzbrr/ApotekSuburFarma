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
						<a href="<?php echo site_url('admin/kontraBon/add') ?>"><i class="fas fa-plus"></i> Tambah</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nomor Kontra Bon</th>
										<th>Tanggal Cetak</th>
										<th>Tanggal Kembali</th>
										<th>Total Pembayaran</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($kontraBon as $kontraBon): ?>
									<tr>
										<td width="150">
											<?php echo $kontraBon->noKontraBon ?>
										</td>
										<td>
											<?php echo $kontraBon->tanggalCetak ?>
										</td>
										<td>
											<?php echo $kontraBon->tanggalKembali ?>
										</td>
										<td>
											<?php echo $kontraBon->totalPembayaran ?>
										</td>
										<td>
											<?php echo $kontraBon->namaStatus ?>
										</td>
										<td width="250">
											<a href="<?php echo site_url('admin/kontraBon/tambahFaktur/'.$kontraBon->noKontraBon) ?>"
											 class="btn btn-small text-success"><i class="fas fa-plus-circle"></i>Tambah Faktur</a>
											<a href="<?php echo site_url('admin/kontraBon/edit/'.$kontraBon->noKontraBon) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('admin/kontraBon/delete/'.$kontraBon->idKontraBon) ?>')"
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