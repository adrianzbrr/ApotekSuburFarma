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
						<a href="<?php echo site_url('faktur/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
						<form action="<?php base_url('faktur/') ?>" method="post" >
							<div class="form-group">
								<label for="noFaktur">Nomor Faktur*</label>
								<input class="form-control <?php echo form_error('noFaktur') ? 'is-invalid':'' ?>"
								 type="text" name="noFaktur" placeholder="Nomor Faktur" />
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
								<label for="tanggalJatuhTempo">Tanggal Jatuh Tempo*</label>
								<input class="form-control <?php echo form_error('tanggalJatuhTempo') ? 'is-invalid':'' ?>"
								 type="date" data-date-inline-picker="false" data-date-open-on-focus="true" name="tanggalJatuhTempo" placeholder="Tanggal Jatuh Tempo" />
								<div class="invalid-feedback">
									<?php echo form_error('tanggalJatuhTempo') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="idPerusahaan"> Perusahaan*</label>
								<input class="form-control" list="listPerusahaan" <?php echo form_error('idPerusahaan') ? 'is-invalid':'' ?>
								 type="text" name="idPerusahaan" id="idPerusahaan" placeholder="Perusahaan">
								<datalist id="listPerusahaan">
								<?php
          						foreach($perusahaan as $data){
            						echo "<option value= ".$data->namaPerusahaan." id=".$data->idPerusahaan." >".$data->namaPerusahaan."</option>";
								}
								?>
								</datalist>
							</div>

							<div class="form-group">
								<label for="idPesanan"> Pesanan Terkait*</label>
								<select class="form-control <?php echo form_error('idPesanan') ? 'is-invalid':'' ?>"
								 type="number" name="idPesanan" min="0" placeholder="Pesanan terkait">
								<option value='0'>--PILIH--</option>
								<?php
          						foreach($pesanan as $data){ 
            						echo "<option value= ".$data->idPesanan.">".$data->idPesanan."</option>";
          						}
          						?>
								</select> 
							</div>
							
							<input class="btn btn-success float-right" type="submit" name="btn" value="Simpan" />
						</form>
					</div>

					<div class="card-footer small text-muted">
						* required fields
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