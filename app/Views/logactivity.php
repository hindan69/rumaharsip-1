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
        <div class="col-12 col-xl-6 col-xxl-10">
            <div class="mb-2">
                <div class="d-flex flex-wrap gap-3">
                    <h2 class="mb-0">Log Activity</h2>

                </div>
            </div>
        </div>
    </div>
    <div class="mx-lg-n4 mt-3">
        <div class="row g-3">
            <div class="col-10">
                <div class="card todo-list">
                    <div class="card-body py-0 ">
                        <br>
                        <table id="activity" class="table table-bordered table-striped" style="text-align: center; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="font-size: 13px;text-align: center; ">No</th>
                                    <th style="font-size: 13px;text-align: left;">Nama</th>
                                    <th style="font-size: 13px;text-align: left;">Aksi</th>
                                    <th style="font-size: 13px;text-align: left;">Keterangan</th>
                                    <th style="font-size: 13px;text-align: left;">Tanggal</th>
                                    <th style="font-size: 13px;">...</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($logactivity as $row) : ?>
                                    <tr>
                                        <td style="font-size: 12px;"><?= $no++; ?></td>
                                        <td style="font-size: 12px;text-align: left;"><?= $row->nama; ?></td>
                                        <td style="font-size: 12px;text-align: left;"><?= $row->action; ?></td>
                                        <td style="font-size: 12px;text-align: left;"><?= $row->keterangan; ?></td>
                                        <td style="font-size: 12px;text-align: left;"><?= $row->date_created; ?></td>
                                        <td>
                                            <div class="btn-reveal-trigger">
                                                <button class="btn btn-sm ms-auto dropdown-toggle dropdown-caret-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="badge badge-phoenix fs-10 badge-phoenix-success">Detail</span></button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#!"><?= $row->ip_address; ?></a>
                                                    <a class="dropdown-item" href="#!"><?= $row->user_agent; ?></a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>




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
<script>
    $(document).ready(function() {
        $('#activity').DataTable({
            paging: true, // Aktifkan pagination
            searching: true, // Aktifkan fitur search
            ordering: true, // Aktifkan sorting
            info: true, // Tampilkan info jumlah data
            autoWidth: false, // Pastikan tabel tidak auto-resize
            responsive: true // Pastikan tabel responsif
        });

        console.log("DataTables telah diinisialisasi."); // Debugging
    });
</script>


<?= $this->endSection(); ?>