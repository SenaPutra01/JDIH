<?php $__env->startSection('content'); ?>
<!-- Page Heading -->
<?php if($alert!=''): ?> <h4><span class="badge badge-pill badge-success"><?php echo e($alert); ?></span></h4><br> <?php endif; ?>
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-pen fa-sm"></i> Ubah Footer</h1>
    
</div>

<form id="form" method="POST" action="<?php echo e(Route('footer.update',1)); ?>" enctype="multipart/form-data">
    <?php echo method_field('PUT'); ?>
    <?php echo csrf_field(); ?>
    <div class="card border-bottom-0">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Bagian Kiri</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group row">
                            <label for="kiri_judul" class="col-sm-4 col-form-label">Judul <span class="text-danger ml-1">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kiri_judul" id="kiri_judul" value="<?php echo e($item->kiri_judul); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kiri_deskripsi" class="col-sm-4 col-form-label">Deskripsi <span class="text-danger ml-1">*</span></label>
                            <div class="col-sm-8">
                                <textarea name="kiri_deskripsi" id="kiri_deskripsi" cols="30" rows="5" class="form-control" required><?php echo e($item->kiri_deskripsi); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
            <h6 class="m-0 font-weight-bold text-primary">Bagian Kanan</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group row">
                            <label for="kanan_judul" class="col-sm-4 col-form-label">Judul <span class="text-danger ml-1">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kanan_judul" id="kanan_judul" value="<?php echo e($item->kanan_judul); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kanan_email" class="col-sm-4 col-form-label">Email <span class="text-danger ml-1">*</span></label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="kanan_email" id="kanan_email" value="<?php echo e($item->kanan_email); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kanan_telepon" class="col-sm-4 col-form-label">Telepon <span class="text-danger ml-1">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="kanan_telepon" id="kanan_telepon" value="<?php echo e($item->kanan_telepon); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kanan_alamat" class="col-sm-4 col-form-label">Alamat <span class="text-danger ml-1">*</span></label>
                            <div class="col-sm-8">
                                <textarea name="kanan_alamat" id="kanan_alamat" cols="30" rows="2" class="form-control" required><?php echo e($item->kanan_alamat); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="float-right">
                <a class="d-none d-sm-inline-block btn btn-secondary shadow-sm mr-2" href="<?php echo e(route('dashboard')); ?>"> Batalkan</a>
                <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm" id="btnSend">Simpan</a>
            </div>
        </div>
    </div>
</form>
<div id="alert"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
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
    
    // $('#form').submit(function(e){
    //     e.preventDefault();
    //     if($(this).valid()){
    //         $('#btnSend').addClass('disabled');
    //         $.ajax({
    //             url: "<?php echo e(Route('footer.update',1)); ?>",
    //             type: 'PATCH',
    //             // data: {
    //             //     kiri_judul  : 'Tes Judul'
    //             // },
    //             data: new FormData($('#form')[0]),
    //             contentType: false,
    //             processData: false,
    //             success: function(data) {
    //                 alert(data.message)
    //                 document.location.href = "<?php echo e(Route('footer.edit',1)); ?>"
    //             },
    //             error : function(data){
    //                 err = ''; respon = data.responseJSON;
    //                 $.each(respon.errors, function(index, value){
    //                     err += "<li>" + value +"</li>";
    //                 });
    //                 $('#alert').html("<div class='alert alert-danger alert-dismissible mt-3 mb-0'></button>" + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
    //                 $('#btnSend').removeClass('disabled');
    //             }
    //         });
    //     }
    //     return false;
    // })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookpro/Documents/jdih_dev/resources/views/frontend/footer/edit.blade.php ENDPATH**/ ?>