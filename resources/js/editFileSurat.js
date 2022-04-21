function cekUnggahFile() {
    let option = document.querySelector("#option_file").value;
    let formUnggah = document.querySelector("#form_unggah_file");
    let theForm =
        '<label for="file_surat">File Surat</label><div class="custom-file mb-2"><input type="file" class="custom-file-input @error("file_surat") is-invalid @enderror" id="file_surat" name="file_surat"><label class="custom-file-label" for="file_surat" data-browse="Pilih file">Unggah file surat(*.pdf)</label>@error("file_surat")<div class="invalid-feedback">{{ $message }}</div>@enderror</div>';

    if (option == yes) {
        formUnggah.innerText = theForm;
    } else {
    }
}
