@extends('layout.index')

@section('title', 'Contact')

@section('css')


@section('breadcumb')
    <div class="page-header">
        <h1 class="my-auto page-title">Contact Setting</h1>
        <div>
            <ol class="mb-0 breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Contact Setting
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
                        Contact Setting
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
                                <th>Alamat</th>
                                <th>Telpon</th>
                                <th>link fb</th>
                                <th>link ig</th>
                                <th>link twitter</th>
                                <th>link tiktok</th>
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
                            <label for="text-area" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="1"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="input-email" class="form-label">Type Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email@gmail.com">
                        </div>
                        <div class="form-group mb-3">
                            <label for="input-tel" class="form-label">Type Tel</label>
                            <input type="tel" class="form-control" name="telp" id="telp" placeholder="+62">
                        </div>
                        <div class="form-group mb-3">
                            <label for="input-fb" class="form-label">Link Facebook</label>
                            <input type="text" class="form-control" name="fb" id="fb">
                        </div>
                        <div class="form-group mb-3">
                            <label for="input-ig" class="form-label">Link Instagram</label>
                            <input type="text" class="form-control" name="ig" id="ig">
                        </div>
                        <div class="form-group mb-3">
                            <label for="input-twit" class="form-label">Link Twitter</label>
                            <input type="text" class="form-control" name="twit" id="twit">
                        </div>
                        <div class="form-group mb-3">
                            <label for="input-tt" class="form-label">Link Tiktok</label>
                            <input type="text" class="form-control" name="tiktok" id="tiktok">
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
                            <label for="text-area" class="form-label">Alamat</label>
                            <textarea class="form-control" name="editAlamat" id="editAlamat" rows="1"></textarea>
                        </div>
                        <div class="mt-3 form-group">
                            <label for="input-email" class="form-label">Type Email</label>
                            <input type="email" class="form-control" name="editEmail" id="editEmail" placeholder="Email@gmail.com">
                        </div>
                        <div class="mt-3 form-group">
                            <label for="input-tel" class="form-label">Type Tel</label>
                            <input type="tel" class="form-control" name="editTelp" id="editTelp" placeholder="+62">
                        </div>
                        <div class="mt-3 form-group">
                            <label for="input-fb" class="form-label">Link Facebook</label>
                            <input type="text" class="form-control" name="editFb" id="editFb">
                        </div>
                        <div class="mt-3 form-group">
                            <label for="input-ig" class="form-label">Link Instagram</label>
                            <input type="text" class="form-control" name="editIg" id="editIg">
                        </div>
                        <div class="mt-3 form-group">
                            <label for="input-twit" class="form-label">Link Twitter</label>
                            <input type="text" class="form-control" name="editTwit" id="editTwit">
                        </div>
                        <div class="mt-3 form-group">
                            <label for="input-tt" class="form-label">Link Tiktok</label>
                            <input type="text" class="form-control" name="editTiktok" id="editTiktok">
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
                ajax: "{{ route('contact.datatable') }}",
                columnDefs: [{
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        targets: 8,
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
                        data: 'address'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'link_fb'
                    },
                    {
                        data: 'link_ig'
                    },
                    {
                        data: 'link_twitter'
                    },
                    {
                        data: 'link_tiktok'
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

        function editData(id) {

            var uploadedFileName = null;
            var manualDelete = false;

            $.ajax({
                url: "{{ url('master/contact') }}/" + id,
                type: "GET",
                success: function (response) {
                    if (response.status === true) {
                        const data = response.data;
                        

                        $('#editData').data('id', id);

                        $('#editAlamat').val(data.address);

                        $('#editEmail').val(data.phone);

                        $('#editTelp').val(data.email);

                        $('#editFb').val(data.link_fb);

                        $('#editIg').val(data.link_ig);

                        $('#editTwit').val(data.link_twitter);

                        $('#editTiktok').val(data.link_tiktok);

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
                            url: "{{ url('master/contact') }}/" + id,
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
                url: "{{ url('master/contact') }}",
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

                            table.ajax.reload();

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
                url: "{{ url('master/contact') }}/" + id,
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
