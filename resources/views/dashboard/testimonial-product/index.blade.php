@extends('layout.index')

@section('title', 'Testimonials Product')

@section('css')

<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">

@section('breadcumb')
    <div class="page-header">
        <h1 class="my-auto page-title">Data Akun Testimonial Produk</h1>
        <div>
            <ol class="mb-0 breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Testimonial Produk
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
                        Data Testimonial Produk
                    </div>
                    <div class="prism-toggle">
                        <button type="button" class="btn btn-sm btn-primary-light" data-bs-toggle="modal"
                            data-bs-target="#modalTambahData">
                            Tambah Data
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="modalTambahDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel1">
                        Tambah Data
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahData">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="editorName" class="form-label">Nama</label>
                            <div id="editorName" style="height: 200px;"></div>
                            <input type="hidden" name="name" id="name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="editorDeskripsi" class="form-label">Deskripsi</label>
                            <div id="editorDeskripsi" style="height: 200px;"></div>
                            <input type="hidden" name="deskripsi" id="deskripsi">
                        </div>
                        <!-- Upload Gambar (Dropzone) -->
                        <div class="form-group mb-3">
                            <label class="form-label">Upload Gambar</label>
                            <div class="dropzone" id="dropzoneArea"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btn-sm" id="resetData">
                            Reset
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" id="simpanData">
                            <i class="fe fe-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah Data -->

    <!-- Edit Data -->
    <div class="modal fade" id="modalEditData" tabindex="-1" aria-labelledby="modalEditDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel1">
                        Edit Data
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editData">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editEditorName" class="form-label">Nama</label>
                            <div id="editEditorName" style="height: 200px;"></div>
                            <input type="hidden" name="editName" id="editEditorName">
                        </div>
                        <div class="mt-3 form-group">
                            <label for="editEditorDeskripsi" class="form-label">Deskripsi</label>
                            <div id="editEditorDeskripsi" style="height: 200px;"></div>
                            <input type="hidden" name="editDeskripsi" id="editEditorDeskripsi">
                        </div>
                        <div class="mt-3 form-group">
                            <label class="form-label">Upload Gambar</label>
                            <div class="editDropzone" id="editDropzoneArea"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btn-sm" id="resetEditData">
                            Reset
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" id="updateData">
                            <i class="fe fe-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End -->

@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script>

        var table;
        var myDropzone;

        Dropzone.autoDiscover = false;

        const quillName = new Quill('#editorName', {
            theme: 'snow'
        });

        const quillDeskripsi = new Quill('#editorDeskripsi', {
            theme: 'snow'
        });


        $('#modalTambahData').on('shown.bs.modal', function () {

            if (Dropzone.instances.length > 0) {
                Dropzone.instances.forEach(function(dropzone) {
                    dropzone.destroy();
                });
            }

            if ($("#dropzoneArea").length) {
                
                var uploadedFileName = '';

                var myDropzone = new Dropzone("#dropzoneArea", {
                    url: "{{ route('testimonials-product.upload-image') }}",
                    maxFiles: 1,
                    acceptedFiles: "image/*",
                    addRemoveLinks: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (file, response) {
                        if (uploadedFileName) {
                            $.ajax({
                                url: "{{ route('testimonials-product.delete-uploaded-image') }}",
                                type: 'POST',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    filename: uploadedFileName 
                                },
                                success: function (res) {

                                    uploadedFileName = response.filename;
                                    $('<input>').attr({
                                        type: 'hidden',
                                        name: 'uploaded_image',
                                        value: uploadedFileName
                                    }).appendTo('#tambahData');

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Upload Berhasil!',
                                        text: 'Gambar berhasil diunggah.',
                                        timer: 1500,
                                        showConfirmButton: false
                                    });
                                },
                                error: function (xhr) {
                                    console.error("Gagal menghapus file lama:", xhr.responseText);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Menghapus File Lama',
                                        text: 'Terjadi kesalahan saat menghapus file lama.'
                                    });
                                }
                            });
                        } else {
                            uploadedFileName = response.filename;
                            $('<input>').attr({
                                type: 'hidden',
                                name: 'uploaded_image',
                                value: uploadedFileName
                            }).appendTo('#tambahData');

                            Swal.fire({
                                icon: 'success',
                                title: 'Upload Berhasil!',
                                text: 'Gambar berhasil diunggah.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    },
                    removedfile: function(file) {
                                file.previewElement.remove();
                    },
                    error: function (file, response) {
                        console.error('Upload gagal:', response);
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Gagal',
                            text: typeof response === 'string' ? response : 'Terjadi kesalahan saat mengunggah gambar.'
                        });
                    }
                });
            }
        });

        $(document).ready(function() {
            table = $("#datatable").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('testimonials-product.datatable') }}",
                columnDefs: [{
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        targets: 1,
                        render: function(data, type, full, meta) {
                            let htmlDecoded = data.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&amp;/g, '&').replace(/&quot;/g, '"').replace(/&#039;/g, "'");

                            let textOnly = htmlDecoded.replace(/<\/?[^>]+(>|$)/g, "");
                            return textOnly ? textOnly : 'No Name';
                        }
                    },
                    {
                        targets: 2,
                        render: function(data, type, full, meta) {
                            let htmlDecoded = data.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&amp;/g, '&').replace(/&quot;/g, '"').replace(/&#039;/g, "'");

                            let textOnly = htmlDecoded.replace(/<\/?[^>]+(>|$)/g, "");
                            return textOnly ? textOnly : 'No description';
                        }
                    },
                    {
                        targets: 3,
                        render: function(data, type, full, meta) {
                            const status = full.status == "0" ? "Tidak Aktif" : "Aktif";
                            const btnClass = full.status == "0" ? "btn-danger" : "btn-success";
                            const nextStatus = full.status == "0" ? 1 : 0;

                            return `<a href="#" class="btn ${btnClass} btn-sm" onclick="updateStatus(${full.id}, ${nextStatus})">${status}</a>`;
                        }
                    },
                    {
                        targets: 4,
                        render: function(data, type, full, meta) {
                            return `
                        <a href="#" class="btn btn-warning btn-sm" onclick="editData(${full.id})">
                            <i class="fe fe-edit"></i> Edit
                            </a>
                        <a href="#" class="btn btn-danger btn-sm" onclick="hapusData(${full.id})">
                            <i class="fe fe-trash"></i> Hapus
                            </a>
                    `;
                        }
                    }
                ],
                columns: [{
                        data: null
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'deskripsi'
                    },
                    {
                        data: "status"
                    },
                    {
                        data: 'id'
                    }
                ],
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: ''
                }
            });
        });

        function updateStatus(id, status) {
            if (confirm("Apakah Anda yakin ingin mengubah status?")) {
                $.ajax({
                    url: "{{ url('/master/testimonials') }}/" + id + "/update-status",
                    type: "PUT",
                    data: {
                        status: status,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == true) {
                            alert(response.message);
                            table.ajax.reload()
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    }
                });
            }
        }


        function editData(id) {
            $.ajax({
                url: "{{ url('master/testimonials') }}/" + id,
                type: "GET",
                success: function(response) {
                    if (response.status === true) {
                        $('#editNama').val(response.data.nama);
                        $('#editRole').val(response.data.role);
                        $('#editDeskripsi').val(response.data.deskripsi);
                        $('#editData').data('id', id);

                        $('#modalEditData').modal('show');
                    } else {
                        alert('Data tidak ditemukan');
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }

        function hapusData(id) {

            if (confirm("Apakah Yakin Ingin Menghapus Data Ini?")) {
                $.ajax({
                    url: "{{ url('master/testimonials') }}/" + id,
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === true) {
                            alert(response.message)
                            table.ajax.reload()
                        } else {
                            alert('Data tidak ditemukan');
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            }
        }

        $("#simpanData").on("click", function (e) {
            e.preventDefault();

            const name = quillName?.root.innerHTML || '';
            $("#name").val(name);
            
            const deskripsi = quillDeskripsi?.root.innerHTML || '';
            $("#deskripsi").val(deskripsi);

            let formData = new FormData($("#tambahData")[0]);
            

            $.ajax({
                url: "{{ url('master/testimonials-product') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    $("#simpanData").prop("disabled", true).html("Menyimpan...");
                },
                success: function (response) {
                    if (response.status === true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            $("#tambahData")[0].reset();
                            $('#modalTambahData').modal('hide');

                            if (quillName) quillName.setContents([]);
                            if (quillDeskripsi) quillDeskripsi.setContents([]);
                            if (myDropzone) myDropzone.removeAllFiles(true);

                            table.ajax.reload()

                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Gagal',
                            text: response.message || 'Gagal menyimpan data.'
                        });
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: xhr.responseJSON?.message || 'Gagal memproses permintaan.'
                    });
                },
                complete: function () {
                    $("#simpanData").prop("disabled", false).html('<i class="fe fe-save"></i> Simpan');
                }
            });
        });

        $("#updateData").on("click", function(e) {
            e.preventDefault();

            let id = $("#editData").data('id')

            let formData = {
                nama: $("#editNama").val(),
                role: $("#editRole").val(),
                deskripsi: $("#editDeskripsi").val()
            };

            $.ajax({
                url: "{{ url('master/testimonials') }}/" + id,
                type: "PUT",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === true) {
                        alert(response.message);
                        $("#editData")[0].reset();
                        $('#modalEditData').modal('hide');

                        table.ajax.reload();
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    </script>
@endsection
