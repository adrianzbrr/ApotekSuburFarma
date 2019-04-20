<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('overview') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Overview</span>
        </a>
    </li>
    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'products' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Produk</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <?php if($this->session->userdata('idJabatan')==1){ ?>
            <a class="dropdown-item" href="<?php echo site_url('produk/add') ?>">Tambah Produk</a>
        <?php } ?>
            <a class="dropdown-item" href="<?php echo site_url('produk') ?>">Daftar Produk</a>
        </div>
    </li>
    <?php if($this->session->userdata('idJabatan')==1){ ?>
    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'perusahaan' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-building"></i>
            <span>Perusahaan</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('perusahaan/add') ?>">Tambah Perusahaan</a>
            <a class="dropdown-item" href="<?php echo site_url('perusahaan') ?>">Daftar Perusahaan</a>
        </div>
    </li>
    <?php } ?>

    <?php if($this->session->userdata('idJabatan')==1){ ?>
    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'rak' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-inbox"></i>
            <span>Rak</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('rak/add') ?>">Tambah Rak</a>
            <a class="dropdown-item" href="<?php echo site_url('rak') ?>">Daftar Rak</a>
        </div>
    </li>
    <?php } ?>

    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'faktur' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Pemesanan</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <?php if($this->session->userdata('idJabatan')==1){ ?>
            <a class="dropdown-item" href="<?php echo site_url('pesanan/add') ?>">Tambah Pesanan</a>
            <a class="dropdown-item" href="<?php echo site_url('pesanan') ?>">Pesanan Sementara</a>
        <?php } ?>
            <a class="dropdown-item" href="<?php echo site_url('pesanan/indexFinal') ?>">Pesanan Akhir</a>
        </div>
    </li>
    <?php if($this->session->userdata('idJabatan')==1){ ?>
    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'faktur' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-file"></i>
            <span>Faktur</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('faktur/add') ?>">Tambah Faktur</a>
            <a class="dropdown-item" href="<?php echo site_url('faktur') ?>">Faktur Sementara</a>
            <a class="dropdown-item" href="<?php echo site_url('faktur/indexFinal') ?>">Faktur Akhir</a>
        </div>
    </li>
    <?php } ?>

    <?php if($this->session->userdata('idJabatan')==1){ ?>
    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'kontraBon' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kontra Bon</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('kontraBon/add') ?>">Tambah Kontra Bon</a>
            <a class="dropdown-item" href="<?php echo site_url('kontraBon') ?>">Kontra Bon Sementara</a>
            <a class="dropdown-item" href="<?php echo site_url('kontraBon/indexFinal') ?>">Kontra Bon Akhir</a>
        </div>
    </li>
    <?php } ?>

    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('laporan') ?>">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Laporan Defekta</span>
        </a>
    </li>
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('laporan/expiredReport') ?>">
            <i class="fas fa-fw fa-history"></i>
            <span>Laporan Kadaluarsa</span>
        </a>
    </li>
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('pengguna') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span>
        </a>
    </li>
</ul>