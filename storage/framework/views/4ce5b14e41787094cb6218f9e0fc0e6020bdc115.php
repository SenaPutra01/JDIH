<?php $__env->startSection('content'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-plus fa-sm"></i> Tambah Berita</h1>
    
</div>

<form id="form">
    <div class="card border-bottom-0">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Berita Baru</h6>
        </div>
        <div class="card-body">
            
            <div class="row">
                <div class="col-12 col-sm-6">
                    
                    <div class="form-group row">
                        <label for="judul_berita" class="col-sm-4 col-form-label">Judul Berita <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <textarea name="judul_berita" id="judul_berita" cols="30" rows="3" class="form-control" required autofocus></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_singkat" class="col-sm-4 col-form-label">Deskripsi Singkat <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <textarea name="deskripsi_singkat" id="deskripsi_singkat" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        
        
                
                
        <div class="card-footer">
            <div class="float-right">
                <a class="d-none d-sm-inline-block btn btn-secondary shadow-sm mr-2" href="<?php echo e(route('berita.index')); ?>"> Batalkan</a>
                <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm" id="btnSend"><i class="fa fa-paper-plane"></i> Simpan</a>
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
            url: "<?php echo e(route('berita.store')); ?>",
            type: 'POST',
            data: new FormData($('#form')[0]),
            contentType: false,
            processData: false,
            success: function(data) {
                alert(data.message)
                document.location.href = "<?php echo e(Route('berita.index')); ?>"
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookpro/Documents/jdih_dev/resources/views/frontend/berita/create.blade.php ENDPATH**/ ?>