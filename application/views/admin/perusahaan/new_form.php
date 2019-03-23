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

                <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php endif; ?>

                <div class="card mb-3">
                    <div class="card-header">
                        <a href="<?php echo site_url('admin/perusahaan/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="card-body">

                        <form action="<?php base_url('admin/perusahaan/add') ?>" method="post">
                            <div class="form-group">
                                <label for="namaPerusahaan">Nama*</label>
                                <input class="form-control <?php echo form_error('namaPerusahaan') ? 'is-invalid' : '' ?>" type="text" name="namaPerusahaan" placeholder="Nama" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('namaPerusahaan') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamatPerusahaan">Alamat Perusahaan*</label>
                                <input class="form-control <?php echo form_error('alamatPerusahaan') ? 'is-invalid' : '' ?>" type="text" name="alamatPerusahaan" min="0" placeholder="Alamat Perusahaan" />
                                <div class="invalid-feedback">
                                    <?php echo form_error('alamatPerusahaan') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="noTelp"> Nomor Telepon*</label>
                                <input class="form-control <?php echo form_error('noTelp') ? 'is-invalid' : '' ?>" type="text" name="noTelp" min="0" placeholder="Nomor Telepon">
                                <div class="invalid-feedback">
                                    <?php echo form_error('noTelp') ?>
                                </div>
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

        <?php $this->load->view("admin/_partials/modal.php") ?>

        <?php $this->load->view("admin/_partials/js.php") ?>
        <script>
            function deleteConfirm(url) {
                $('#btn-delete').attr('href', url);
                $('#deleteModal').modal();
            }
        </script>

</body>

</html> 