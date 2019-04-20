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
				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('kontrabon/add') ?>"><i class="fas fa-plus"></i> Tambah Baru</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead class="thead-dark">
									<tr>
										<th>Nomor Kontra Bon</th>
										<th>Tanggal Cetak</th>
										<th>Tanggal Kembali</th>
										<th>Jumlah Faktur</th>
										<th>Nama Perusahaan</th>
										<th>Total Pembayaran</th>
										<th>Total Tunggakan</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($kontraBonF as $data): ?>
									<tr>
										<td>
											<a
												href="<?php echo site_url('kontraBon/listFaktur/'.$data->noKontraBon) ?>">
												<?php echo $data->noKontraBon ?>
											</a>
										</td>
										<td>
											<?php echo $data->tanggalCetak ?>
										</td>
										<td>
											<?php echo $data->tanggalKembali ?>
										</td>
										<td>
											<?php echo $data->jumlahFaktur ?>
										</td>
										<td>
											<?php echo $data->namaPerusahaan ?>
										</td>
										<td>
											<?php echo $data->totalPembayaran ?>
										</td>
										<td>
											<?php echo $data->sisaRp ?>
										</td>
										<td>
											<?php 
                                                if($data->sisa==0){
                                                    echo "<span class='text-success'>LUNAS</span>";
                                                }else{
                                                    echo "<span class='text-danger'>BELUM LUNAS</span>";
                                                }
                                            ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
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
	<?php $this->load->view("_partials/modal.php") ?>

	<?php $this->load->view("_partials/js.php") ?>

	</body>

</html>


<!-- DataTables -->
