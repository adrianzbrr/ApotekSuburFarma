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
						<a href="<?php echo site_url('admin/perusahaan/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/perusahaan/add') ?>" method="post" >
							<div class="form-group">
								<label for="namaPerusahaan">Nama*</label>
								<input class="form-control <?php echo form_error('namaPerusahaan') ? 'is-invalid':'' ?>"
								 type="text" name="namaPerusahaan" placeholder="Nama" />
								<div class="invalid-feedback">
									<?php echo form_error('namaPerusahaan') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="alamatPerusahaan">Alamat*</label>
								<input class="form-control <?php echo form_error('alamatPerusahaan') ? 'is-invalid':'' ?>"
								 type="text" name="alamatPerusahaan" min="0" placeholder="Harga" />
								<div class="invalid-feedback">
									<?php echo form_error('alamatPerusahaan') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="noTelp"> Nomor Telepon*</label>
								<input class="form-control <?php echo form_error('noTelp') ? 'is-invalid':'' ?>"
								 type="text" name="noTelp" min="0" placeholder="noTelp">
								 <div class="invalid-feedback">
									<?php echo form_error('noTelp') ?>
								</div> 
							</div>
							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</form>
					</div>

					<div class="card-footer small text-muted">
						* required fields
					</div>


				</div>
				<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nama</th>
										<th>Alamat</th>
										<th>Nomor Telepon</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($perusahaan as $perusahaan): ?>
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
											<a href="<?php echo site_url('admin/perusahaan/edit/'.$perusahaan->idPerusahaan) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('admin/perusahaan/deleteNew/'.$perusahaan->idPerusahaan) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
										</td>
									</tr>
									<?php endforeach; ?>
								</body>
							</table>
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