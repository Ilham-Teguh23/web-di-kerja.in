@extends('layout.index')

@section('title', 'Package Item')

@section('css')

<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
        <h1 class="my-auto page-title">Paket Item</h1>
        <div>
            <ol class="mb-0 breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Paket Item
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
                        Paket Item
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
                                <th>Harga</th>
                                <th>Paket Konsultasi Item</th>
                                <th>Status Item</th>
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
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama">
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

    
                        <!-- Select Biasa -->
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <select class="form-control" name="price" id="price">
                                <option value="">Pilih salah satu</option>
                            </select>                            
                        </div>
                        <!-- Select2 Multiple -->
                        <div class="form-group mb-3">
                            <label for="consultant" class="form-label">Konsultasi</label>
                            <select class="form-control select2" name="consultant[]" id="consultant" multiple data-placeholder="Pilih Konsultan">
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
                            <label for="editName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editName" name="editName" placeholder="Masukkan Nama">
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


                        <!-- Select Biasa -->
                        <div class="form-group mb-3">
                            <label for="editPrice" class="form-label">Harga</label>
                            <select class="form-control" name="editPrice" id="editPrice">
                                <option value="">Pilih salah satu</option>
                            </select>                            
                        </div>
                        <!-- Select2 Multiple -->
                        <div class="form-group mb-3">
                            <label for="editConsultant" class="form-label">Konsultasi</label>
                            <select class="form-control select2" name="editConsultant[]" id="editConsultant" multiple data-placeholder="Pilih Konsultan">
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

    <!-- End -->

    <div class="modal fade" id="modalSetFavorite" tabindex="-1" aria-labelledby="modalSetFavoriteLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalSetFavoriteLabel">Pilih Item Favorite</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="favoritePackageId">
              <div class="form-group">
                <label for="favoriteSelect">Item Favorite</label>
                <select class="form-control" id="favoriteSelect">
                  <option value="">Loading...</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary btn-sm" id="saveFavorite">Simpan</button>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

            $('#consultant').select2({
                dropdownParent: $('#modalTambahData'),
                placeholder: $('#consultant').data('placeholder') || "Pilih Konsultan",
                allowClear: true,
                width: '100%',
                ajax: {
                    url: "{{ route('package-item.item-consultant-options') }}",
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

            $.ajax({
                url: "{{ route('package-item.price-options') }}",
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    const $price = $('#price');
                    $price.empty().append('<option value="">Pilih salah satu</option>');

                    $.each(response, function (i, item) {
                        const formattedPrice = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        }).format(item.price);

                        $price.append(`<option value="${item.id}">${formattedPrice}</option>`);
                    });
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Tidak dapat mengambil data harga dari server.'
                    });
                }
            });

            if ($("#dropzoneArea").length) {
                Dropzone.autoDiscover = false;

                var uploadedFileName = '';

                var myDropzone = new Dropzone("#dropzoneArea", {
                    url: "{{ route('package-item.upload-image') }}",
                    maxFiles: 1,
                    acceptedFiles: "image/*",
                    addRemoveLinks: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (file, response) {
                        if (uploadedFileName) {
                            $.ajax({
                                url: "{{ route('package-item.delete-uploaded-image') }}",
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

        var table;

        $(document).ready(function () {
            table = $("#datatable").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('package-item.datatable') }}",
                columnDefs: [
                    {
                        targets: 0,
                        render: function (data, type, full, meta) {
                            return meta.row + 1;
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
                        render: function (data, type, full, meta) {
                            let nominal = full.price?.price ?? 0;
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0
                            }).format(nominal);
                        }
                    },
                    {
                        targets: 4,
                        render: function (data, type, full, meta) {
                            const safeJson = btoa(JSON.stringify(full.package_consultation));


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
                            const isActive = full.favorite_item && full.favorite_item.name;

                            const buttonClass = isActive ? 'success' : 'danger';
                            const buttonText = isActive ? full.favorite_item.name : 'Not Active';

                            return `
                                <button class="btn btn-${buttonClass} btn-sm" onclick="toggleFavorite(${full.id})">
                                    ${buttonText}
                                </button>
                            `;
                        }
                    },
                    {
                        targets: 6,
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
                    { data: 'name' },        
                    { data: 'description' },       
                    { data: 'price.price' },    
                    { data: 'favorite_item' },  
                    { data: 'package_consultation' },  
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
                const consultations = JSON.parse(decoded);

                if (!consultations || consultations.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Tidak Ada Konsultasi',
                        text: 'Data tidak tersedia.'
                    });
                    return;
                }

                const listHtml = consultations
                    .map(item => `• ${item.detail_consultant?.name ?? '-'}`)
                    .join('<br>');

                Swal.fire({
                    title: 'Daftar Konsultasi',
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


        function toggleFavorite(packageId) {
            $('#favoritePackageId').val(packageId);
            $('#favoriteSelect').empty().append('<option value="">Loading...</option>');

            $.ajax({
                url: "{{ route('package-item.favorite-item-options') }}",
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    const $favorite = $('#favoriteSelect');
                    $favorite.empty().append('<option value="">Tidak Aktif</option>');

                    $.each(response, function (i, item) {
                        $favorite.append(`<option value="${item.id}">${item.name}</option>`);
                    });

                    $('#modalSetFavorite').modal('show');
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal mengambil data favorite dari server.'
                    });
                }
            });
        }

        $('#saveFavorite').on('click', function () {
            const packageId = $('#favoritePackageId').val();
            const selectedFavorite = $('#favoriteSelect').val();

            $.ajax({
                url: "{{ route('package-item.iupdate-status-favorite-item', ':id') }}".replace(':id', packageId),
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    favorite_id: selectedFavorite || null
                },
                success: function (response) {
                    if (response.status) {
                        $('#modalSetFavorite').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        table.ajax.reload(null, false);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan!',
                        text: 'Terjadi kesalahan saat menyimpan data.'
                    });
                }
            });
        });

        $("#simpanData").on("click", function (e) {
            e.preventDefault();

            const deskripsi = quill?.root.innerHTML || '';
            $("#deskripsi").val(deskripsi);

            let formData = new FormData($("#tambahData")[0]);
            

            $.ajax({
                url: "{{ url('master/package-item') }}",
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
                            $('#consultant').val(null).trigger('change');
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

        function loadPriceOptions(selectedId = null) {
            $.ajax({
                url: "{{ route('package-item.price-options') }}",
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    const $price = $('#editPrice');
                    $price.empty().append('<option value="">Pilih salah satu</option>');

                    $.each(response, function (i, item) {
                        const formattedPrice = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        }).format(item.price);

                        $price.append(`<option value="${item.id}">${formattedPrice}</option>`);
                    });

                    if (selectedId) {
                        $price.val(selectedId).trigger('change');
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Tidak dapat mengambil data harga dari server.'
                    });
                }
            });
        }

        function loadItemConsultant(selectedIds = []) {
            $('#editConsultant').select2({
                dropdownParent: $('#modalEditData'),
                    placeholder: $('#consultant').data('placeholder') || "Pilih Konsultan",
                    allowClear: true,
                    width: '100%',
                    ajax: {
                        url: "{{ route('package-item.item-consultant-options') }}",
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
                    url: "{{ route('package-item.item-consultant-options') }}",
                    type: "GET",
                    success: function (response) {
                        const selectedOptions = response.filter(item => selectedIds.includes(item.id));
                        selectedOptions.forEach(function (consultant) {
                            const option = new Option(consultant.name, consultant.id, true, true);
                            $('#editConsultant').append(option).trigger('change');
                        });
                    }
                });
            }
        }

        function editData(id) {

            var uploadedFileName = null;
            var manualDelete = false;

            $.ajax({
                url: "{{ url('master/package-item') }}/" + id,
                type: "GET",
                success: function (response) {
                    if (response.status === true) {
                        const data = response.data;
                        

                        $('#editData').data('id', id);
                        $('#editName').val(data.name);

                        if (quillEditor) {
                            quillEditor.root.innerHTML = data.description ?? '';
                        }

                        loadPriceOptions(data.meta_price_package_service_id);

                        if (data.package_consultation && Array.isArray(data.package_consultation)) {
                            
                            const consultantIds = data.package_consultation.map(item => item.consultation_detail_id);
                            
                            loadItemConsultant(consultantIds);
                        }


                        if (!window.dropzoneInitialized) {
                            editDropzone = new Dropzone("#editDropzoneArea", {
                                url: "{{ route('package-item.upload-image') }}",
                                maxFiles: 1,
                                acceptedFiles: "image/*",
                                addRemoveLinks: true,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                init: function() {
                                    var dz = this;

                                    var mockFile = {
                                        name: data.image_path,
                                        size: 12345,
                                        url: '/storage/image_item_package/' + data.image_path 
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

        $("#updateData").on("click", function(e) {
            e.preventDefault();

            let id = $("#editData").data('id');
            const deskripsi = quillEditor?.root.innerHTML || '';
            $("#editDescription").val(deskripsi);

            var formData = new FormData($('#modalEditData form')[0]);

            formData.append('_method', 'PUT');

            $.ajax({
                url: "{{ url('master/package-item') }}/" + id,
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
                            
                            $('#editConsultant').val(null).trigger('change');
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
