@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-copyright fa-sm"></i> Footer Portal Web</h1>
    {{-- <a href="{{ Route('menu.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Menu</a> --}}
</div>

<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="card-header">
                    <tr>
                        <th></th>
                        <th>Kiri Judul</th>
                        <th width="100px">Nomor Urut</th>
                        <th width="500px">Link</th>
                        <th width="100px">Sub Menu</th>
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
    ajax: "{{ route('menu.index') }}",
    pageLength: 25,
    order: 5,
    columns: [
        // {data: 'id', name: 'id', className: 'text-center', orderable: false, searchable: false},
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
        {data: 'kiri_judul', name: 'kiri_judul'},
        {data: 'kiri_deskripsi', name: 'kiri_deskripsi'},
        {data: 'kanan_judul', name: 'kanan_judul'},
        {data: 'kanan_email', name: 'kanan_email'},
        {data: 'kanan_alamat', name: 'kanan_alamat'},
        {data: 'kanan_telepon', name: 'kanan_telepon'},
        {data: 'copyright', name: 'copyright'},
        {data: 'aksi', name: 'aksi'},
    ]
});
</script>
{{-- @include('frontend.menu._show_js') --}}
@endpush