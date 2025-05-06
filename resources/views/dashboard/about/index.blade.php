@extends('layout.index')

@section('title', 'About')

@section('css')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">

<style>
    .dropzone .dz-preview .dz-image img {
        max-width: 120px;
        max-height: 120px;
        object-fit: cover; 
    }
</style>

@section('breadcumb')
    <div class="page-header">
        <h1 class="my-auto page-title">About</h1>
        <div>
            <ol class="mb-0 breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    About
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
                        About
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
                                <th>Keunggulan</th>
                                <th>Title Keunggulan</th>
                                <th>Deskripsi</th>
                                <th>List Keunggulan</th>
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
                    <h6 class="modal-title" id="modalTambahDataLabel">
                        Tambah Data
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <form id="tambahData">
                    <div class="modal-body">
                        <!-- Input Nama -->
                        <div class="form-group mb-3">
                            <label for="keunggulan" class="form-label">Keunggulan</label>
                            <textarea class="form-control" name="keunggulan" id="keunggulan" rows="1"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="titleKeunggulan" class="form-label">Title Keunggulan</label>
                            <textarea class="form-control" name="titleKeunggulan" id="titleKeunggulan" rows="1"></textarea>
                        </div>
    
                        <!-- Quill Editor -->
                        <div class="form-group mb-3">
                            <label for="editor" class="form-label">Deskripsi</label>
                            <div id="editor" style="height: 200px;"></div>
                            <input type="hidden" name="deskripsi" id="deskripsi">
                        </div>

                        <!-- Upload Gambar (Dropzone) -->
                        <div class="form-group mb-3">
                            <label class="form-label">Upload Gambar</label>
                            <div class="dropzone" id="dropzoneArea"></div>
                        </div>

                        <!-- Select2 Multiple -->
                        <div class="form-group mb-3">
                            <label for="listKeunggulan" class="form-label">List Keunggulan</label>
                            <select class="form-control select2" name="listKeunggulan[]" id="listKeunggulan" multiple data-placeholder="Pilih Beberapa Keunggulan">
                            </select>                                                     
                        </div>                        
                    </div>
    
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btn-sm" id="resetData">Reset</button>
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
                        <div class="form-group mb-3">
                            <label for="editKeunggulan" class="form-label">Keunggulan</label>
                            <textarea class="form-control" name="editKeunggulan" id="editKeunggulan" rows="1"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="editTitleKeunggulan" class="form-label">Title Keunggulan</label>
                            <textarea class="form-control" name="editTitleKeunggulan" id="editTitleKeunggulan" rows="1"></textarea>
                        </div>

                    <!-- Quill Editor -->
                        <div class="form-group mb-3">
                            <label for="editEditor" class="form-label">Deskripsi</label>
                            <div id="editEditor" style="height: 200px;"></div>
                            <input type="hidden" name="editDescription" id="editDescription">
                        </div>

                        <!-- Upload Gambar (Dropzone) -->
                        <div class="form-group mb-3">
                            <label class="form-label">Upload Gambar</label>
                            <div class="dropzone" id="editDropzoneArea"></div>
                        </div>

                        <!-- Select2 Multiple -->
                        <div class="form-group mb-3">
                            <label for="editListKeunggulan" class="form-label">List Keunggulan</label>
                            <select class="form-control select2" name="editListKeunggulan[]" id="editListKeunggulan" multiple data-placeholder="Pilih Beberapa Keunggulan">
                            </select>                                                     
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
      

@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>


    <script>
        Dropzone.autoDiscover = false;

        let myDropzone;
        let uploadedFileName = null;

        $('.select2').select2();

        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        const quillEditor = new Quill('#editEditor', {
            theme: 'snow'
        });
        
        
        $('#modalTambahData').on('shown.bs.modal', function () {

            $('#listKeunggulan').select2({
                dropdownParent: $('#modalTambahData'),
                placeholder: $('#listKeunggulan').data('placeholder') || "Pilih Konsultan",
                allowClear: true,
                width: '100%',
                ajax: {
                    url: "{{ route('about.list-superiority-options') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            if (Dropzone.instances.length > 0) {
                Dropzone.instances.forEach(function(dropzone) {
                    dropzone.destroy();
                });
            }

            if ($("#dropzoneArea").length) {

                var uploadedFileNames = [];

                var myDropzone = new Dropzone("#dropzoneArea", {
                    url: "{{ route('about.upload-image') }}",
                    maxFiles: 10,
                    acceptedFiles: "image/*",
                    addRemoveLinks: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (file, response) {
                        uploadedFileNames.push(response.filename);

                        $('<input>').attr({
                            type: 'hidden',
                            name: 'uploaded_images[]',
                            value: response.filename
                        }).appendTo('#tambahData');

                        Swal.fire({
                            icon: 'success',
                            title: 'Upload Berhasil!',
                            text: 'Gambar berhasil diunggah.',
                            timer: 1500,
                            showConfirmButton: false
                        });
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

        var table;

        $(document).ready(function () {
            table = $("#datatable").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('about.datatable') }}",
                columnDefs: [
                    {
                        targets: 0,
                        render: function (data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        targets: 3,
                        render: function(data, type, full, meta) {
                            let htmlDecoded = data.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&amp;/g, '&').replace(/&quot;/g, '"').replace(/&#039;/g, "'");

                            let textOnly = htmlDecoded.replace(/<\/?[^>]+(>|$)/g, "");
                            return textOnly ? textOnly : 'No description';
                        }
                    },
                    {
                        targets: 4,
                        render: function (data, type, full, meta) {
                            // console.log(full);
                            
                            const safeJson = btoa(JSON.stringify(full.about_list_superiority));


                            return `
                                <button class="btn btn-info btn-sm" onclick="showConsultationModal('${safeJson}')">
                                    Lihat Paket Konsultasi
                                </button>
                            `;
                        }
                    },
                    {
                        targets: 5,
                        render: function (data, type, full, meta) {
                            return `
                                <a href="#" class="btn btn-warning btn-sm" onclick="editData(${full.id})">
                                    <i class="fe fe-edit"></i> Edit
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="hapusData(${full.id})">
                                    <i class="fe fe-trash"></i> Hapus
                                </a>
                            `;
                        }
                    },
                ],
                columns: [
                    { data: null },              
                    { data: 'keunggulan' },        
                    { data: 'title_keunggulan' },       
                    { data: 'description' },
                    { data: 'about_list_superiority' },  
                    { data: 'id' }
                ],
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: ''
                }
            });


        });

        function showConsultationModal(encodedData) {
            try {
                const decoded = atob(encodedData);
                const listSuperiority = JSON.parse(decoded);

                if (!listSuperiority || listSuperiority.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Tidak Ada Konsultasi',
                        text: 'Data tidak tersedia.'
                    });
                    return;
                }

                const listHtml = listSuperiority
                    .map(item => `• ${item.list_superiority?.name ?? '-'}`)
                    .join('<br>');

                Swal.fire({
                    title: 'Daftar List Keunggulan',
                    html: `<div style="text-align:left">${listHtml}</div>`,
                    icon: 'info',
                    confirmButtonText: 'Tutup'
                });
            } catch (e) {
                console.error('Gagal parsing data konsultasi:', e);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Data tidak valid.'
                });
            }
        }

        $("#simpanData").on("click", function (e) {
            e.preventDefault();

            const deskripsi = quill?.root.innerHTML || '';
            $("#deskripsi").val(deskripsi);

            let formData = new FormData($("#tambahData")[0]);
            

            $.ajax({
                url: "{{ url('master/about') }}",
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
                            $('#listKeunggulan').val(null).trigger('change');
                            $('#modalTambahData').modal('hide');

                            if (quill) quill.setContents([]);
                            if (myDropzone) myDropzone.removeAllFiles(true);

                            table.ajax.reload(null, false);

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

        function hapusData(id) {
            // console.log(id);
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('master/package-item') }}/" + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                $("#tambahData")[0].reset();
                                $('#modalTambahData').modal('hide');
                                table.ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Data tidak ditemukan.'
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: xhr.responseText
                            });
                        }
                    });
                }
            });
        }

        function loadItemSuperiority(selectedIds = []) {
            $('#editListKeunggulan').select2({
                dropdownParent: $('#modalEditData'),
                placeholder: $('#editListKeunggulan').data('placeholder') || "Pilih List Unggulan",
                allowClear: true,
                width: '100%',
                ajax: {
                    url: "{{ route('about.list-superiority-options') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            if (selectedIds.length > 0) {
                $.ajax({
                    url: "{{ route('about.list-superiority-options') }}",
                    type: "GET",
                    success: function (response) {
                        console.log(response);
                        const selectedOptions = response.filter(item => selectedIds.includes(parseInt(item.id)));

                        selectedOptions.forEach(function (editListKeunggulan) {
                            const option = new Option(editListKeunggulan.name, editListKeunggulan.id, true, true);
                            $('#editListKeunggulan').append(option).trigger('change');
                        });
                    }
                });
            }
        }


        function editData(id) {

            var uploadedFileName = null;
            var manualDelete = false;

            $.ajax({
                url: "{{ url('master/about') }}/" + id,
                type: "GET",
                success: function (response) {
                    if (response.status === true) {
                        const data = response.data;
                        
                        
                        

                        $('#editData').data('id', id);
                        $('#editKeunggulan').val(data.keunggulan);
                        $('#editTitleKeunggulan').val(data.title_keunggulan);

                        if (quillEditor) {
                            quillEditor.root.innerHTML = data.description ?? '';
                        }

                        if (data.about_list_superiority && Array.isArray(data.about_list_superiority)) {
                            
                            const listSuperiority = data.about_list_superiority.map(item => item.list_superiority_id);
                            loadItemSuperiority(listSuperiority);
                        }

                        if (!window.dropzoneInitialized) {
                            editDropzone = new Dropzone("#editDropzoneArea", {
                                url: "{{ route('testimonials-product.upload-image') }}",
                                maxFiles: 10,
                                acceptedFiles: "image/*",
                                addRemoveLinks: true,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                init: function () {
                                    const dz = this;

                                    if (data.image_about && data.image_about.length > 0) {
                                        data.image_about.forEach((imgObj) => {
                                            const mockFile = {
                                                name: imgObj.gambar,
                                                size: 12345,
                                                url: "/storage/about/" + imgObj.gambar
                                            };

                                            dz.emit("addedfile", mockFile);
                                            dz.emit("thumbnail", mockFile, mockFile.url);
                                            dz.emit("complete", mockFile);
                                            dz.files.push(mockFile);

                                            // Tambahkan juga input hidden agar disubmit
                                            $('<input>').attr({
                                                type: 'hidden',
                                                name: 'existing_images[]',
                                                value: imgObj.gambar
                                            }).appendTo('#modalEditData form');
                                        });
                                    }

                                    dz.on("maxfilesexceeded", function (file) {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Batas Terlampaui',
                                            text: 'Anda hanya bisa mengunggah maksimal 10 gambar.'
                                        });
                                        dz.removeFile(file);
                                    });

                                    dz.on("success", function (file, response) {
                                        if (response.status === true || response.success === true) {
                                            const newFileName = response.filename;

                                            $('<input>').attr({
                                                type: 'hidden',
                                                name: 'uploaded_images[]',
                                                value: newFileName
                                            }).appendTo('#modalEditData form');

                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Upload Berhasil!',
                                                text: 'Gambar berhasil diunggah.',
                                                timer: 1500,
                                                showConfirmButton: false
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Upload Gagal!',
                                                text: response.message || 'Terjadi kesalahan saat mengunggah gambar.'
                                            });
                                            dz.removeFile(file);
                                        }
                                    });

                                    dz.on("removedfile", function (file) {
                                        file.previewElement.remove();
                                        $(`#modalEditData input[value="${file.name}"]`).remove();
                                    });
                                }
                            });

                            window.dropzoneInitialized = true;
                        }


                        $('#modalEditData').modal('show');
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Tidak Ditemukan'
                            });
                        }
                    },
                    error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: xhr.responseText
                    });
                }
            });
        }

        $("#updateData").on("click", function(e) {
            e.preventDefault();

            let id = $("#editData").data('id');
            const deskripsi = quillEditor?.root.innerHTML || '';
            $("#editDescription").val(deskripsi);

            var formData = new FormData($('#modalEditData form')[0]);

            formData.append('_method', 'PUT');

            $.ajax({
                url: "{{ url('master/about') }}/" + id,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            $("#editData")[0].reset();
                            
                            $('#editListKeunggulan').val(null).trigger('change');
                            $('#modalEditData').modal('hide');
                            
                            table.ajax.reload(null, false);
                            
                            if (quillEditor) quillEditor.setContents([]);
                        });
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: xhr.responseJSON?.message || 'Gagal memproses permintaan.'
                    });
                }
            });
        });
    </script>
@endsection
