@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-history fa-sm"></i> Riwayat Pengajuan</h1>
    <a href="{{ Route('pengajuan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Pengajuan</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="card-header">
                    <tr>
                        <th></th>
                        <th>Tentang</th>
                        <th>Tahun</th>
                        <th width="170px">Sub Jenis Peraturan</th>
                        <th width="100px">Keterangan</th>
                        <th width="110px">Tgl Pengajuan</th>
                        <th width="100px">Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('pengajuan._show_html')
@endsection

@push('scripts')
<script>
var table = $('#dataTable').dataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('pengajuan.index') }}",
    pageLength: 25,
    order: 5,
    columns: [
        // {data: 'id', name: 'id', className: 'text-center', orderable: false, searchable: false},
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
        {data: 'tentang', name: 'tentang'},
        {data: 'tahun_pembuatan', name: 'tahun_pembuatan'},
        {data: 'n_sub', name: 'n_sub'},
        {data: 'note', name: 'note'},
        {data: 'tgl_booking', name: 'tgl_booking'},
        {data: 'n_status', name: 'n_status'},
    ]
});
</script>
@include('pengajuan._show_js')
@endpush