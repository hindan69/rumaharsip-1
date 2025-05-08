<?= $this->extend('Template/index'); ?>
<?= $this->section('page_content'); ?>

<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 20% !important;
        margin: 0 4px;
        font-weight: bold;
    }

    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
        background: linear-gradient(45deg, rgb(3, 101, 126), rgb(122, 197, 226));
        border-radius: 50% !important;
        color: white;
        border: none;
    }

    i.fas {
        font-size: 24px;
        /* Ukuran font yang diinginkan */
    }
</style>

<div class="content">
    <div class="row g-3">
        <div class="col-12 col-xl-6 col-xxl-12">
            <div class="mb-2">
                <div class="d-flex flex-wrap gap-3">
                    <h3 class="mb-0">Daftar Template Naskah</h3>
                </div>
            </div>
        </div>
        <div class="mx-lg-n4 mt-3">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card todo-list">
                        <div class="card-body py-0 mt-6 mb-4">
                            <table id="transaksi" class="table table-bordered table-striped" style="text-align: center; width: 100%;zoom:0.8">
                                <thead>
                                    <tr>
                                        <th style="font-size: 20px;text-align: center;">#</th>
                                        <th style="font-size: 20px;text-align: left;">Jenis Naskah</th>
                                        <th style="font-size: 20px;text-align: left;">Ukuran File</th>
                                        <th style="font-size: 20px;text-align: left;">Nama File</th>
                                        <th style="font-size: 20px;text-align: center;">File</th>
                                        <th class="no-export">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th><input type="text" class="form-control form-control-sm" style="font-size: 18px;text-align: left;" placeholder="Cari Jenis Naskah" /></th>
                                        <th><input type="text" class="form-control form-control-sm" style="font-size: 18px;text-align: left;" placeholder="Cari Ukuran" /></th>
                                        <th><input type="text" class="form-control form-control-sm" style="font-size: 18px;text-align: left;" placeholder="Cari Nama File" /></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($jenis_naskah as $item): ?>
                                        <tr>
                                            <td style="font-size: 18px;text-align: center;"><?= $item->id ?></td>
                                            <td style="font-size: 18px;text-align: left;"><?= $item->nama_sub_kategori ?></td>
                                            <td style="font-size: 18px;text-align: left;"><?= $item->ukuran_file ? $item->ukuran_file : '- kb' ?></td>
                                            <td style="font-size: 18px;text-align: left;"><?= $item->nama_template ? $item->nama_template : '-' ?></td>
                                            <td>
                                                <?php if ($item->path_file): ?>
                                                    <a href="<?= base_url('uploads/template/' . $item->path_file) ?>" target="_blank" style="color: #007BFF;">
                                                        <i class="fas fa-file-word fa-lg"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <i class="fas fa-file-word fa-lg" style="color: red;"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <!-- <a href="<?= base_url('uploads/template/' . $item->path_file) ?>" target="_blank">
                                                    <i class="fas fa-eye fa-lg text-info"></i>
                                                </a> -->
                                                <!-- Mengubah tombol tambah menjadi ikon plus dengan ukuran yang sama -->
                                                <button class="btn btn-link btn-sm openAddTemplateModal"
                                                    data-id_kategori="<?= $item->id_kategori ?>"
                                                    data-id_sub_kategori="<?= $item->id ?>">
                                                    <i class="fas fa-edit fa-lg text-warning"></i>
                                                </button>
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
</div>

<!-- Modal untuk tambah template naskah -->
<div class="modal fade" id="addTemplateModal" tabindex="-1" role="dialog" aria-labelledby="addTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formTambahTemplate" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf-token" />
                <div class="modal-header">
                    <h5 class="modal-title" id="addTemplateModalLabel">Tambah Data Template Naskah</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_kategori" id="id_kategori" value="<?= $item->id_kategori ?>">
                    <input type="hidden" name="id_sub_kategori" id="id_sub_kategori" value="<?= $item->id ?>">
                    <div class="form-group mb-2">
                        <label class="text-body-highlight fw-bold mb-2" for="nama_template">Nama Template</label>
                        <input class="form-control" id="nama_template" type="text" name="nama_template" placeholder="Nama Template" required />
                    </div>
                    <div class="form-group mb-2">
                        <label class="text-body-highlight fw-bold mb-2" for="path_file">Upload File</label>
                        <input class="form-control" type="file" id="path_file" name="path_file" required>
                        <span style="font-size: 12px; color:red; font-style:italic; font-weight:bold;">file yang didukung hanya file dengan ekstensi .docx dengan ukuran maksimal <b>5mb</b></span>

                        <div id="fileLamaInfo"></div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="text-body-highlight fw-bold mb-2" for="ukuran_file">Ukuran File (kb)</label>
                        <input class="form-control" id="ukuran_file" type="text" name="ukuran_file" readonly />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveTemplateNaskah" name="saveTemplateNaskah">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        // Custom filter per kolom
        $('#transaksi thead tr:eq(1) th').each(function(i) {
            $('input', this).on('keyup change', function() {
                if ($('#transaksi').DataTable().column(i).search() !== this.value) {
                    $('#transaksi').DataTable().column(i).search(this.value).draw();
                }
            });
        });

        $('#transaksi').DataTable({
            pageLength: 10,
            orderCellsTop: true,
            fixedHeader: true,
            language: {
                paginate: {
                    previous: "<",
                    next: ">"
                }
            },
            pagingType: "numbers" // Hanya < dan > tanpa nomor halaman
        });
    });

    function appendCsrfToken(formData) {
        const csrfInput = document.querySelector('input[name^="csrf"]');
        if (csrfInput) {
            formData.append(csrfInput.name, csrfInput.value);
        }
    }

    // Menginisialisasi tombol untuk membuka modal
    $(document).ready(function() {
        $('.openAddTemplateModal').click(function() {
            var idKategori = $(this).data('id_kategori');
            var idSubKategori = $(this).data('id_sub_kategori');

            $('#id_kategori').val(idKategori);
            $('#id_sub_kategori').val(idSubKategori);

            // Reset form terlebih dahulu
            $('#formTambahTemplate')[0].reset();
            $('#fileLamaInfo').html(''); // clear old file info

            // Panggil data lama via AJAX
            $.ajax({
                url: '/templatesurat/ambil',
                type: 'GET',
                data: {
                    id_sub_kategori: idSubKategori
                },
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $('#nama_template').val(data.nama_template);
                        $('#ukuran_file').val(data.ukuran_file);

                        if (data.path_file) {
                            $('#fileLamaInfo').html(
                                `<div class="mt-2">File sebelumnya: 
                            <a href="/uploads/template/${data.path_file}" target="_blank">${data.path_file}</a>
                        </div>`
                            );
                        }
                    }
                }
            });

            $('#addTemplateModal').modal('show');
        });

    });

    // Hitung ukuran file saat file dipilih
    $('#path_file').on('change', function() {
        const file = this.files[0];
        if (file) {
            const sizeKb = Math.round(file.size / 1024);
            $('#ukuran_file').val(sizeKb);
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("path_file").addEventListener("change", function() {
            var file = this.files[0];
            if (file) {
                var fileName = file.name.toLowerCase();
                var fileSize = file.size;
                var maxSize = 5 * 1024 * 1024; // 5 MB
                var allowedExtensions = /\.(doc|docx)$/i;

                if (!allowedExtensions.exec(fileName)) {
                    Swal.fire({
                        title: "Error!",
                        text: "Hanya file dengan ekstensi .doc atau .docx yang diperbolehkan!",
                        icon: "error",
                        confirmButtonText: "OK"
                    }).then(() => {
                        this.value = "";
                    });
                } else if (fileSize > maxSize) {
                    Swal.fire({
                        title: "Error!",
                        text: "Ukuran file maksimal 5MB!",
                        icon: "error",
                        confirmButtonText: "OK"
                    }).then(() => {
                        this.value = "";
                    });
                }
            }
        });
    });

    // Menangani submit form tambah template
    $(document).ready(function() {
        $('#saveTemplateNaskah').on('click', function() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data akan disimpan, mohon periksa kembali informasi yang anda input!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(document.querySelector('#formTambahTemplate'));
                    appendCsrfToken(formData);

                    $.ajax({
                        url: '/templatesurat/simpan',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.csrf_token) {
                                $('#csrf_token').val(response.csrf_token);
                            }

                            if (response.status === 'success') {
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                }).then(() => {
                                    location.reload();
                                });

                                $('#formTambahTemplate')[0].reset();
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menyimpan data.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>