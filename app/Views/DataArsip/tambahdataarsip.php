<?= $this->extend('Template/index'); ?>
<?= $this->section('page_content'); ?>

<!-- Custom style to make select2 look like Bootstrap -->
<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
        padding: 6px 12px;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px;
    }

    .blinking {
        animation: blink 1s linear infinite;
    }

    @keyframes blink {
        50% {
            opacity: 0;
        }
    }
</style>

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
                            <div id="myAccordion">
                                <p>
                                    <a class="btn btn-phoenix-secondary mt-2 accordion-toggle" data-bs-toggle="collapse" href="#collapseArsipAktif">Arsip Aktif</a>
                                    <a class="btn btn-phoenix-secondary mt-2 accordion-toggle" data-bs-toggle="collapse" href="#collapseArsipInaktif">Arsip Inaktif</a>
                                    <a class="btn btn-phoenix-secondary mt-2 accordion-toggle" data-bs-toggle="collapse" href="#collapseArsipVital">Arsip Vital</a>
                                </p>

                                <?= $this->include('DataArsip/arsipaktif'); ?>
                                <?= $this->include('DataArsip/arsipinaktif'); ?>
                                <?= $this->include('DataArsip/arsipvital'); ?>

                            </div>
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
                            <!-- <th style="font-size: 13px;text-align: center; ">#</th> -->
                            <table id="transaksi" class="table table-bordered table-striped" style="width: 100%; zoom: 0.8">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Klasifikasi</th>
                                        <th>Indeks</th>
                                        <th>No Arsip</th>
                                        <th>Nama Arsip</th>
                                        <th>Tanggal Arsip</th>
                                        <th>Jenis Arsip</th>
                                        <th>Jenis Naskah</th>
                                        <th>Jumlah Hal</th>
                                        <th>Sifat Naskah</th>
                                        <th>Kelompok</th>
                                        <th>Unit</th>
                                        <th>JRA</th>
                                        <th>Tanggal Upload</th>
                                        <th>Diinput oleh</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // ACCORDION RESTORE
        const savedAccordionId = sessionStorage.getItem('openAccordion') || 'collapseArsipAktif';
        const savedCollapse = document.getElementById(savedAccordionId);

        if (savedCollapse) {
            new bootstrap.Collapse(savedCollapse, {
                toggle: true
            });
        }

        document.querySelectorAll('.accordion-collapse').forEach(collapseEl => {
            collapseEl.addEventListener('shown.bs.collapse', function() {
                sessionStorage.setItem('openAccordion', this.id);
                highlightButton(this.id);
            });
        });

        function highlightButton(openId) {
            document.querySelectorAll('.accordion-toggle').forEach(btn => {
                const href = btn.getAttribute('href');
                if (href === '#' + openId) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }

        highlightButton(savedAccordionId);

        // STYLING TOMBOL AKTIF
        const style = `<style>
                .accordion-toggle.active {
                    background-color:rgb(1, 129, 129) !important;
                    color: white !important;
                }
            </style>`;
        $('head').append(style);

        // Select2
        $('.select2').select2({
            placeholder: "Pilih Klasifikasi",
            width: '100%'
        });

        const tahunSekarang = new Date().getFullYear();
        for (let th = 2020; th <= tahunSekarang; th++) {
            $('#aktif_tahun, #inaktif_tahun, #tahun_box').append(`<option value="${th}">${th}</option>`);
        }

        $('#transaksi').DataTable({
            paging: true,
            pageLength: 10,
            lengthChange: false,
            searching: false,
            ordering: false,
            info: false,
            autoWidth: false
        });

        loadRecentArsip(); // panggil saat halaman pertama kali dibuka

        function loadRecentArsip() {
            $.ajax({
                url: '/arsipinaktif/recent',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const table = $('#transaksi').DataTable(); // inisialisasi DataTable jika belum

                    table.clear().draw(); // kosongkan isi lama

                    if (data.length > 0) {
                        data.forEach((item, index) => {
                            table.row.add([
                                index + 1,
                                item.klasifikasi || '-',
                                item.indeks || '-',
                                item.no_arsip || '-',
                                item.nama_arsip || '-',
                                item.tanggal_arsip || '-',
                                item.jenis_arsip || '-',
                                item.jenis_naskah || '-',
                                item.jumlah_hal || '-',
                                item.sifat_naskah || '-',
                                item.kelompok || '-',
                                item.unit || '-',
                                item.jra || '-',
                                item.tanggal_upload || '-',
                                item.diinput_oleh || '-',
                                item.file ? `<a href="/uploads/${item.file}" target="_blank">Lihat</a>` : '-',
                                '-' // kolom aksi
                            ]).draw(false);

                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Gagal load data:', error);
                }
            });
        }

    });
</script>

<?= $this->endSection(); ?>