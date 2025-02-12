@extends('layout.index')

@section('title', 'Tambah Katalog')

@section('css')

@section('breadcumb')
<div class="page-header">
    <h1 class="my-auto page-title">Tambah Data Katalog</h1>
    <div>
        <ol class="mb-0 breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route(" katalog.index") }}">Katalog</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Tambah Katalog
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Data Katalog
                </div>
                <div class="prism-toggle">
                    <a href="{{ route('katalog.index') }}" class="btn btn-sm btn-danger-light">
                        Kembali
                    </a>
                </div>
            </div>
            <form id="projectForm" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="namaProject" class="form-label">Nama Project</label>
                        <input type="text" class="form-control" id="namaProject" name="namaProject"
                            placeholder="Masukkan Pertanyaan">
                    </div>
                    <div class="mt-3 form-group">
                        <label for="deskripsiProject" class="form-label">Deskripsi Singkat Project</label>
                        <textarea name="deskripsiProject" class="form-control" id="deskripsiProject" rows="5"
                            placeholder="Masukkan Deskripsi Project"></textarea>
                    </div>
                    <button id="addDocumentation" class="mt-4 btn btn-primary-light btn-sm">
                        Tambah Dokumentasi Project
                    </button>

                    <div id="documentationContainer" class="mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="file" name="dokumentasi[]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger-light btn-sm">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success-light btn-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    document.getElementById("addDocumentation").addEventListener("click", function (e) {
    e.preventDefault();

    let container = document.getElementById("documentationContainer");
    let lastRow = container.lastElementChild;

    let totalCols = Array.from(lastRow.children).reduce((sum, col) => {
        return sum + (parseInt(col.classList[0].replace("col-md-", "")) || 0);
    }, 0);

    if (totalCols >= 12) {
        lastRow = document.createElement("div");
        lastRow.classList.add("row", "mt-4");
        container.appendChild(lastRow);
    }

    let newInput = document.createElement("div");
    newInput.classList.add("col-md-4", "position-relative");
    newInput.innerHTML = `
        <input type="file" name="dokumentasi[]" class="form-control">
        <button type="button" class="top-0 btn btn-danger btn-sm position-absolute end-0 remove-input">X</button>
    `;

    lastRow.appendChild(newInput);
});


    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-input")) {
            let parentCol = e.target.parentElement;
            let parentRow = parentCol.parentElement;
            parentCol.remove();

            if (parentRow.children.length === 0) {
                parentRow.remove();
            }
        }
    });

    $("#projectForm").on("submit", function(e) {
        e.preventDefault()

        let formData = new FormData(this)

        $.ajax({
            url: "{{ url('/master/katalog/store') }}",
            method: "POST",
            data: formData
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error: " + textStatus + ': ' + errorThrown);
                alert("Gagal mengirim data!");
            }
        })
    })
</script>
@endsection
