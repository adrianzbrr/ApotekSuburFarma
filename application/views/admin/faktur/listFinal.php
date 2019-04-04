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

                <!-- DataTables -->
                <div class="card mb-3">
                    <div class="card-header">
                        <a href="<?php echo site_url('admin/faktur/tambahFaktur') ?>"><i class="fas fa-plus"></i> Tambah Kontra Bon</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
						<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
							<thead class="thead-dark">
									<tr>
										<th>Nomor Faktur</th>
										<th>Tanggal Cetak</th>
										<th>Jatuh Tempo</th>
										<th>Perusahaan</th>
										<th>Jumlah</th>
										<th>Total Pembayaran</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($fakturF as $faktur): ?>
									<tr>
										<td width="150">
											<a href="<?php echo site_url('admin/faktur/listProduk/'.$faktur->noFaktur) ?>">
											<?php echo $faktur->noFaktur ?>
											</a>
										</td>
										<td>
											<?php echo $faktur->tanggalCetak ?>
										</td>
										<td>
											<?php echo $faktur->tanggalJatuhTempo ?>
										</td>
										<td>
											<?php echo $faktur->namaPerusahaan ?>
										</td>
										<td>
											<?php echo $faktur->jumlahProduk ?>
										</td>
										<td>
											<?php echo $faktur->totalPembayaran ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</body>
							</table>
                        </div>
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
    <?php $this->load->view("admin/_partials/modal.php") ?>

    <?php $this->load->view("admin/_partials/js.php") ?>

    <script>
    function deleteConfirm(url){
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
        }
    </script>

</body>

</html>