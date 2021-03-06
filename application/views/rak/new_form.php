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

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('rak') ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('rak/add') ?>" method="post" >
							<div class="form-group">
								<label for="namaRak">Nama Rak*</label>
								<input class="form-control <?php echo form_error('namaRak') ? 'is-invalid':'' ?>"
								 type="text" name="namaRak" placeholder="Nama Rak" />
								<div class="invalid-feedback">
									<?php echo form_error('namaRak') ?>
								</div>
							</div>

							<input class="btn btn-success float-right" type="submit" name="btn" value="Simpan" />
						</form>
					</div>

					<div class="card-footer small text-muted">
						* wajib diisi
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

		<?php $this->load->view("_partials/js.php") ?>

</body>

</html>