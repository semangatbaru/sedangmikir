<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="#">
            <i class="fas fa-exclamation"></i>
            <span>Informasi Pribadi</span>
        </a>
    </li>
    <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'products' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Pesan</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="#">Tulis Pesan</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/products') ?>">Kotak Masuk</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/products') ?>">Kotak Keluar</a>
        </div>
    </li>
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="#">
            <i class="fa fa-address-book"></i>
            <span>Kontak</span>
        </a>
    </li>
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="#">
            <i class="  fa fa-wrench"></i>
            <span>Settings</span>
        </a>
    </li>
</ul>