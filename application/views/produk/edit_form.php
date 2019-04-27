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

                <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php endif; ?>

                <div class="card mb-3">
                    <div class="card-header">

                        <a href="<?php echo site_url('produk/') ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">

                        <form action="<?php base_url('produk/edit') ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $produk->idProduk ?>" />
                            <div class="form-group">
                                <label for="namaProduk">Nama*</label>
                                <input class="form-control <?php echo form_error('namaProduk') ? 'is-invalid' : '' ?>" type="text" name="namaProduk" placeholder="Nama" value="<?php echo $produk->namaProduk ?>" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('namaProduk') ?>
                                </div>
                            </div>

                            <div class="form-group">
								<label for="MinimalStok">Minimal Stok*</label>
								<input class="form-control <?php echo form_error('namaProduk') ? 'is-invalid':'' ?>"
								 type="number" min="0" name="minimalStok" placeholder="Minimal Stok" value="<?php echo $produk->minimalStok ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('minimalStok') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="idJenis"> Jenis*</label>
								<select class="form-control <?php echo form_error('idJenis') ? 'is-invalid':'' ?>"
								 type="number" name="idJenis" min="0" placeholder="Jenis">
								<?php
								echo "<option value= ".$produk->idJenis.">".$produk->namaJenis."</option>";
          						foreach($jenis as $data){ 
									if($data->idJenis != $produk->idJenis){
            						echo "<option value= ".$data->idJenis.">".$data->namaJenis."</option>";
									}  
								}
          						?>
								</select> 
							</div>

							<div class="form-group">
								<label for="idBentuk"> Bentuk*</label>
								<select class="form-control <?php echo form_error('idBentuk') ? 'is-invalid':'' ?>"
								type="number" name="idBentuk" min="0" placeholder="Bentuk">
								<?php
								echo "<option value= ".$produk->idBentuk.">".$produk->namaBentuk."</option>";
          						foreach($bentuk as $data){ 
									if($data->idBentuk != $produk->idBentuk){
            						echo "<option value= ".$data->idBentuk.">".$data->namaBentuk."</option>";
									}
								}
          						?>
								</select> 
							</div>

							<div class="form-group">
								<label for="idSatuan"> Satuan*</label>
								<select class="form-control <?php echo form_error('idSatuan') ? 'is-invalid':'' ?>"
								type="number" name="idSatuan" placeholder="Satuan">
								<?php
								echo "<option value= ".$produk->idSatuan.">".$produk->namaSatuan."</option>";
          						foreach($satuan as $data){ 
									if($data->idSatuan != $produk->idSatuan){
            						echo "<option value= ".$data->idSatuan.">".$data->namaSatuan."</option>";
									}
								}
          						?>
								</select> 
							</div>

							<div class="form-group">
								<label for="idRak"> Rak*</label>
								<select class="form-control <?php echo form_error('idRak') ? 'is-invalid':'' ?>"
								 type="number" name="idRak" min="0" placeholder="Rak">
								<?php
								echo "<option value= ".$produk->idRak.">".$produk->namaRak."</option>";
          						foreach($rak as $data){ 
									if($data->idRak != $produk->idRak){
									echo "<option value= ".$data->idRak.">".$data->namaRak."</option>";
									}
          						}
								  ?>
								  </select>
							</div>
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