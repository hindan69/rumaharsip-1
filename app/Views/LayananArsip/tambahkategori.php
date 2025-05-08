<?= $this->extend('Template/index'); ?>
<?= $this->section('page_content'); ?>

<div class="content">
    <div class="row g-3">
        <div class="text-center mb-0">
            <button class="btn btn-primary" id="addBtn" data-bs-toggle="modal" data-bs-target="#tambahkategori">
                <span class="fas fa-plus me-2"></span>Kategori
            </button>
        </div>
        <div class="mx-lg-n4 mt-3">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card todo-list">
                        <div class="card-body py-0 ">
                            <h5 class="mb-2 mt-2">List Kategori</h5>
                            <table id="transaksi" class="table table-bordered table-striped" style="text-align: center; width: 100%;zoom:0.8">
                                <thead>
                                    <tr>
                                        <th style="font-size: 13px;text-align: center;width:10% ">No</th>
                                        <th style="font-size: 13px;text-align: left;">Kategori</th>
                                        <th style="font-size: 13px;" class="no-export">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal tambah kategori -->
    <div class="modal fade" id="tambahkategori" tabindex="-1" aria-labelledby="tambahkategoriModalLabel">
        <div class="modal-dialog modal-l ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahkategoriModalLabel">Tambah Kategori</h5>
                    <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <form id="tambahtransaksiForm" method="post" action="<?= base_url(); ?>tambahkategori" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="kategori">Kategori</label>
                                    <input class="form-control" type="text" name="kategori" required />
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit" id="submitButton">Submit Data</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row g-3">
        <div class="text-center mb-0">
            <button class="btn btn-primary" id="addBtn" data-bs-toggle="modal" data-bs-target="#tambahsubkategori">
                <span class="fas fa-plus me-2"></span>Sub Kategori
            </button>
        </div>
        <div class="mx-lg-n4 mt-3">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card todo-list">
                        <div class="card-body py-0 ">
                            <h5 class="mb-2 mt-2">List Sub Kategori</h5>
                            <table id="transaksi" class="table table-bordered table-striped" style="text-align: center; width: 100%;zoom:0.8">
                                <thead>
                                    <tr>
                                        <th style="font-size: 13px;text-align: center;width:10% ">No</th>
                                        <th style="font-size: 13px;text-align: left;">Kategori</th>
                                        <th style="font-size: 13px;text-align: left;">Sub Kategori</th>
                                        <th style="font-size: 13px;" class="no-export">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal tambah sub kategori -->
        <div class="modal fade" id="tambahsubkategori" tabindex="-1" aria-labelledby="tambahkategoriModalLabel">
            <div class="modal-dialog modal-l ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahkategoriModalLabel">Tambah Kategori</h5>
                        <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <form id="tambahtransaksiForm" method="post" action="<?= base_url(); ?>tambahkategori" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="kategori">Kategori</label>
                                        <select class="form-select" id="organizerSingle2" data-choices="data-choices"
                                            style="font-size: 10px; height: 30px; padding: 10px 10px;"
                                            size="1" required="required" name="product_id"
                                            data-options='{"removeItemButton":true,"placeholder":true}'>
                                            <option value="" disabled>Pilih Kategori</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="kategori">Sub Kategori</label>
                                        <input class="form-control" type="text" name="sub_kategori" required />
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary" type="submit" id="submitButton">Submit Data</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>