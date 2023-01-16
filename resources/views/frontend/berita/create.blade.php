@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-plus fa-sm"></i> Tambah Berita</h1>
    {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50 mr-1"></i> Batalkan Pengajuan</a> --}}
</div>

<form id="form">
    <div class="card border-bottom-0">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Berita Baru</h6>
        </div>
        <div class="card-body">
            {{-- <div class="form-group row">
                <label for="nama_menu" class="col-sm-2 col-form-label"><b>Nama Menu</b> <span class="text-danger ml-1">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_menu" id="nama_menu" required>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-12 col-sm-6">
                    {{-- <div class="form-group row">
                        <label for="kategori_berita" class="col-sm-4 col-form-label">Kategori Berita <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <select name="kategori_berita" id="kategori_berita" class="form-control">
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div> --}}
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
                    <div class="form-group row">
                        <label for="deskripsi_singkat" class="col-sm-4 col-form-label">Deskripsi Singkat <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <textarea name="deskripsi_singkat" id="deskripsi_singkat" cols="30" rows="5" class="form-control"></textarea>
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
                    {{-- <div class="form-group row">
                        <label for="tahun_pembuatan" class="col-sm-4 col-form-label">Tahun <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control col-sm-6" name="tahun_pembuatan" id="tahun_pembuatan" value="{{ date('Y') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="instansiname" class="col-sm-4 col-form-label">Perangkat Daerah/Unit <span class="text-danger ml-1">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" name="instansiname" id="instansiname" value="{{ Auth::user()->instansiname }}" required>
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
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        {{-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-bottom-0">
            <h6 class="m-0 font-weight-bold text-primary">Syarat Pengajuan A</h6>
        </div> --}}
        {{-- <div class="card-body p-0">
            <table class="table"> --}}
                {{-- <thead>
                    <tr>
                        <th>No</th>
                        <th>Syarat</th>
                        <th>Ketentuan</th>
                        <th>Unggah File</th>
                    </tr>
                </thead> --}}
                {{-- <tbody id="syarat">
                    @foreach($peraturan_sub_syarats as $k=>$peraturan_sub_syarat)
                    <tr>
                        <td width="50px" align="right">{{ $k+1 }}</td>
                        <td>{{ $peraturan_sub_syarat->name }} <small>({{ $peraturan_sub_syarat->ext }})</small>@if($peraturan_sub_syarat->c_required == 1) <span class="text-danger ml-1">*</span>@endif</td>
                        <td width="100px">{{ $peraturan_sub_syarat->c_required == 1 ? 'wajib' : 'tentatif' }}</td>
                        <td width="120px"><input type="file" name="syarat[{{ $peraturan_sub_syarat->id_jenis_sub_syarat }}]" id="syarat[{{ $peraturan_sub_syarat->id_jenis_sub_syarat }}]"@if($peraturan_sub_syarat->c_required == 1) required @endif/></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
        <div class="card-footer">
            <div class="float-right">
                <a class="d-none d-sm-inline-block btn btn-secondary shadow-sm mr-2" href="{{ route('berita.index') }}"> Batalkan</a>
                <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm" id="btnSend"><i class="fa fa-paper-plane"></i> Simpan</a>
            </div>
        </div>
    </div>
</form>
<div id="alert"></div>
@endsection

@push('scripts')
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
    $.get("{{ route('peraturanSub', ':id_jenis') }}".replace(':id_jenis', $(this).val()), function(res){
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
    $.get("{{ route('peraturanSubSyarat', ':id_jenis_sub') }}".replace(':id_jenis_sub', $(this).val()), function(res){
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

    //$.get("{{ route('noNotaDinas', [':id_jenis_sub', ':tahun_pembuatan']) }}".replace(':id_jenis_sub', $(this).val()).replace(':tahun_pembuatan', $('#tahun_pembuatan').val()), function(res){
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
            url: "{{ route('berita.store') }}",
            type: 'POST',
            data: new FormData($('#form')[0]),
            contentType: false,
            processData: false,
            success: function(data) {
                alert(data.message)
                document.location.href = "{{ Route('berita.index') }}"
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
@endpush