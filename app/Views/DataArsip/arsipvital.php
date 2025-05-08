<div class="accordion-collapse collapse" id="collapseArsipVital" data-bs-parent="#myAccordion">
    <div class="border border-translucent p-3 rounded">
        <form id="formTambahArsipVital" method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf-token" />
            <div class="row mt-2">
                <div class="col-md-3 mb-2">
                    <label class="form-label" for="vital_klasifikasi">Klasifikasi</label>
                    <select class="form-select" name="vital_klasifikasi" id="vital_klasifikasi" required>
                        <option value="" disabled>Pilih Klasifikasi</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="vital_jenisarsip">Jenis Arsip</label>
                    <select class="form-select" name="vital_jenisarsip" id="vital_jenisarsip" required>
                        <!-- <option value="" disabled>Pilih Jenis Arsip</option> -->
                        <option value="3" selected>Vital</option>
                        <input type="hidden" name="vital_jenisarsip" value="3" />
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="vital_jenisnaskah">Jenis Naskah</label>
                    <select class="form-select" name="vital_jenisnaskah" id="vital_jenisnaskah" disabled>
                        <option value="" disabled>Pilih Jenis Naskah</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="vital_no_arsip">Nomor Arsip</label>
                    <input class="form-control" type="number" name="vital_no_arsip" id="vital_no_arsip" required />
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="vital_tgl_arsip">Tanggal Arsip</label>
                    <input class="form-control" type="date" name="vital_tgl_arsip" id="vital_tgl_arsip" required />
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="vital_jumlah_halaman">Jumlah</label>
                    <select class="form-select" name="vital_jumlah_halaman" id="vital_jumlah_halaman" required>
                        <option value="" disabled>Pilih Jumlah</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="vital_sifat_naskah">Sifat</label>
                    <select class="form-select" name="vital_sifat_naskah" id="vital_sifat_naskah" required>
                        <option value="" disabled>Pilih Sifat Arsip</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="vital_kelompok_arsip">Kelompok</label>
                    <select class="form-select" name="vital_kelompok_arsip" id="vital_kelompok_arsip" required>
                        <option value="" disabled>Pilih Kelompok Arsip</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="vital_nama_arsip">Nama Arsip</label>
                        <textarea class="form-control" rows="3" name="vital_nama_arsip" id="vital_nama_arsip" required></textarea>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center mb-4">
                <button class="btn btn-primary" type="submit" id="submitArsipVital">Simpan Data</button>
            </div>
        </form>
    </div>
</div>