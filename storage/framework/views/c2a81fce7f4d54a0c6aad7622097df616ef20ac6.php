<?php $__env->startSection('content'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-plus fa-sm"></i> Buat Pengajuan</h1>
    
</div>

<form id="form">
    <div class="card border-bottom-0">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Pengajuan</h6>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="tentang" class="col-sm-2 col-form-label"><b>Tentang</b> <span class="text-danger ml-1">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="tentang" id="tentang" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group row">
                        <label for="id_jenis" class="col-sm-4 col-form-label">Jenis Peraturan <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="id_jenis" id="id_jenis" required>
                                <?php $__currentLoopData = $peraturans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peraturan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($peraturan->id_jenis); ?>"><?php echo e($peraturan->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_jenis_sub" class="col-sm-4 col-form-label">Sub Jenis Peraturan <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="id_jenis_sub" id="id_jenis_sub" required>
                                <?php $__currentLoopData = $peraturan_subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peraturan_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($peraturan_sub->id_jenis_sub); ?>"><?php echo e($peraturan_sub->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_booking" class="col-sm-4 col-form-label">Tanggal Pengajuan <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control col-sm-6 calendar" name="tgl_booking" id="tgl_booking" value="<?php echo e($year); ?>" style="background:#FFF" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-sm-4 col-form-label">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea type="note" class="form-control" name="note" id="note"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group row">
                        <label for="tahun_pembuatan" class="col-sm-4 col-form-label">Tahun <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control col-sm-6" name="tahun_pembuatan" id="tahun_pembuatan" value="<?php echo e(date('Y')); ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="instansiname" class="col-sm-4 col-form-label">Perangkat Daerah/Unit <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" name="instansiname" id="instansiname" value="<?php echo e(Auth::user()->instansiname); ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_produk_hukum" class="col-sm-4 col-form-label">No Nota Dinas <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="no_produk_hukum" id="no_produk_hukum" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="narahubung" class="col-sm-4 col-form-label">Narahubung <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="narahubung" id="narahubung" value="" required placeholder="Nama Lengkap dan No Telp. yang bisa dihubungi.">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
            <h6 class="m-0 font-weight-bold text-primary">Syarat Pengajuan A</h6>
        </div>
        <div class="card-body p-0">
            <table class="table">
                
                <tbody id="syarat">
                    <?php $__currentLoopData = $peraturan_sub_syarats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$peraturan_sub_syarat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td width="50px" align="right"><?php echo e($k+1); ?></td>
                        <td><?php echo e($peraturan_sub_syarat->name); ?> <small>(<?php echo e($peraturan_sub_syarat->ext); ?>)</small><?php if($peraturan_sub_syarat->c_required == 1): ?> <span class="text-danger ml-1">*</span><?php endif; ?></td>
                        <td width="100px"><?php echo e($peraturan_sub_syarat->c_required == 1 ? 'wajib' : 'tentatif'); ?></td>
                        <td width="120px"><input type="file" name="syarat[<?php echo e($peraturan_sub_syarat->id_jenis_sub_syarat); ?>]" id="syarat[<?php echo e($peraturan_sub_syarat->id_jenis_sub_syarat); ?>]"<?php if($peraturan_sub_syarat->c_required == 1): ?> required <?php endif; ?>/></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="float-right">
                <a class="d-none d-sm-inline-block btn btn-secondary shadow-sm mr-2" href="#"> Batalkan</a>
                <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm" id="btnSend"><i class="fa fa-paper-plane"></i> Simpan & Kirim</a>
            </div>
        </div>
    </div>
</form>
<div id="alert"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$('.calendar').pignoseCalendar({
    format: 'YYYY-MM-DD',
    theme: 'blue',
    language: 'en',
    apply: function(date, context) {
         var $this = $(this);
         var $element = context.element;
         var $calendar = context.calendar;
         console.log(date[0], date[1]);
    }
});

// Jenis Peraturan Sub
$('#id_jenis').change(function(){
    $('#id_jenis_sub').empty();
    $("#id_jenis_sub").append(new Option('Sedang mengambil...', ''));
    $.get("<?php echo e(route('peraturanSub', ':id_jenis')); ?>".replace(':id_jenis', $(this).val()), function(res){
        $('#id_jenis_sub').empty();
        $.each(res, function(k, v) {
            $("#id_jenis_sub").append(new Option(v.name, v.id_jenis_sub));
        });
        $('#id_jenis_sub').change();
    });
});

// Jenis Peraturan Sub Syarat
$('#id_jenis_sub').change(function(){
    $('#syarat').html('');
    $("#syarat").html('<tr><td colspan="4"><center>Sedang mengambil...</center></td></tr>');
    $.get("<?php echo e(route('peraturanSubSyarat', ':id_jenis_sub')); ?>".replace(':id_jenis_sub', $(this).val()), function(res){
        if(res.length != 0){
            $('#syarat').html('');
            $.each(res, function(k, v) {
                w = 'Tentatif'; r = ''; x = ''
                if(v.c_required == 1){
                    w = 'Wajib';
                    r = 'required';
                    x = '<span class="text-danger ml-1">*</span>';
                }
                $("#syarat").append('<tr><td width="50px" align="right">' + parseInt(k+1) + '</td><td>' + v.name + ' <small>(' + v.ext + ')</small> ' + x + '</td><td width="100px">' + w + '</td><td width="120px"><input type="file" name="syarat[' + v.id_jenis_sub_syarat + ']" id="syarat[' + v.id_jenis_sub_syarat + ']" '+ r +'/></td></tr>');
            });
        }else{    
            $("#syarat").html('<tr><td colspan="4"><center><i>Tidak ditemukan data persyaratan.</i></center></td></tr>');
        }
    });

    //$.get("<?php echo e(route('noNotaDinas', [':id_jenis_sub', ':tahun_pembuatan'])); ?>".replace(':id_jenis_sub', $(this).val()).replace(':tahun_pembuatan', $('#tahun_pembuatan').val()), function(res){
    //    $('#no_produk_hukum').val(res);
    //});
});

// Form handle
$('#form').validate({
    errorClass: "is-invalid",
    validClass: "is-valid",
    highlight: function( element, errorClass, validClass ) {
        $(element).addClass(errorClass).removeClass(validClass);
    },
    unhighlight: function( element, errorClass, validClass ) {
        $(element).removeClass(errorClass).addClass(validClass);
    }
});

$('#form').submit(function(e){
    e.preventDefault();
    if($(this).valid()){
        $('#btnSend').addClass('disabled');
        $.ajax({
            url: "<?php echo e(route('pengajuan.store')); ?>",
            type: 'POST',
            data: new FormData($('#form')[0]),
            contentType: false,
            processData: false,
            success: function(data) {
                alert(data.message)
                document.location.href = "<?php echo e(Route('pengajuan.index')); ?>"
            },
            error : function(data){
                err = ''; respon = data.responseJSON;
                $.each(respon.errors, function(index, value){
                    err += "<li>" + value +"</li>";
                });
                $('#alert').html("<div class='alert alert-danger alert-dismissible mt-3 mb-0'></button>" + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
                $('#btnSend').removeClass('disabled');
            }
        });
    }
    return false;
})
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookpro/Documents/jdih_dev/resources/views/pengajuan/create.blade.php ENDPATH**/ ?>