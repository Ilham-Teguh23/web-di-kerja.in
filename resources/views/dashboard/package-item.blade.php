@extends('layout.index')

@section('title', 'Package Item')

@section('css')

<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                        <div class="form-group">
                            <label for="editName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editName" name="editName"
                                placeholder="Masukkan Nama">
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
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        let quill;

        $('#modalTambahData').on('shown.bs.modal', function () {
            if (!quill) {
                quill = new Quill('#editor', {
                    theme: 'snow'
                });
            }

            $('#consultant').select2({
                dropdownParent: $('#modalTambahData'),
                placeholder: $('#consultant').data('placeholder'),
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

            // Load Data Harga (price)
            $.ajax({
                url: "{{ route('package-item.price-options') }}",
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    let $price = $('#price');
                    $price.empty().append('<option value="">Pilih salah satu</option>');

                    $.each(response, function (i, item) {
                        let formattedPrice = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        }).format(item.price);

                        $price.append(`<option value="${item.id}">${formattedPrice}</option>`);
                    });
                },
                error: function () {
                    alert("Gagal mengambil data harga dari server.");
                }
            });
        });

        // Tombol simpan: ambil isi quill dan simpan ke input hidden
        $('#simpanData').on('click', function () {
            let deskripsi = quill.root.innerHTML;
            $('#deskripsi').val(deskripsi);

            // Debug - tampilkan semua data dari form
            console.log($('#tambahData').serialize());

            // TODO: Kirim via AJAX atau submit biasa
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
                        targets: 6, // Kolom Aksi
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
                    { data: null },                     // No
                    { data: 'name' },                   // Nama
                    { data: 'description' },            // Deskripsi
                    { data: 'price.price' },            // Harga (relasi)
                    { data: 'favorite_item' },     // Favorite (relasi)
                    { data: 'package_consultation' },   // Konsultasi (many-to-many)
                    { data: 'id' }                      // Aksi
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
        $('#favoritePackageId').val(packageId); // Simpan id paket ke hidden input
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
                $('#modalSetFavorite').modal('hide'); // ✅ tutup modal

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                table.ajax.reload(null, false); // ✅ reload datatable
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









    </script>
@endsection
