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
					<button type="button" class="btn btn-info btn-success" data-toggle="modal" data-target="#myModal">Tambah Faktur</button>
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
												type="text" name="noFaktur" placeholder="Nomor Faktur">
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
	<div class="card mb-3">
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
								<?php foreach ($noFaktur as $data): ?>
								<tr>
									<td width="150">
										<?php echo $data->noFaktur ?>
									</td>
									<td>
										<?php echo $data->namaPerusahaan ?>
									</td>
									<td>
										<?php echo $data->totalPembayaran ?>
									</td>
									<td width="250">
										<a href="<?php echo site_url('admin/kontraBon/deleteFaktur/'.$data->noFaktur) ?>"
										class="btn btn-sm text-danger"><i class="fas fa-trash"></i> Hapus</a>
									</td>
								</tr>
								<?php endforeach; ?>
							</body>
						</table>
					</div>
					<a href="<?php echo site_url('admin/kontraBon/finalize/'.$noKontraBon->noKontraBon) ?>"
					class="btn btn-small text-success"><i class="fas fa-check-circle"></i> Finalize</a>
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