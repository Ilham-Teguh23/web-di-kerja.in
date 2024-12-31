@extends('layout.index')

@section('title', 'Contact Message')

@section('css')

@endsection

@section('breadcumb')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title my-auto">Contact Message</h1>
        <div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
            <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Contact Message</li>
        </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

@endsection

@section('content')

    <!-- ROW-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Contact Message
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengirim</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-2 END -->

@endsection

@section('script')

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script> --}}

<script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var $table;

    
    $(document).ready(function() {
        
        table = $("#datatable").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{ route('contact-message.datatable') }}",
            columnDefs: [
            {
                targets: 0,
                render: function(data, type, full, meta) {
                    return (meta.row + 1);
                }
            }, ],
            columns: [
                { data: null },
                { data: 'name'},
                { data: 'email'},
                { data: 'subject'},
                { data: 'message'},
                { data: 'id'}, 
            ],
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
            }
        });
    })
</script>
@endsection