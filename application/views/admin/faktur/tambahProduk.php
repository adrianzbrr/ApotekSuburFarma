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
						<a href="<?php echo site_url('admin/faktur/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">
						<form action="<?php base_url('admin/faktur/addProduk') ?>" method="post" >
							<div class="form-group">
								<label for="idProduk"> Nama Produk*</label>
									<select class="form-control <?php echo form_error('idProduk') ? 'is-invalid':'' ?>"
									type="number" name="idProduk" min="0" placeholder="Nama Produk">
									<?php
									foreach($produk as $data){ 
										echo "<option value= ".$data->idProduk.">".$data->namaProduk."</option>";
									}
									?>
								</select>
							</div>

							<div class="form-group">
								<label for="noBatch">No Batch*</label>
								<input class="form-control <?php echo form_error('noBatch') ? 'is-invalid':'' ?>"
								 type="text" name="noBatch" min="0" placeholder="Nomor Batch" />
								<div class="invalid-feedback">
									<?php echo form_error('noBatch') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="exp">Tanggal Kadaluarsa*</label>
								<input class="form-control <?php echo form_error('exp') ? 'is-invalid':'' ?>"
								 type="date" data-date-inline-picker="false" data-date-open-on-focus="true" name="exp" />
								<div class="invalid-feedback">
									<?php echo form_error('exp') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="kuota">Kuota Beli*</label>
								<input class="form-control <?php echo form_error('kuota') ? 'is-invalid':'' ?>"
								 type="number" name="kuota" min="0" placeholder="Kuota Beli"/>
								<div class="invalid-feedback">
									<?php echo form_error('kuota') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="hargaBeli">Harga Beli*</label>
								<input class="form-control <?php echo form_error('hargaBeli') ? 'is-invalid':'' ?>"
								 type="number" name="hargaBeli" min="0" placeholder="Harga Beli"/>
								<div class="invalid-feedback">
									<?php echo form_error('hargaBeli') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="diskon">Diskon*</label>
								<input class="form-control <?php echo form_error('diskon') ? 'is-invalid':'' ?>"
								 type="number" name="diskon" min="0" placeholder="Diskon"/>
								<div class="invalid-feedback">
									<?php echo form_error('diskon') ?>
								</div>
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
						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Nama Produk</th>
										<th>No Batch</th>
										<th>Tanggal Kadaluarsa</th>
										<th>Kuota</th>
										<th>Harga</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($batchProduk as $data): ?>
									<tr>
										<td width="150">
											<?php echo $data->namaProduk ?>
										</td>
										<td>
											<?php echo $data->noBatch ?>
										</td>
										<td>
											<?php echo $data->exp ?>
										</td>
										<td>
											<?php echo $data->kuotaBeli ?>
										</td>
										<td>
											<?php echo $data->HargaBeli ?>
										</td>
										<td width="250">
											<a onclick="deleteConfirm('<?php echo site_url('admin/faktur/delete/'.$data->noFaktur) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
										</td>
									</tr>
									<?php endforeach; ?>
								</body>
							</table>
						</div>
				<!-- Sticky Footer -->
				<?php $this->load->view("admin/_partials/footer.php") ?>

		</div>
			<!-- /.content-wrapper -->

	</div>
		<!-- /#wrapper -->


		<?php $this->load->view("admin/_partials/scrolltop.php") ?>

		<?php $this->load->view("admin/_partials/js.php") ?>
		<script>
			function deleteConfirm(url){
				$('#btn-delete').attr('href', url);
				$('#deleteModal').modal();
				}
		</script>

</body>

</html>