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

                <?php if ($this->session->flashdata('warning')): ?>
				<div class="alert alert-warning" role="alert">
					<?php echo $this->session->flashdata('warning'); ?>
				</div>
				<?php endif; ?>

				<!-- DataTables -->
					<div class="card mb-3">
                    <div class="card-header">
					<a href="<?php echo site_url('admin/kontrabon/tambahKontraBon') ?>"><i class="fas fa-plus"></i> Tambah Kontra Bon</a>
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
                                        <td width="150">
                                            <a href="<?php echo site_url('admin/kontraBon/listFaktur/'.$data->noKontraBon) ?>">
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
                                            <?php echo $data->sisa ?>
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


<!-- DataTables -->
