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
						<a href="<?php echo site_url('admin/kontraBon/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<button type="button" class="btn btn-info btn-success" data-toggle="modal" data-target="#myModal">Tambah Produk</button>
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
									<form action="<?php base_url('admin/kontraBon/tambahFaktur') ?>" method="post" >
										<div class="form-group">
											<label for="noFaktur"> Nomor Faktur*</label>
												<select class="form-control <?php echo form_error('noFaktur') ? 'is-invalid':'' ?>"
												type="text" name="noFaktur" min="0" placeholder="Nomor Faktur">
												<?php
												foreach($notFaktur as $data){ 
													echo "<option value= ".$data->noFaktur.">".$data->noFaktur."</option>";
												}
												?>
											</select>
										</div>
										<input class="btn btn-success" type="submit" name="btn" value="Tambah" />
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
					<div class="card-body">
			
	
					<div class="table-responsive">
						<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Nomor Faktur</th>
									<th>Perusahaan</th>
									<th>Total Pembayaran</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($noFaktur as $noFaktur): ?>
								<tr>
									<td width="150">
										<?php echo $noFaktur->noFaktur ?>
									</td>
									<td>
										<?php echo $noFaktur->namaPerusahaan ?>
									</td>
									<td>
										<?php echo $noFaktur->totalPembayaran ?>
									</td>

									<td width="250">
										<a href="<?php echo site_url('admin/faktur/tambahProduk/'.$noFaktur->noFaktur) ?>"
										class="btn btn-sm text-success"><i class="fas fa-plus-circle"></i>Tambah Faktur</a>
									</td>
								</tr>
								<?php endforeach; ?>
							</body>
						</table>
					</div>
					</div>	
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