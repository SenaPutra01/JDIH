<?php $__env->startSection('content'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-history fa-sm"></i> Riwayat Pengajuan</h1>
    <a href="<?php echo e(Route('pengajuan.create')); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Pengajuan</a>
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

<?php echo $__env->make('pengajuan._show_html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
var table = $('#dataTable').dataTable({
    processing: true,
    serverSide: true,
    ajax: "<?php echo e(route('pengajuan.index')); ?>",
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
<?php echo $__env->make('pengajuan._show_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookpro/Documents/jdih_dev/resources/views/pengajuan/index.blade.php ENDPATH**/ ?>