@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-newspaper fa-sm"></i> Berita</h1>
    <a href="{{ Route('berita.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Berita</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="card-header">
                    <tr>
                        <th></th>
                        <th>Judul</th>
                        <th width="150px">Jumlah Pengunjung</th>
                        <th width="150px">Tanggal Pembuatan</th>
                        <th width="150px">Tanggal Perubahan</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

{{-- @include('frontend.menu._show_html') --}}
@endsection

@push('scripts')
<script>
var table = $('#dataTable').dataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('berita.index') }}",
    pageLength: 10,
    order: 5,
    columns: [
        // {data: 'id', name: 'id', className: 'text-center', orderable: false, searchable: false},
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
        {data: 'title', name: 'title'},
        {data: 'hits_count', name: 'hits_count'},
        {data: 'created_at', name: 'created_at'},
        {data: 'updated_at', name: 'updated_at'},
        {data: 'aksi', name: 'aksi'},
    ]
});
</script>
{{-- @include('frontend.menu._show_js') --}}
@endpush