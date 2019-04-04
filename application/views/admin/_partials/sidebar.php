<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('admin') ?>">
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
            <a class="dropdown-item" href="<?php echo site_url('admin/produk/add') ?>">Tambah Produk</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/produk') ?>">Daftar Produk</a>
        </div>
    </li>
    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'perusahaan' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-building"></i>
            <span>Perusahaan</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/perusahaan/add') ?>">Tambah Perusahaan</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/perusahaan') ?>">Daftar Perusahaan</a>
        </div>
    </li>
    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'faktur' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-file"></i>
            <span>Faktur</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/faktur/tambahFaktur') ?>">Tambah Faktur</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/faktur') ?>">Faktur Sementara</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/faktur/indexFinal') ?>">Faktur Akhir</a>
        </div>
    </li>

    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'kontraBon' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kontra Bon</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/kontraBon/tambahKontraBon') ?>">Tambah Kontra Bon</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/kontraBon') ?>">Kontra Bon Sementara</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/kontraBon/indexFinal') ?>">Kontra Bon AKhir</a>
        </div>
    </li>

    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'dokumen' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Laporan</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/laporan') ?>">Laporan Defekta</a>
        </div>
    </li>
    
</ul>