<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("_partials/head.php") ?>
</head>

<tbody id="page-top">

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
						<a href="<?php echo site_url('perusahaan/add') ?>"><i class="fas fa-plus"></i> Tambah Baru</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead class="thead-dark">
									<tr>
										<th>Nama</th>
										<th>Alamat</th>
										<th>Nomor Telepon</th>
										<th>Pengaturan</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($perusahaan as $perusahaan) : ?>
									<tr>
										<td width="150">
											<?php echo $perusahaan->namaPerusahaan ?>
										</td>
										<td>
											<?php echo $perusahaan->alamatPerusahaan ?>
										</td>
										<td>
											<?php echo $perusahaan->noTelp ?>
										</td>
										<td width="250">
											<a href="<?php echo site_url('perusahaan/edit/' . $perusahaan->idPerusahaan) ?>"
												class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
												<?php if($perusahaan->rowFaktur == 0 && $perusahaan->rowKontra == 0 && $perusahaan->rowPesanan == 0 ){ ?>
													<a onclick="deleteConfirm('<?php echo site_url('perusahaan/delete/' . $perusahaan->idPerusahaan) ?>')"
													href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i>
													Hapus</a>
												<?php } ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
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
		function deleteConfirm(url) {
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}

	</script>

	</body>

</html>
