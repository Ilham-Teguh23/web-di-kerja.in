@extends('layout.index')

@section('title', 'Testimonials Customer')

@section('css')

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
        <h1 class="my-auto page-title">Data Akun Testimonial Pelanggan</h1>
        <div>
            <ol class="mb-0 breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Testimonial Pelanggan
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
                        Data Testimonial Pelanggan
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
                                <th>Gambar</th>
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
                        <div class="mt-3 form-group">
                            <label class="form-label">Upload Gambar</label>
                            <div class="dropzone" id="editDropzoneArea"></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script>
        var myDropzone;
        var table;

        Dropzone.autoDiscover = false;
        var uploadedFileName = null;
        

        $('#modalTambahData').on('shown.bs.modal', function () {

            if (Dropzone.instances.length > 0) {
                Dropzone.instances.forEach(function(dropzone) {
                    dropzone.destroy();
                });
            }

            if ($("#dropzoneArea").length) {
                Dropzone.autoDiscover = false;

                var uploadedFileName = '';

                var myDropzone = new Dropzone("#dropzoneArea", {
                    url: "{{ route('testimonials-customer.upload-image') }}",
                    maxFiles: 1,
                    acceptedFiles: "image/*",
                    addRemoveLinks: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (file, response) {
                        if (uploadedFileName) {
                            $.ajax({
                                url: "{{ route('testimonials-customer.delete-uploaded-image') }}",
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
                ajax: "{{ route('testimonials-customer.datatable') }}",
                columnDefs: [{
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        targets: 1,
                        render: function(data, type, full, meta) {
                            if (data) {
                                const imageUrl = `/storage/testimonial-costumer/${data}`;
                                return `
                                    <img src="${imageUrl}" alt="Image" width="50" height="50" class="img-thumbnail" style="cursor: pointer;" onclick="viewImage('${data}')">
                                `;
                            }
                            return 'No image';
                        }
                    },
                    {
                        targets: 2,
                        render: function(data, type, full, meta) {
                            const status = full.status == "0" ? "Tidak Aktif" : "Aktif";
                            const btnClass = full.status == "0" ? "btn-danger" : "btn-success";
                            const nextStatus = full.status == "0" ? 1 : 0;

                            return `<a href="#" class="btn ${btnClass} btn-sm" onclick="updateStatus(${full.id}, ${nextStatus})">${status}</a>`;
                        }
                    },
                    {
                        targets: 3,
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
                        data: 'gambar'
                    },
                    {
                        data: 'status'
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

        function viewImage(imagePath) {
            const fullImageUrl = `/storage/testimonial-costumer/${imagePath}`;
            Swal.fire({
                imageUrl: fullImageUrl,
                imageAlt: 'Gambar Testimonial',
                imageWidth: 400,
                imageHeight: 400,
                showCloseButton: true,
                showConfirmButton: false
            });
        }


        function updateStatus(id, status) {
            // console.log(id);
            
            Swal.fire({
                title: 'Yakin ingin mengubah status?',
                text: "Tindakan ini akan memperbarui data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/master/testimonials-customer/') }}/" + id + "/update-status",
                        type: "PUT",
                        data: {
                            status: status,
                            _token: $('meta[name="csrf-token"]').attr('content')
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
                                table.ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan!',
                                text: error
                            });
                        }
                    });
                }
            });
        }


        function editData(id) {

            var uploadedFileName = null;
            var manualDelete = false;

            $.ajax({
                url: "{{ url('master/testimonials-customer') }}/" + id,
                type: "GET",
                success: function (response) {
                    if (response.status === true) {
                        const data = response.data;
                        

                        $('#editData').data('id', id);

                        if (!window.dropzoneInitialized) {
                            editDropzone = new Dropzone("#editDropzoneArea", {
                                url: "{{ route('testimonials-customer.upload-image') }}",
                                maxFiles: 1,
                                acceptedFiles: "image/*",
                                addRemoveLinks: true,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                init: function() {
                                    var dz = this;

                                    var mockFile = {
                                        name: data.gambar,
                                        size: 12345,
                                        url: '/storage/testimonial-costumer/' + data.gambar 
                                    };

                                    dz.emit("addedfile", mockFile);  
                                    dz.emit("thumbnail", mockFile, mockFile.url); 
                                    dz.emit("complete", mockFile); 

                                    dz.files.push(mockFile);

                                    dz.on("addedfile", function(file) {
                                        if (dz.files.length > 1) {
                                            dz.removeFile(dz.files[0]);
                                        }
                                    });

                                    dz.on("maxfilesexceeded", function (file) {
                                        if (dz.files.length > 1) {
                                            dz.removeFile(dz.files[0]);
                                        }
                                        dz.addFile(file);
                                    });

                                    dz.on("success", function(file, response) {

                                        if (response.status === true || response.success === true) {
                                            const newFileName = response.filename;

                                            uploadedFileName = newFileName;

                                            $('#modalEditData input[name="uploaded_image"]').remove();
                                            $('<input>').attr({
                                                type: 'hidden',
                                                name: 'uploaded_image',
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
                                                text: response.message || 'Terjadi kesalahan saat mengunggah gambar.',
                                                showConfirmButton: true
                                            });
                                            dz.removeFile(file);
                                        }
                                    });

                                    dz.on("removedfile", function(file) {
                                        file.previewElement.remove();
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

            function hapusData(id) {
                console.log(id);
                
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
                            url: "{{ url('master/testimonials-customer') }}/" + id,
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

        $("#simpanData").on("click", function (e) {
            e.preventDefault();

            let formData = new FormData($("#tambahData")[0]);

            $.ajax({
                url: "{{ url('master/testimonials-customer') }}",
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

        $("#updateData").on("click", function(e) {
            e.preventDefault();

            let id = $("#editData").data('id');

            var formData = new FormData($('#modalEditData form')[0]);

            formData.append('_method', 'PUT');

            $.ajax({
                url: "{{ url('master/testimonials-customer') }}/" + id,
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
                            $('#modalEditData').modal('hide');
                            
                            table.ajax.reload(null, false);
                            
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
