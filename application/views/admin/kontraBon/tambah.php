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

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/kontraBon/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
						<form action="<?php base_url('admin/kontraBon/add') ?>" method="post" >
							<div class="form-group">
								<label for="noKontraBon">Nomor Kontra Bon*</label>
								<input class="form-control <?php echo form_error('noKontraBon') ? 'is-invalid':'' ?>"
								 type="text" name="noKontraBon" placeholder="Nomor Kontra Bon" />
								<div class="invalid-feedback">
									<?php echo form_error('noFaktur') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="tanggalCetak">Tanggal Cetak*</label>
								<input class="form-control <?php echo form_error('tanggalCetak') ? 'is-invalid':'' ?>"
								 type="date" data-date-inline-picker="false" data-date-open-on-focus="true" name="tanggalCetak" placeholder="Tanggal Cetak" />
								<div class="invalid-feedback">
									<?php echo form_error('tanggalCetak') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="tanggalKembali">Tanggal Kembali*</label>
								<input class="form-control <?php echo form_error('tanggalKembali') ? 'is-invalid':'' ?>"
								 type="date" data-date-inline-picker="false" data-date-open-on-focus="true" name="tanggalKembali" placeholder="Tanggal Kembali" />
								<div class="invalid-feedback">
									<?php echo form_error('tanggalKembali') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="idPerusahaan"> Perusahaan*</label>
								<input class="form-control" list="listPerusahaan" <?php echo form_error('idPerusahaan') ? 'is-invalid':'' ?>
								 type="text" name="idPerusahaan" id="idPerusahaan" placeholder="Perusahaan">
								<datalist id="listPerusahaan">
								<?php
          						foreach($perusahaan as $data){
            						echo "<option value= ".$data->namaPerusahaan." ></option>";
								}
								?>
								</datalist>	
							</div>

							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</form>
					</div>

					<div class="card-footer small text-muted">
						* required fields
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

		<?php $this->load->view("admin/_partials/js.php") ?>
</body>

</html>