<?= $this->extend('Template/index'); ?>
<?= $this->section('page_content'); ?>

<style>
    .hidden {
        display: none;
    }
</style>
<style>
    /* Ubah ukuran font pada input utama */
    .choices__inner {
        font-size: 12px !important;
        height: 32px !important;
        padding: 5px 8px !important;
    }

    /* Ubah ukuran font pada daftar dropdown */
    .choices__list--dropdown .choices__item {
        font-size: 12px !important;
        padding: 5px 10px !important;
    }

    /* Perkecil tinggi pilihan yang dipilih */
    .choices__list--single {
        font-size: 12px !important;
        line-height: 30px !important;
    }

    /* Perkecil ikon hapus jika removeItemButton aktif */
    .choices__button {
        font-size: 10px !important;
        padding: 0 5px !important;
    }
</style>



<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<div class="content">
    <div class="row g-3">
        <div class="col-12 col-xl-6 col-xxl-12">
            <div class="mb-2">
                <div class="d-flex flex-wrap gap-3">
                    <h2 class="mb-0">Daftar Transaksi</h2>

                    <?php if (session()->get('userData')['role'] == 1) : ?>
                        <div class="ms-xxl-auto">
                            <button class="btn btn-primary" id="addBtn" data-bs-toggle="modal" data-bs-target="#transaksipermintaan">
                                <span class="fas fa-plus me-2"></span>Transaksi
                            </button>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <div class="mx-lg-n4 mt-3">
        <div class="row g-3">
            <div class="col-12 col-xl-6 col-xxl-12">
                <div class="card todo-list">
                    <div class="card-body py-0 ">
                        <br>
                        <table id="transaksi" class="table table-bordered table-striped" style="text-align: center; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="font-size: 13px;text-align: center; ">No</th>
                                    <th style="font-size: 13px;text-align: left;">Produk</th>
                                    <th style="font-size: 13px;text-align: left;">Jumlah</th>
                                    <th style="font-size: 13px;text-align: left;">Progress Bar</th>
                                    <th style="font-size: 13px;">Status</th>
                                    <th style="font-size: 13px;">Keterangan</th>
                                    <th style="font-size: 13px;">Tanggal</th>
                                    <th style="font-size: 13px;" class="no-export">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($transaksibyid as $row) : ?>
                                    <tr>
                                        <td style="font-size: 12px; left;padding: 8px 8px;"><?= $no++; ?></td>
                                        <td style=" font-size: 12px;text-align: left;padding: 8px 8px;"><?= $row->nama_produk; ?></td>
                                        <td style="font-size: 12px;text-align: center;padding: 8px 8px;"><?= $row->jumlah; ?></td>
                                        <td style="font-size: 12px;text-align: center;padding: 8px 8px;">
                                            <div class="progress">
                                                <?php if ($row->status == 0) : ?>
                                                    <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php elseif ($row->status == 1) : ?>
                                                    <div class="progress-bar progress-bar-striped bg-primary " role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php elseif ($row->status == 2) : ?>
                                                    <div class="progress-bar progress-bar-striped bg-success " role="progressbar" style="width: 100%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php elseif ($row->status == 3) : ?>
                                                    <div class="progress-bar progress-bar-striped bg-warning " role="progressbar" style="width: 100%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td style="font-size: 12px; text-align: center; padding: 8px 8px;">
                                            <?php if ($row->status == 0) : ?>
                                                <span class="badge badge-phoenix badge-phoenix-info">Menunggu</span>
                                            <?php elseif ($row->status == 1) : ?>
                                                <span class="badge badge-phoenix badge-phoenix-primary">Verifikasi</span>
                                            <?php elseif ($row->status == 2) : ?>
                                                <span class="badge badge-phoenix badge-phoenix-success">Selesai</span>
                                            <?php elseif ($row->status == 3) : ?>
                                                <span class="badge badge-phoenix badge-phoenix-warning">Ditolak</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="font-size: 12px;text-align: center;padding: 8px 8px;"><?= $row->keterangan; ?></td>
                                        <td style="font-size: 12px;text-align: center;padding: 8px 8px;">
                                            <?= date('d-m-Y', strtotime($row->created_date)); ?>
                                        </td>
                                        <td style="font-size: 12px;text-align: center;padding: 8px 8px;"></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- MODAL Tambah transaksi -->
                        <div class="modal fade" id="transaksipermintaan" tabindex="-1" aria-labelledby="edituserModalLabel">
                            <div class="modal-dialog modal-l ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahdataModalLabel">Tambah Transaksi Permintaan</h5>
                                        <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <form id="tambahtransaksiForm" method="post" action="<?= base_url(); ?>transaksipermintaan" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label" for="product">Produk</label>
                                                        <select class="form-select" id="organizerSingle2" data-choices="data-choices"
                                                            style="font-size: 10px; height: 30px; padding: 10px 10px;"
                                                            size="1" required="required" name="product_id"
                                                            data-options='{"removeItemButton":true,"placeholder":true}'>
                                                            <option value="" disabled>Pilih Produk</option>
                                                            <?php foreach ($produk as $p) : ?>
                                                                <option value="<?= $p->id; ?>" data-jumlah="<?= $p->jumlah; ?>">
                                                                    <?= $p->nama_produk; ?> - (<?= $p->jumlah; ?>)
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label" for="kegiatan">Jumlah</label>
                                                        <input class="form-control" type="number" name="jumlah" required />
                                                    </div>
                                                </div>
                                                <hr>
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
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '<?= session()->getFlashdata('success') ?>',
                timer: 3000,
                showConfirmButton: false
            }).then(() => {
                window.history.back(); // Kembali ke halaman sebelumnya
            });
        <?php elseif (session()->getFlashdata('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?= session()->getFlashdata('error') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>
    });
</script>


<?= $this->endSection(); ?>