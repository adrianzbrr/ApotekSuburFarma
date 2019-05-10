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
						<a href="<?php echo site_url('pesanan/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
						<form action="<?php base_url('pesanan/add') ?>" method="post" >

							<div class="form-group">
								<label for="idPesanan">ID Pesanan*</label>
								<input class="form-control <?php echo form_error('idPesanan') ? 'is-invalid':'' ?>"
								 type="text" name="idPesanan" placeholder="ID Pesanan" />
								<div class="invalid-feedback">
									<?php echo form_error('idPesanan') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="tanggalPesanan">Tanggal Pesanan*</label>
								<input class="form-control <?php echo form_error('tanggalPesanan') ? 'is-invalid':'' ?>"
								 type="date" data-date-inline-picker="false" data-date-open-on-focus="true" name="tanggalPesanan" placeholder="Tanggal Pesanan" />
								<div class="invalid-feedback">
									<?php echo form_error('tanggalPesanan') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="idPerusahaan"> Perusahaan*</label>
								<select class="form-control <?php echo form_error('idPerusahaan') ? 'is-invalid':'' ?>"
								 type="number" name="idPerusahaan" min="0" placeholder="Nama Perusahaan">
								<option value>--PILIH--</option>
								<?php
          						foreach($perusahaan as $data){ 
            						echo "<option value= ".$data->idPerusahaan.">".$data->namaPerusahaan."</option>";
          						}
          						?>
								</select> 
							</div>
							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</form>
					</div>

					<div class="card-footer small text-muted">
						* wajib diisi
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

		<?php $this->load->view("_partials/js.php") ?>
</body>

</html>