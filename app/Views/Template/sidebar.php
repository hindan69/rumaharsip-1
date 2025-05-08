<nav class="navbar navbar-vertical navbar-expand-lg">
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">


                <li class="nav-item">
                    <!-- label-->
                    <hr class="navbar-vertical-line" />
                    <div class="nav-item-wrapper"><a class="nav-link label-1" href="<?= base_url(); ?>" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="home"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Dashboard</span></span>
                            </div>
                        </a>
                    </div>

                    <!-- <p class="navbar-vertical-label">Master
                    </p>
                    <hr class="navbar-vertical-line" />
                    <div class="nav-item-wrapper"><a class="nav-link label-1" href="<?= base_url(); ?>produkhukum" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="users"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Tambah Arsip</span></span>
                            </div>
                        </a>
                    </div> -->
                    <p class="navbar-vertical-label">Layanan
                    </p>
                    <hr class="navbar-vertical-line" />
                    <div class="nav-item-wrapper"><a class="nav-link label-1" href="<?= base_url(); ?>produkhukum" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="users"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Produk Hukum</span></span>
                            </div>
                        </a>
                    </div>
                    <div class="nav-item-wrapper"><a class="nav-link label-1" href="<?= base_url(); ?>templatesurat" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="book-open"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Template Surat</span></span>
                            </div>
                        </a>
                    </div>
                    <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-landing1" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-landing1">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-icon"><span data-feather="globe"></span></span><span class="nav-link-text">Katalog Arsip</span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-landing1">
                                <li class="collapsed-nav-item-title d-none">Katalog Arsip
                                </li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>arsipaktif">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Arsip Aktif</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>arsipinaktif">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Arsip Inaktif</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>arsipvital">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Arsip Vital</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-landing2" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-landing2">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-icon"><span data-feather="globe"></span></span><span class="nav-link-text">Penyusutan Arsip</span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-landing2">
                                <li class="collapsed-nav-item-title d-none">Penyusutan Arsip
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../pages/landing/default.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Pemindahan</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../pages/landing/alternate.html">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Penghapusan</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="nav-item-wrapper"><a class="nav-link label-1" href="<?= base_url(); ?>kebijakankearsipan" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="book-open"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Kebijakan Kearsipan</span></span>
                            </div>
                        </a>
                    </div>
                    <div class="nav-item-wrapper"><a class="nav-link label-1" href="<?= base_url(); ?>templatesurat" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="book-open"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Panduan Penggunaan</span></span>
                            </div>
                        </a>
                    </div>

                    <p class="navbar-vertical-label">Admin
                    </p>
                    <hr class="navbar-vertical-line" />
                    <div class="nav-item-wrapper"><a class="nav-link label-1" href="<?= base_url(); ?>manajemenuser" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="users"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Manajemen User</span></span>
                            </div>
                        </a>
                    </div>
                    <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-landing" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-landing">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-icon"><span data-feather="globe"></span></span><span class="nav-link-text">Manajemen Arsip</span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-landing">
                                <li class="collapsed-nav-item-title d-none">Manajemen Arsip
                                </li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>tambaharsip">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Tambah Data</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>tambahkategori">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Tambah Kategori</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                        </div>
                    </div>


                    <p class="navbar-vertical-label">Log
                    </p>
                    <hr class="navbar-vertical-line" />
                    <div class="nav-item-wrapper"><a class="nav-link label-1" href="<?= base_url(); ?>logtransaksi" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="file-text"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Log Transaksi</span></span>
                            </div>
                        </a>
                    </div>
                    <div class="nav-item-wrapper"><a class="nav-link label-1" href="<?= base_url(); ?>logactivity" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="table"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Log Activity</span></span>
                            </div>
                        </a>
                    </div>



            </ul>
        </div>
    </div>
    <div class="navbar-vertical-footer">
        <button class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center"><span class="uil uil-left-arrow-to-left fs-8"></span><span class="uil uil-arrow-from-right fs-8"></span><span class="navbar-vertical-footer-text ms-2">Collapsed View</span></button>
    </div>
</nav>

<script>
    function openCalculator() {
        window.open('calc', '_blank', 'width=600,height=600');
    }
</script>