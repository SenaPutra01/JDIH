<?php $__env->startSection('content'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-book fa-sm"></i> Laporan</h1>
</div>

<form action="<?php echo e(Route('report')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="filter" value="1" />
    <div class="card border-bottom-0">
        <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Saring</h6>
        </div> -->
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group row">
                        <label for="ftahun_pembuatan" class="col-sm-4 col-form-label">Tahun</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="ftahun_pembuatan" id="ftahun_pembuatan">
                                <option value="">Semua</option>
                                <?php for($y=date('Y'); $y>=2010; $y--): ?>
                                <option value="<?php echo e($y); ?>" <?php if($y == $ftahun_pembuatan): ?> selected="selected" <?php endif; ?>><?php echo e($y); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="finstansiname" class="col-sm-4 col-form-label">Perangkat Daerah</label>
                        <div class="col-sm-8">
                            <select class="form-control col-sm-8" name="finstansiname" id="finstansiname" style="width:100%">
                                <option value="">Semua</option>
                                <?php $__currentLoopData = $instansi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $in): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($in->name); ?>" <?php if($in->name == $finstansiname): ?> selected="selected" <?php endif; ?>><?php echo e($in->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" style="display:none">
                        <label for="fid_jenis" class="col-sm-4 col-form-label">Jenis Peraturan</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="fid_jenis" id="fid_jenis">
                                <?php $__currentLoopData = $peraturans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peraturan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($peraturan->id_jenis); ?>"><?php echo e($peraturan->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fid_jenis_sub" class="col-sm-4 col-form-label">Sub Jenis Peraturan</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="fid_jenis_sub" id="fid_jenis_sub">
                                <option value="">Semua</option>
                                <?php $__currentLoopData = $peraturan_subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peraturan_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($peraturan_sub->id_jenis_sub); ?>" <?php if($peraturan_sub->id_jenis_sub == $fid_jenis_sub): ?> selected="selected" <?php endif; ?>><?php echo e($peraturan_sub->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fstatus" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="fstatus" id="fstatus">
                                <option value="">Semua</option>
                                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st=>$stn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($st); ?>" <?php if($st == $fstatus): ?> selected="selected" <?php endif; ?>><?php echo e($stn); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-footer">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm float-right" id="btnSend"><i class="fa fa-filter"></i> Cari</a>
                </div>
            </div>
        </div>
    </div>
</form>
<div id="alert"></div>
<?php if($filter): ?>
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
<style>
.btn-group{
    float:left;
}
</style>
<?php endif; ?>

<?php echo $__env->make('pengajuan._show_html', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php
    $date = "     Di cetak pada tgl. ".Carbon\Carbon::parse(date('Y-m-d H:i:s'))->format('d F Y H:i:s');
?>
<script>
$('#finstansiname').select2();

filter = " Tahun : " + $('#ftahun_pembuatan').val() + "\n";
filter += " Perangkat Daerah : " + $('#finstansiname').val() + "\n";
filter += " Sub Jenis Peraturan : " + $('#fid_jenis_sub').find(":selected").text() + "\n";
filter += " Status : " + $('#fstatus').find(":selected").text() + "\n";
var table = $('#dataTable').dataTable({
    paging:false,
    dom: 'Bfrtip',
    buttons: [
        { extend: 'excelHtml5', className: 'btn btn-primary', messageTop: filter, messageBottom: "\n <?php echo e($date); ?>" },
        { extend: 'pdf', className: 'btn btn-primary', messageTop: filter, messageBottom: "\n <?php echo e($date); ?>", orientation: 'landscape', pageSize: 'LEGAL' }
    ],
    processing: true,
    serverSide: true,
    ajax: {
        url: "<?php echo e(route('report')); ?>",
        method: "POST",
        data: {
            filter: 1,
            ftahun_pembuatan: $('#ftahun_pembuatan').val(),
            finstansiname: $('#finstansiname').val(),
            fid_jenis: $('#fid_jenis').val(),
            fid_jenis_sub: $('#fid_jenis_sub').val(),
            fstatus: $('#fstatus').val()
        }
    },
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookpro/Documents/Diskominfo Projects/jdih_dev/resources/views/report/index.blade.php ENDPATH**/ ?>