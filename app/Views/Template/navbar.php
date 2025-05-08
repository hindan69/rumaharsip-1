<nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault">
    <div class="collapse navbar-collapse justify-content-between">
        <div class="navbar-logo">

            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="<?= base_url(); ?>">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center"><img src="<?= base_url(); ?>Phoenix/assets/img/icons/logo.png" alt="phoenix" width="27" />
                        <h5 class="logo-text ms-2 d-none d-sm-block">RUMAH <b>ARSIP</b></h5>
                    </div>
                    <span>&nbsp;</span>
                    <h6 class="fw-light overflow-hidden" style="vertical-align: bottom;">Inspektorat
                        <span class="typed-text fw-bold" data-typed-text="[&quot;Jenderal&quot;,&quot;Jenderal&quot;, &quot;Jenderal&quot;]"></span>
                    </h6>
                    <br>

                </div>

            </a>
        </div>


    </div>
    <ul class="navbar-nav navbar-nav-icons flex-row">
        <li class="nav-item">
            <div class="theme-control-toggle fa-icon-wait px-2">
                <input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" />
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Switch theme" style="height:32px;width:32px;"><span class="icon" data-feather="moon"></span></label>
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Switch theme" style="height:32px;width:32px;"><span class="icon" data-feather="sun"></span></label>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" href="#" style="min-width: 2.25rem" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside"><span class="d-block" style="height:20px;width:20px;"><span data-feather="bell" style="height:20px;width:20px;"></span></span></a>

            <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border navbar-dropdown-caret" id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">

            </div>
        </li>

        <?php if (session()->has('token')) : ?>
            <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-l ">
                        <img class="rounded-circle " src="<?= base_url(); ?>Phoenix/assets/img/team/40x40/57.webp" alt="" />

                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border" aria-labelledby="navbarDropdownUser">
                    <div class="card position-relative border-0">
                        <div class="card-body p-0">
                            <div class="text-center pt-4 pb-3">
                                <div class="avatar avatar-xl ">
                                    <img class="rounded-circle " src="<?= base_url(); ?>Phoenix/assets/img/team/72x72/57.webp" alt="" />

                                </div>
                                <?php if (session()->has('nama')) : ?>
                                    <h6 class="mt-2 text-body-emphasis"><?= session()->get('nama') ?></h6>
                                <?php endif; ?>
                            </div>

                        </div>
                        <div class="overflow-auto scrollbar" style="height: 10rem;">
                            <ul class="nav d-flex flex-column mb-2 pb-1">
                                <li class="nav-item"><a class="nav-link px-3 d-block" href="#!"> <span class="me-2 text-body align-bottom" data-feather="user"></span><span>Profile</span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-block" href="<?= base_url(); ?>dashboard"><span class="me-2 text-body align-bottom" data-feather="pie-chart"></span>Dashboard</a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-block" href="#!"> <span class="me-2 text-body align-bottom" data-feather="lock"></span>Activity</a></li>

                            </ul>
                        </div>
                        <div class="card-footer p-0 border-top border-translucent">
                            <br>
                            <div class="px-3">
                                <a class="btn btn-phoenix-secondary d-flex flex-center w-100" id="logoutBtn" href="<?= base_url(); ?>logout">
                                    <span class="me-2" data-feather="log-out"></span>
                                    <span>Sign out</span>
                                </a>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </li>
        <?php else : ?>
            <a href="<?= base_url(); ?>" class="btn">Log In</a>
            <!-- <button style="background-color: transparent; border: none; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</button> -->

        <?php endif; ?>
    </ul>
    </div>
</nav>

<script>
    document.getElementById('logoutBtn').addEventListener('click', function() {
        sessionStorage.removeItem('openAccordion');
    });
</script>