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
						<a href="<?php echo site_url('pengguna/') ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('pengguna/edit') ?>" method="post" >
						<input type="hidden" name="username" value="<?php echo $pengguna->username ?>" />
							<div class="form-group">
								<label for="password"> Password*</label>
								<input class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>"
								 type="password" name="password" placeholder="Password" value="<?php echo $pengguna->password ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('password') ?>
								</div>
							</div>

                            <div class="form-group">
								<label for="namaPengguna"> Nama*</label>
								<input class="form-control <?php echo form_error('namaPengguna') ? 'is-invalid':'' ?>"
								 type="text" name="namaPengguna" placeholder="Nama" value="<?php echo $pengguna->namaPengguna ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('namaPengguna') ?>
								</div>
							</div>
							<?php if($this->user->user_login()->username != $pengguna->username) {?>
							<div class="form-group">
								<label for="idJabatan"> Jabatan*</label>
								<select class="form-control <?php echo form_error('idJabatan') ? 'is-invalid':'' ?>"
								 type="number" name="idJabatan" min="0" placeholder="Jenis">
								<?php echo "<option value= ".$pengguna->idJabatan.">".$pengguna->namaJabatan."</option>"; ?>
								<?php
          						foreach($jabatan as $data){ 
									if($data->idJabatan != $pengguna->idJabatan){
									echo "<option value= ".$data->idJabatan.">".$data->namaJabatan."</option>";
									}
          						}
          						?>
								</select> 
							</div>
							<?php } ?>
							<input class="btn btn-success float-right" type="submit" name="btn" value="Simpan" />
						</form>
					</div>

					<div class="card-footer small text-muted">
						* required fields
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