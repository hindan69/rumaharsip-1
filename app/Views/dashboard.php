<?= $this->extend('Template/index'); ?>
<?= $this->section('page_content'); ?>

<div class="content">
    <div class="row g-3">
        <div class="col-12 col-xl-6 col-xxl-12">
            <div class="mb-2">
                <div class="d-flex flex-wrap gap-3">
                    <h3 class="mb-0">Tambah Data</h3>
                </div>
            </div>
        </div>
        <div class="mx-lg-n4 mt-3">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card todo-list">
                        <div class="card-body py-0 " style="zoom: 0.9;">
                            <form id="tambahtransaksiForm" method="post" action="<?= base_url(); ?>tambaharsip" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="row mt-2">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label" for="kategori">Kategori</label>
                                        <select class="form-select" id="selectkategori">
                                            <option value="" disabled>Pilih Kategori</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label" for="subkategori">Sub Kategori</label>
                                        <select class="form-select" id="selectsubkategori">
                                            <option value="" disabled>Pilih Sub Kategori</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label" for="klasifikasi">Klasifikasi</label>
                                        <select class="form-select" id="selectklasifikasi">
                                            <option value="" disabled>Pilih Klasifikasi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label" for="klasifikasi">Jenis Arsip</label>
                                        <select class="form-select" id="selectjenisarsip">
                                            <option value="" disabled>Pilih Jenis Arsip</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label" for="klasifikasi">Jenis Naskah</label>
                                        <select class="form-select" id="selectjenisnaskah">
                                            <option value="" disabled>Pilih Jenis Naskah</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label" for="nomorarsip">Nomor Arsip</label>
                                        <input class="form-control" type="number" name="nomor" required />
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label" for="nomorarsip">Tanggal Arsip</label>
                                        <input class="form-control" type="date" name="nama_arsip" required />
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label" for="jumlah">Jumlah</label>
                                        <select class="form-select" id="selectjumlah">
                                            <option value="" disabled>Pilih Jumlah</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label" for="sifat">Sifat</label>
                                        <select class="form-select" id="selectsifat">
                                            <option value="" disabled>Pilih Sifat Arsip</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label" for="kelompok">Kelompok</label>
                                        <select class="form-select" id="selectkelompok">
                                            <option value="" disabled>Pilih Jenis Naskah</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label" for="nomorarsip">Nama Arsip</label>
                                            <textarea class="form-control" rows="3" name="nama_arsip" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="text-center mb-4">
                                    <button class="btn btn-primary" type="submit" id="submitButton">Submit Data</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-lg-n4 mt-3">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card todo-list">
                        <div class="card-body py-0 ">
                            <h5 class="mb-2 mt-2">Recent Arsip</h5>
                            <table id="transaksi" class="table table-bordered table-striped" style="text-align: center; width: 100%;zoom:0.8">
                                <thead>
                                    <tr>
                                        <th style="font-size: 13px;text-align: center; ">#</th>
                                        <th style="font-size: 13px;text-align: left;">Klasifikasi</th>
                                        <th style="font-size: 13px;text-align: left;">Indeks</th>
                                        <th style="font-size: 13px;text-align: left;">No Arsip</th>
                                        <th style="font-size: 13px;text-align: left;">Nama Arsip</th>
                                        <th style="font-size: 13px;text-align: left;">Tanggal</th>
                                        <th style="font-size: 13px;text-align: left;">Kategori</th>
                                        <th style="font-size: 13px;text-align: left;">Sub Kategori</th>
                                        <th style="font-size: 13px;text-align: left;">Jenis Arsip</th>
                                        <th style="font-size: 13px;text-align: left;">Jenis Naskah</th>
                                        <th style="font-size: 13px;text-align: left;">Jumlah</th>
                                        <th style="font-size: 13px;text-align: left;">Sifat</th>
                                        <th style="font-size: 13px;">Kelompok</th>
                                        <th style="font-size: 13px;">Unit</th>
                                        <th style="font-size: 13px;">File</th>
                                        <th style="font-size: 13px;">JRA</th>
                                        <th style="font-size: 13px;">Tanggal Upload</th>
                                        <th style="font-size: 13px;">User</th>
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

    <?= $this->endSection(); ?>