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
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('pesanan/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<button type="button" class="btn btn-info btn-success" data-toggle="modal"
						data-target="#myModal">Tambah Produk</button>
					<!-- Modal -->
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Tambah Produk</h4>
								</div>
								<div class="modal-body">
									<div class="card-body">
										<form action="<?php base_url('pesanan/addProduct') ?>" method="post">
											<input type="hidden" name="id"
												value="<?php echo $pemesanan->idPesanan ?>" />
											<div class="form-group">
												<label for="namaProduk"> Nama Produk* </label>
												<input
													class="form-control <?php echo form_error('idProduk') ? 'is-invalid':'' ?>"
													list="produklist" type="text" name="namaProduk" min="0"
													placeholder="Nama Produk">
												<datalist id=produklist>
													<?php
                                                foreach($produk as $data){
                                                    echo "<option value= ".$data->namaProduk."></option>";
                                                }
                                                ?>
												</datalist>
												</select>

												<div class="form-group">
													<label for="jumlahBeli">Jumlah Beli*</label>
													<input
														class="form-control <?php echo form_error('jumlahBeli') ? 'is-invalid':'' ?>"
														type="number" name="jumlahBeli" min="0"
														placeholder="Jumlah Beli" />
													<div class="invalid-feedback">
														<?php echo form_error('jumlahBeli') ?>
													</div>
												</div>
												<input class="btn btn-success" type="submit" name="btn"
													value="Simpan" />
										</form>
									</div>
									<div class="card-footer small text-muted">
										* required fields
									</div>
								</div><!-- Modal Body-->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div><!-- Modal content-->
						</div><!-- Modal Dialog-->
					</div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-body">

					<!-- /.container-fluid -->
					<div class="table-responsive">
						<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
							<thead class="thead-dark">
								<tr>
									<th>Nama Produk</th>
									<th>Jumlah Beli</th>
								</tr>
							</thead>

							<tbody>
								<?php foreach ($pesanan as $data): ?>
								<tr>
									<td>
										<?php echo $data->namaProduk ?>
									</td>
									<td>
										<?php echo $data->jumlahBeli ?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>

				</div>
				<!-- /.content-wrapper -->
				<div class="card-footer">
					<div class="text-right">
						<a onclick="finalizeConfirm('<?php echo site_url('pesanan/finalize/'.$pemesanan->idPesanan)?>')"
							href="#!" class="btn btn-success"><i class="fas fa-check-circle"></i> Finalize</a>
					</div>
				</div>


			</div>
			<!-- Sticky Footer -->
			<?php $this->load->view("_partials/footer.php") ?>
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
