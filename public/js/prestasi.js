function cekPrestasi() {
    let optionTambah = document.querySelector("#option_prestasi").value;
    let area = document.querySelector("#jumlah_prestasi_area");
    let label = document.querySelector("#label_jumlah_prestasi");
    let prestasiForm = document.querySelector("#tambah_prestasi_form");

    if (optionTambah == "yes") {
        label.removeAttribute("hidden");
        area.innerHTML =
            '<input type="number" class="form-control" id="jumlah_prestasi" name="jumlah_prestasi"placeholder="Jumlah prestasi" value="1" min="1" onchange="cekJumlahPrestasi()">';
        prestasiForm.innerHTML =
            '<label for="contoh_tambah_prestasi">Prestasi 1</label><select class="form-control" name="contoh_tambah_prestasi" id="contoh_tambah_prestasi" required><option value="" selected disabled hidden>-- Pilih prestasi --</option>@foreach ($prestasi as $p) @if (old("contoh_tambah_prestasi") == $p->id)<option value="{{ $p->id }}" selected>{{ $p->nama }}</option>@else<option value="{{ $p->id }}">{{ $p->nama }}</option>@endif@endforeach</select>';
    } else {
        label.setAttribute("hidden", true);
        area.innerHTML = "";
        prestasiForm.innerHTML = "";
    }
}

function cekJumlahPrestasi() {
    let jumlahPrestasi = document.querySelector("#jumlah_prestasi").value;
    let prestasiForm = document.querySelector("#tambah_prestasi_form");
    let kelas = "";

    for (let index = 0; index < jumlahPrestasi; index++) {
        if (index != 1) {
            kelas = "class=mt-2";
        }

        prestasiForm.innerHTML =
            '<label for="contoh_tambah_prestasi">Prestasi 1</label><select class="form-control" name="contoh_tambah_prestasi" id="contoh_tambah_prestasi" required><option value="" selected disabled hidden>-- Pilih prestasi --</option>@foreach ($prestasi as $p) @if (old("contoh_tambah_prestasi") == $p->id)<option value="{{ $p->id }}" selected>{{ $p->nama }}</option>@else<option value="{{ $p->id }}">{{ $p->nama }}</option>@endif@endforeach</select>';
    }
}
