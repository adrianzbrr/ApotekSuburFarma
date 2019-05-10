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
						<form action="<?php base_url('pesanan/edit') ?>" method="post" >
						<input type="hidden" name="idPesanan" value="<?php echo $pesanan->idPesanan ?>" />
						<div class="form-group">
								<label>ID Pesanan*</label>
								<input class="form-control" value="<?php echo $pesanan->idPesanan ?>" DISABLED/>
							</div>

							<div class="form-group">
								<label for="tanggalPesanan">Tanggal Pesanan*</label>
								<input class="form-control <?php echo form_error('tanggalPesanan') ? 'is-invalid':'' ?>"
								 type="date" data-date-inline-picker="false" data-date-open-on-focus="true" name="tanggalPesanan" placeholder="Tanggal Pesanan" value="<?php echo $pesanan->tanggalPesanan ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('tanggalPesanan') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="idPerusahaan"> Perusahaan*</label>
								<select class="form-control <?php echo form_error('idPerusahaan') ? 'is-invalid':'' ?>"
								 type="number" name="idPerusahaan" min="0" placeholder="Nama Perusahaan">
								<option value='0'>--PILIH--</option>
								<?php
									echo "<option value= ".$pesanan->idPerusahaan.">".$pesanan->namaPerusahaan."</option>";
          						foreach($perusahaan as $data){ 
									echo "<option value= ".$data->idPerusahaan.">".$data->namaPerusahaan."</option>";
									if($data->idPerusahaan != $pesanan->idPerusahaan){
										echo "<option value= ".$data->idPerusahaan.">".$data->namaPerusahaan."</option>";
										}
          						}
          						?>
								</select> 
							</div>
							<input class="btn btn-success" type="submit" onclick="alertTheSelectedValue()" name="btn" value="Save" />
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

		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>


		<?php $this->load->view("_partials/scrolltop.php") ?>

		<?php $this->load->view("_partials/js.php") ?>
</body>

</html>