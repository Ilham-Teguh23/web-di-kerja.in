@extends('layout.index')

@section('title', 'Katalog')

@section('css')

@section('breadcumb')
    <div class="page-header">
        <h1 class="my-auto page-title">Data Katalog</h1>
        <div>
            <ol class="mb-0 breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Katalog
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
                        <a href="{{ route('katalog.create') }}" class="btn btn-sm btn-primary-light">
                            Tambah Data
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
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
                        <div class="form-group">
                            <label for="pertanyaan" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan"
                                placeholder="Masukkan Pertanyaan">
                        </div>
                        <div class="mt-3 form-group">
                            <label for="jawaban" class="form-label">Jawaban</label>
                            <input type="text" class="form-control" id="jawaban" name="jawaban"
                                placeholder="Masukkan Jawaban">
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
                            <label for="editPertanyaan" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control" id="editPertanyaan" name="editPertanyaan"
                                placeholder="Masukkan Pertanyaan">
                        </div>
                        <div class="mt-3 form-group">
                            <label for="editJawaban" class="form-label">Jawaban</label>
                            <input type="text" class="form-control" id="editJawaban" name="editJawaban"
                                placeholder="Masukkan Jawaban">
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

    <script>
        var table;

        $(document).ready(function() {
            table = $("#datatable").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('faq.datatable') }}",
                columnDefs: [{
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
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
                        data: 'pertanyaan'
                    },
                    {
                        data: 'jawaban'
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
                url: "{{ url('master/faq') }}/" + id,
                type: "GET",
                success: function(response) {
                    if (response.status === true) {
                        $('#editPertanyaan').val(response.data.pertanyaan);
                        $('#editJawaban').val(response.data.jawaban);
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
                    url: "{{ url('master/faq') }}/" + id,
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

        $("#simpanData").on("click", function(e) {
            e.preventDefault();

            let formData = {
                pertanyaan: $("#pertanyaan").val(),
                jawaban: $("#jawaban").val()
            };

            $.ajax({
                url: "{{ url('master/faq') }}",
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === true) {
                        alert(response.message);

                        $("#tambahData")[0].reset();
                        $("#modalTambahData").modal("hide");

                        table.ajax.reload();
                    }
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan: " + xhr.responseText);
                }
            });
        });

        $("#updateData").on("click", function(e) {
            e.preventDefault();

            let id = $("#editData").data('id')

            let formData = {
                pertanyaan: $("#editPertanyaan").val(),
                jawaban: $("#editJawaban").val()
            };

            $.ajax({
                url: "{{ url('master/faq') }}/" + id,
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
