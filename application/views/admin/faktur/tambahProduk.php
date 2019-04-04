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
                <?php if ($this->session->flashdata('danger')): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $this->session->flashdata('danger'); ?>
				</div>
				<?php endif; ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <a href="<?php echo site_url('admin/faktur/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
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
                                    <form action="<?php base_url('admin/faktur/tambahProduk') ?>" method="post" >
                                        <div class="form-group">
                                            <label for="idProduk"> Nama Produk*</label>
                                                <input class="form-control <?php echo form_error('idProduk') ? 'is-invalid':'' ?>"
                                                list="produklist" type="text" name="idProduk" min="0" placeholder="Nama Produk">
                                                <datalist id=produklist>
                                                <?php
                                                foreach($produk as $data){
                                                    echo "<option value= ".$data->namaProduk."></option>";
                                                }
                                                ?>
                                                </datalist>
                                            </select>
                                        <div class="form-group">
                                            <label for="noBatch">No Batch*</label>
                                            <input class="form-control <?php echo form_error('noBatch') ? 'is-invalid':'' ?>"
                                            type="text" name="noBatch" min="0" placeholder="Nomor Batch" />
                                            <div class="invalid-feedback">
                                                <?php echo form_error('noBatch') ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggalKadaluarsa">Tanggal Kadaluarsa*</label>
                                            <input class="form-control <?php echo form_error('tanggalKadaluarsa') ? 'is-invalid':'' ?>"
                                            type="date" data-date-inline-picker="false" data-date-open-on-focus="true" name="tanggalKadaluarsa" />
                                            <div class="invalid-feedback">
                                                <?php echo form_error('tanggalKadaluarsa') ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="jumlah">Jumlah Beli*</label>
                                            <input class="form-control <?php echo form_error('jumlah') ? 'is-invalid':'' ?>"
                                            type="number" name="jumlah" min="0" placeholder="Jumlah Beli"/>
                                            <div class="invalid-feedback">
                                                <?php echo form_error('jumlah') ?>
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
                                <th>No Batch</th>
                                <th>Tanggal Kadaluarsa</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Diskon</th>
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
                                        <?php echo $data->tanggalKadaluarsa ?>
                                    </td>
                                    <td>
                                        <?php echo $data->jumlahBeli ?>
                                    </td>
                                    <td>
                                        <?php echo $data->hargaSatuan ?>
                                    </td>
                                    <td>
                                        <?php echo $data->diskon ?>
                                    </td>
                                    <td>
                                        <?php echo $data->hargaBeli ?>
                                    </td>
                                    <td width="250">
                                        <a onclick="deleteConfirm('<?php echo site_url('admin/faktur/deleteBatch/'.$data->idBatch)?>')"
                                         href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </body>
                    </table>
                </div>

        </div>
            <!-- /.content-wrapper -->
            <div class="card-footer">
                        <div class="text-right">
                        <a href="<?php echo site_url('admin/faktur/finalize/'.$faktur->noFaktur) ?>"
                        class="btn btn-success"><i class="fas fa-check-circle"></i> Finalize</a>
                        </div>
            </div>
                                            

    </div>
                <!-- Sticky Footer -->
                <?php $this->load->view("admin/_partials/footer.php") ?>
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