<?= $this->extend('Template/index'); ?>
<?= $this->section('page_content'); ?>

<style>
    .hidden {
        display: none;
    }
</style>
<script>
    var csrfName = '<?= csrf_token() ?>'; // Nama CSRF Token
    var csrfHash = '<?= csrf_hash() ?>'; // Nilai CSRF Token

    function updateCsrfToken() {
        $.get("<?= base_url('csrf-refresh') ?>", function(data) {
            csrfHash = data.csrf_token; // Update token CSRF terbaru
        });
    }
</script>

<div class="content">

    <div class="row g-3">
        <div class="col-12 col-xl-6 col-xxl-8">
            <div class="mb-2">
                <div class="d-flex flex-wrap gap-3">
                    <h2 class="mb-0">Daftar Kategori</h2>
                    <div class="ms-xxl-auto">
                        <button class="btn btn-primary" id="addBtn" data-bs-toggle="modal" data-bs-target="#tambahkategori">
                            <span class="fas fa-plus me-2"></span>Kategori
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-lg-n4 mt-3">
        <div class="row g-3">
            <div class="col-12 col-xl-6 col-xxl-8">
                <div class="card todo-list">
                    <div class="card-body py-0 ">
                        <br>
                        <table id="kategori" class="table table-bordered table-striped" style="text-align: center; width: 100%;">
                            <thead>
                                <tr style="height: 30px;">
                                    <th style="font-size: 12px; padding: 5px 8px; text-align: center;">No</th>
                                    <th style="font-size: 12px; padding: 5px 8px; text-align: left;">ID / Kode</th>
                                    <th style="font-size: 12px; padding: 5px 8px;text-align: left;">Kategori</th>
                                    <th style="font-size: 12px; padding: 5px 8px;" class="no-export">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($kategori as $row) : ?>
                                    <tr style="height: 30px;">
                                        <td style="font-size: 12px; padding: 8px 8px;"><?= $no++; ?></td>
                                        <td style="font-size: 12px; padding: 8px 8px; text-align: left;"><?= $row->id; ?></td>
                                        <td style="font-size: 12px; padding: 8px 8px; text-align: left;"><?= $row->kategori; ?></td>
                                        <td style="font-size: 12px; padding: 8px 8px;" class="no-export">
                                            <button type="button" class="btn btn-falcon-danger btn-sm delete-btn" data-id="<?= $row->id; ?>" style="padding: 2px 6px; font-size: 11px;">
                                                <span class="fas fa-trash"></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>


                        <!-- MODAL EDIT USER -->
                        <div class="modal fade" id="tambahkategori" tabindex="-1" aria-labelledby="edituserModalLabel">
                            <div class="modal-dialog modal-l ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahdataModalLabel">Tambah Kategori</h5>
                                        <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <form id="tambahKategoriForm" method="post" action="<?= base_url(); ?>tambahkategori" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label" for="nama">Kode Kategori</label>
                                                        <input class="form-control" id="nama" type="text" name="id" required />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label" for="kegiatan">Nama Kategori</label>
                                                        <input class="form-control" id="nip" type="text" name="kategori" required />
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
        $("#tambahKategoriForm").submit(function(e) {
            e.preventDefault(); // Mencegah reload

            var formData = $(this).serialize(); // Ambil data form

            $.ajax({
                type: "POST",
                url: "<?= base_url('tambahkategori'); ?>",
                data: formData,
                dataType: "json",
                beforeSend: function() {
                    $("#submitButton").prop("disabled", true);
                },
                success: function(response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // Refresh setelah swal ditutup
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                    $("#submitButton").prop("disabled", false);
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan, coba lagi.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    $("#submitButton").prop("disabled", false);
                }
            });
        });
    });
</script>
<script>
    $(".delete-btn").click(function() {
        var id = $(this).data("id");
        console.log("Menghapus kategori dengan ID:", id); // Debugging

        if (!id) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'ID kategori tidak ditemukan.',
                timer: 3000,
                showConfirmButton: false
            });
            return;
        }

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('hapusKategori'); ?>",
                    data: {
                        id: id,
                        [csrfName]: csrfHash // Kirim CSRF Token

                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response); // Debugging Response dari Server
                        if (response.status === "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: response.message,
                                timer: 3000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message,
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", xhr.responseText); // Debugging Error Server
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan server.',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#kategori').DataTable({
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