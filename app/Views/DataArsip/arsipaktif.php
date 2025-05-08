<div class="accordion-collapse collapse" id="collapseArsipAktif" data-bs-parent="#myAccordion">
    <div class="border border-translucent p-3 rounded">
        <form id="formTambahArsipAktif" method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf-token" />
            <div class="row mt-2">
                <div class="col-md-3 mb-2">
                    <label class="form-label" for="aktif_klasifikasi">Klasifikasi</label>
                    <select class="form-select" name="aktif_klasifikasi" id="aktif_klasifikasi" required>
                        <option value="" disabled>Pilih Klasifikasi</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="aktif_jenisarsip">Jenis Arsip</label>
                    <select class="form-select" name="aktif_jenisarsip" id="aktif_jenisarsip" required>
                        <option value="" disabled>Pilih Jenis Arsip</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="aktif_jenisnaskah">Jenis Naskah</label>
                    <select class="form-select" name="aktif_jenisnaskah" id="aktif_jenisnaskah" required>
                        <option value="" disabled>Pilih Jenis Naskah</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="aktif_no_arsip">Nomor Arsip</label>
                    <input class="form-control" type="number" name="aktif_no_arsip" id="aktif_no_arsip" required />
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="aktif_tgl_arsip">Tanggal Arsip</label>
                    <input class="form-control" type="date" name="aktif_tgl_arsip" id="aktif_tgl_arsip" required />
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="aktif_jumlah_halaman">Jumlah</label>
                    <select class="form-select" name="aktif_jumlah_halaman" id="aktif_jumlah_halaman" required>
                        <option value="" disabled>Pilih Jumlah</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="aktif_sifat_naskah">Sifat</label>
                    <select class="form-select" name="aktif_sifat_naskah" id="aktif_sifat_naskah" required>
                        <option value="" disabled>Pilih Sifat Arsip</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="aktif_kelompok_arsip">Kelompok</label>
                    <select class="form-select" name="aktif_kelompok_arsip" id="aktif_kelompok_arsip" required>
                        <option value="" disabled>Pilih Kelompok Arsip</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="aktif_nama_arsip">Nama Arsip</label>
                        <textarea class="form-control" rows="3" name="aktif_nama_arsip" id="aktif_nama_arsip" required></textarea>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center mb-4">
                <button class="btn btn-primary" type="submit" id="submitArsipAktif">Simpan Data</button>
            </div>
        </form>
    </div>
</div>