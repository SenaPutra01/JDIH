<?php $__env->startSection('content'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-bars fa-sm"></i> Menu Portal Web</h1>
    <a href="<?php echo e(Route('menu.create')); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Menu</a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="card-header">
                    <tr>
                        <th></th>
                        <th>Nama Menu</th>
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


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
var table = $('#dataTable').dataTable({
    processing: true,
    serverSide: true,
    ajax: "<?php echo e(route('menu.index')); ?>",
    pageLength: 25,
    order: 5,
    columns: [
        // {data: 'id', name: 'id', className: 'text-center', orderable: false, searchable: false},
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
        {data: 'nama_menu', name: 'nama_menu'},
        {data: 'no_urut', name: 'no_urut'},
        {data: 'link', name: 'link'},
        {data: 'has_submenu', name: 'has_submenu'},
        {data: 'aksi', name: 'aksi'},
    ]
});
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookpro/Documents/Diskominfo Projects/jdih_dev/resources/views/frontend/menu/index.blade.php ENDPATH**/ ?>