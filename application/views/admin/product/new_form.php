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
						<a href="<?php echo site_url('admin/produk/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/produk/add') ?>" method="post" >
							<div class="form-group">
								<label for="namaProduk">Nama*</label>
								<input class="form-control <?php echo form_error('namaProduk') ? 'is-invalid':'' ?>"
								 type="text" name="namaProduk" placeholder="Nama" />
								<div class="invalid-feedback">
									<?php echo form_error('namaProduk') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="hargaProduk">Harga*</label>
								<input class="form-control <?php echo form_error('hargaProduk') ? 'is-invalid':'' ?>"
								 type="number" name="hargaProduk" min="0" placeholder="Harga" />
								<div class="invalid-feedback">
									<?php echo form_error('hargaProduk') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="idJenis"> Jenis*</label>
								<select class="form-control <?php echo form_error('idJenis') ? 'is-invalid':'' ?>"
								 type="number" name="idJenis" min="0" placeholder="Jenis">
								<option value='0'>--PILIH--</option>
								<?php
          						foreach($jenis as $data){ 
            						echo "<option value= ".$data->idJenis.">".$data->namaJenis."</option>";
          						}
          						?>
								</select> 
							</div>

							<div class="form-group">
								<label for="idBentuk"> Bentuk*</label>
								<select class="form-control <?php echo form_error('idBentuk') ? 'is-invalid':'' ?>"
								type="number" name="idBentuk" min="0" placeholder="Bentuk"><option value='0'>--PILIH--</option>
								<?php
          						foreach($bentuk as $data){ 
            						echo "<option value= ".$data->idBentuk.">".$data->namaBentuk."</option>";
          						}
          						?>
								</select> 
							</div>

							<div class="form-group">
								<label for="idRak"> Rak*</label>
								<select class="form-control <?php echo form_error('idRak') ? 'is-invalid':'' ?>"
								 type="number" name="idRak" min="0" placeholder="Rak">
								 <option value='0'>--PILIH--</option>
								<?php
          						foreach($rak as $data){ 
            						echo "<option value= ".$data->idRak.">".$data->namaRak."</option>";
          						}
								  ?>
								  </select>
							</div>
							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</form>
					</div>

					<div class="card-footer small text-muted">
						* required fields
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