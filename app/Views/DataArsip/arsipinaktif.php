<div class="accordion-collapse collapse" id="collapseArsipInaktif" data-bs-parent="#myAccordion">
    <div class="border border-translucent p-3 rounded">
        <div class="row">
            <!-- Form kiri: Pesan Nomor Box -->
            <div class="col-md-4">
                <form id="formPesanNomor" method="post">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf-token" />
                    <h5>Pesan Nomor Box</h5>
                    <div class="mb-3">
                        <label class="form-label" for="tahun_box">Tahun Box Arsip <span class="text-danger">*</span></label>
                        <select class="form-select" name="tahun_box" id="tahun_box" required>
                            <option value="" disabled selected>Pilih Tahun</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="no_kotak">Nomor Box <span class="text-danger">*</span></label>
                        <select class="form-select" name="no_kotak" id="no_kotak" required>
                            <option value="" disabled selected>Pilih Nomor Box</option>
                        </select>
                        <span id="nomorKotakKeterangan" class="text-muted mt-2"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="no_awal">Nomor Urut Awal <span class="text-danger">*</span></label>
                        <select class="form-select" name="no_awal" id="no_awal" required>
                            <option value="" disabled selected>Pilih Nomor Awal</option>
                        </select>
                        <span id="nomorAkhirKeterangan" class="text-muted mt-2"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="no_akhir">Nomor Urut Akhir <span class="text-danger">*</span></label>
                        <select class="form-select" name="no_akhir" id="no_akhir" required>
                            <option value="" disabled selected>Pilih Nomor Akhir</option>
                        </select>
                    </div>
                    <div class="text-end mt-3">
                        <button class="btn btn-primary" type="submit" id="submitPesanNomor">Pesan Nomor</button>
                    </div>
                </form>
            </div>

            <!-- Form kanan: Tambah Arsip Inaktif -->
            <div class="col-md-8">
                <form id="formTambahArsipInaktif" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf-token" />
                    <h5>Tambah Arsip Inaktif</h5>
                    <div class="row mt-2">
                        <div class="col-md-8 mb-2">
                            <label class="form-label" for="inaktif_id_klasifikasi_surat">Klasifikasi <span class="text-danger">*</span></label>
                            <select class="form-select select2" name="inaktif_id_klasifikasi_surat" id="inaktif_id_klasifikasi_surat" required>
                                <option value="" disabled selected>Pilih Klasifikasi</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label" for="inaktif_id_kelompok_arsip">Kelompok Arsip <span class="text-danger">*</span></label>
                            <select class="form-select" name="inaktif_id_kelompok_arsip" id="inaktif_id_kelompok_arsip" required>
                                <option value="" disabled selected>Pilih Kelompok</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 mb-2">
                            <label class="form-label" for="inaktif_tahun">Tahun Arsip <span class="text-danger">*</span></label>
                            <select class="form-select" name="inaktif_tahun" id="inaktif_tahun" required>
                                <option value="" disabled selected>Pilih Tahun Arsip Inaktif</option>
                            </select>
                        </div>
                        <div class="col-md-8 mb-2">
                            <label class="form-label" for="inaktif_indeks_berkas">Indeks Berkas <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="2" name="inaktif_indeks_berkas" id="inaktif_indeks_berkas" required></textarea>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label" for="inaktif_no_arsip">Nomor Arsip <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="inaktif_no_arsip" id="inaktif_no_arsip" required />
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label" for="inaktif_tgl_arsip">Tanggal Arsip <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="inaktif_tgl_arsip" id="inaktif_tgl_arsip" required />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="inaktif_uraian_arsip">Uraian Arsip <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="3" name="inaktif_uraian_arsip" id="inaktif_uraian_arsip" required></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-md-3 mb-2">
                            <label class="form-label" for="inaktif_id_jenis_arsip">Jenis Arsip <span class="text-danger">*</span></label>
                            <select class="form-select" name="inaktif_id_jenis_arsip" id="inaktif_id_jenis_arsip" required>
                                <option value="" disabled selected>Pilih Jenis Arsip</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label" for="inaktif_id_jenis_naskah">Jenis Naskah <span class="text-danger">*</span></label>
                            <select class="form-select" name="inaktif_id_jenis_naskah" id="inaktif_id_jenis_naskah" required>
                                <option value="" disabled selected>Pilih Jenis Arsip</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label" for="inaktif_id_tingkat_perkembangan">Tingkat Perkembangan <span class="text-danger">*</span></label>
                            <select class="form-select" name="inaktif_id_tingkat_perkembangan" id="inaktif_id_tingkat_perkembangan" required>
                                <option value="" disabled selected>Pilih Tingkat Perkembangan</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label" for="inaktif_id_jumlah_halaman">Jumlah Halaman <span class="text-danger">*</span></label>
                            <select class="form-select" name="inaktif_id_jumlah_halaman" id="inaktif_id_jumlah_halaman" required>
                                <option value="" disabled selected>Pilih Jumlah Halaman</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3 mb-2">
                            <label class="form-label" for="inaktif_id_sifat_arsip">Sifat Arsip <span class="text-danger">*</span></label>
                            <select class="form-select" name="inaktif_id_sifat_arsip" id="inaktif_id_sifat_arsip" required>
                                <option value="" disabled selected>Pilih Sifat Arsip</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label" for="inaktif_id_unit_pengelola">Unit Pengelola Arsip <span class="text-danger">*</span></label>
                            <select class="form-select" name="inaktif_id_unit_pengelola" id="inaktif_id_unit_pengelola" required>
                                <option value="" disabled selected>Pilih Unit Pengelola</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label" for="inaktif_retensi_arsip">JRA <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="inaktif_retensi_arsip" id="inaktif_retensi_arsip" required />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label" for="inaktif_keterangan">Keterangan</label>
                            <textarea class="form-control" rows="3" name="inaktif_keterangan" id="inaktif_keterangan"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="inaktif_ba_rc_itjen">Berita Acara RC Itjen</label>
                            <input class="form-control" type="text" name="inaktif_ba_rc_itjen" id="inaktif_ba_rc_itjen" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="inaktif_ba_rc_kemenkes">Berita Acara RC Kemenkes</label>
                            <input class="form-control" type="text" name="inaktif_ba_rc_kemenkes" id="inaktif_ba_rc_kemenkes" />
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="inaktif_id_box">Nomor Box <span class="text-danger">*</span></label>
                            <select class="form-select" name="inaktif_id_box" id="inaktif_id_box">
                                <option value="" disabled selected>Pilih Nomor Box</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="inaktif_no_urut">Nomor Urut <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="inaktif_no_urut" id="inaktif_no_urut" readonly />
                        </div>
                        <div class="col-md-12 mb-2">
                            <span id="infoBox" class="small text-warning mt-1"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="path_arsip">Upload File <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="path_arsip" name="path_arsip" required>
                            <span style="font-size: 12px; color:red; font-style:italic; font-weight:bold;">file yang didukung hanya file dengan ekstensi .pdf dengan ukuran maksimal <b>25mb</b></span>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button class="btn btn-primary" type="submit" id="submitArsipInaktif">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tahun_box').change(function() {
            const selectedTahun = $(this).val();
            if (!selectedTahun) return;

            $('#no_kotak').empty();
            $('#no_awal').empty();

            $.get('<?= base_url("kotak/get-nomor-by-tahun") ?>', {
                tahun: selectedTahun
            }, function(data) {
                const nextKotak = parseInt(data.next_nomor_kotak);
                const nextUrut = parseInt(data.next_nomor_akhir);

                // Batasi jumlah opsi maksimal (misalnya 100)
                const maxKotak = 100;
                const maxUrut = 5000;
                const kotakLimit = Math.min(nextKotak + 20, maxKotak);
                const urutLimit = Math.min(nextUrut + 200, maxUrut);

                let kotakOptions = '';
                for (let i = nextKotak; i <= kotakLimit; i++) {
                    kotakOptions += `<option value="${i}">${i}</option>`;
                }

                let urutOptions = '';
                for (let i = nextUrut; i <= urutLimit; i++) {
                    urutOptions += `<option value="${i}">${i}</option>`;
                }

                $('#no_kotak').html(kotakOptions).val(nextKotak).trigger('change');
                $('#no_awal').html(urutOptions).val(nextUrut).trigger('change');

                $('#nomorKotakKeterangan').html(
                    `<small class="text-warning">Nomor kotak saat ini untuk tahun ${selectedTahun} adalah: ${nextKotak}</small>`
                );
                $('#nomorAkhirKeterangan').html(
                    `<small class="text-warning">Nomor urut selanjutnya untuk tahun ${selectedTahun} adalah: ${nextUrut}</small>`
                );
            });
        });

        $('#no_awal').on('change', function() {
            const start = parseInt($(this).val());
            const noAkhir = $('#no_akhir');
            noAkhir.empty().append('<option value="" disabled selected>Pilih Nomor Akhir</option>');
            for (let i = start; i <= 5000; i++) {
                noAkhir.append(`<option value="${i}">${i}</option>`);
            }
        });

        // FORM PESAN NOMOR
        $('#formPesanNomor').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin pesan nomor ini?',
                text: 'Pastikan data sudah benar sebelum melanjutkan.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Pesan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("/kotak/pesan") ?>',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(res) {
                            if (res.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: res.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    sessionStorage.setItem('openAccordion', 'collapseArsipInaktif');
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: res.message
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: xhr.responseJSON?.message || 'Gagal mengirim data.'
                            });
                        }
                    });
                }
            });
        });

        // Ambil Nomor Boks berdasarkan Tahun
        $('#inaktif_tahun').on('change', function() {
            const tahun = $(this).val();
            $('#inaktif_id_box').html('<option value="">Loading...</option>');

            $.ajax({
                url: '/arsipinaktif/get-boxes-by-year/' + tahun,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    let options = '<option value="" disabled selected>Pilih Nomor Boks</option>';
                    data.forEach(box => {
                        options += `<option value="${box.id}">${box.no_kotak}</option>`;
                    });
                    $('#inaktif_id_box').html(options);
                    $('#inaktif_no_urut').val('');
                    $('#infoBox').html('');
                },
                error: function() {
                    $('#inaktif_id_box').html('<option value="">Gagal memuat boks</option>');
                }
            });
        });

        $(document).ready(function() {
            function toggleBoxFields() {
                const jenisNaskahId = $('#inaktif_id_jenis_naskah').val();
                if (jenisNaskahId === '2') {
                    $('#inaktif_id_box').closest('.mb-2').show();
                    $('#inaktif_no_urut').closest('.mb-2').show();
                    $('#infoBox').show();
                } else {
                    $('#inaktif_id_box').closest('.mb-2').hide();
                    $('#inaktif_no_urut').closest('.mb-2').hide();
                    $('#infoBox').hide();
                    $('#inaktif_id_box').val('');
                    $('#inaktif_no_urut').val('');
                }
            }

            // Jalankan saat halaman selesai dimuat
            toggleBoxFields();

            // Jalankan setiap kali pilihan jenis naskah berubah
            $('#inaktif_id_jenis_naskah').on('change', toggleBoxFields);
        });

        $('#inaktif_tgl_arsip').on('change', function() {
            const tglArsip = new Date(this.value);
            if (!isNaN(tglArsip)) {
                // Tambahkan 1 hari ke tanggal arsip
                tglArsip.setDate(tglArsip.getDate() + 1);

                // Format ke yyyy-mm-dd
                const minDate = tglArsip.toISOString().split('T')[0];

                // Atur atribut min ke input JRA
                $('#inaktif_retensi_arsip').attr('min', minDate);

                // Reset nilai JRA jika tidak valid
                if ($('#inaktif_retensi_arsip').val() && $('#inaktif_retensi_arsip').val() < minDate) {
                    $('#inaktif_retensi_arsip').val('');
                }
            }
        });

        // Ambil info box dan nomor urut saat memilih kotak
        $('#inaktif_id_box').on('change', function() {
            const boxId = $(this).val();

            if (!boxId) return;

            $.ajax({
                url: '/arsipinaktif/get-info-box/' + boxId,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.status === 'full') {
                        $('#inaktif_no_urut').val('');
                        $('#infoBox').html(`
                        <span class="text-danger fw-bold blinking">
                            ⚠️ Tidak tersedia nomor urut lagi pada Boks ${data.no_kotak}.
                        </span>
                    `);
                    } else {
                        $('#inaktif_no_urut').val(data.nomor_urut_berikut);
                        $('#infoBox').html(`
                        Boks nomor <b>${data.no_kotak}</b><br>
                        Tersedia <b>nomor urut ${data.nomor_urut_berikut}</b> dari rentang ${data.no_awal} - ${data.no_akhir}.
                    `);
                    }
                },
                error: function() {
                    $('#infoBox').html('<span class="text-danger small">Gagal mengambil data box.</span>');
                }
            });
        });

        const dropdowns = [{
                id: 'inaktif_id_klasifikasi_surat',
                url: 'klasifikasi'
            },
            {
                id: 'inaktif_id_kelompok_arsip',
                url: 'kelompok_arsip'
            },
            {
                id: 'inaktif_id_jenis_arsip',
                url: 'jenis_arsip'
            },
            {
                id: 'inaktif_id_jenis_naskah',
                url: 'jenis_naskah'
            },
            {
                id: 'inaktif_id_tingkat_perkembangan',
                url: 'tingkat_perkembangan'
            },
            {
                id: 'inaktif_id_jumlah_halaman',
                url: 'jumlah_halaman'
            },
            {
                id: 'inaktif_id_sifat_arsip',
                url: 'sifat_arsip'
            },
            {
                id: 'inaktif_id_unit_pengelola',
                url: 'unit_pengelola'
            },
        ];

        dropdowns.forEach(drop => {
            $.ajax({
                url: `/arsipinaktif/get-options/${drop.url}`,
                method: 'GET',
                success: function(res) {
                    let options = `<option value="" disabled selected>Pilih opsi</option>`;
                    res.forEach(item => {
                        let text;
                        if (drop.url === 'klasifikasi') {
                            text = `${item.subsub} - ${item.descsubsub}`;
                        } else {
                            text = item[`nama_${drop.url}`] ?? item.nama ?? item.kode ?? item.label;
                        }

                        if (drop.url === 'jenis_arsip') {
                            if (item.id == 2) {
                                options = `<option value="${item.id}" selected>${text}</option>`;
                            }
                        } else {
                            options += `<option value="${item.id}">${text}</option>`;
                        }
                    });

                    $(`#${drop.id}`).html(options);
                },
                error: function() {
                    console.error(`Gagal mengambil data ${drop.url}`);
                }
            });
        });

        // FORM ARSIP INAKTIF
        $('#formTambahArsipInaktif').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Simpan Data?',
                text: "Pastikan semua data telah terisi dengan benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData(this);
                    let csrfTokenName = $('.csrf-token').attr('name');
                    let csrfTokenValue = $('.csrf-token').val();
                    formData.append(csrfTokenName, csrfTokenValue);


                    $.ajax({
                        type: 'POST',
                        url: '/arsipinaktif/simpan',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(res) {
                            if (res.csrf_token) {
                                // Update token di form
                                $('.csrf-token').val(res.csrf_token);
                            }

                            if (res.status) {
                                Swal.fire('Tersimpan!', res.message, 'success');
                                $('#formTambahArsipInaktif')[0].reset(); // Reset form jika berhasil
                            } else {
                                let errors = Object.values(res.errors).join("<br>");
                                Swal.fire('Gagal!', errors, 'error'); // Tampilkan error jika ada
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Terjadi kesalahan server.', 'error', 'OK');

                            // Update token jika server mengirim token baru dalam response
                            if (xhr.responseJSON && xhr.responseJSON.csrf_token) {
                                $('.csrf-token').val(xhr.responseJSON.csrf_token); // Jika ada token baru di response
                            }
                        }

                    });
                }
            });
        });
    });
</script>