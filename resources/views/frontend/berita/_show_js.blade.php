<script>
function show(id){
    $('#loading').show();
    $.get("{{ Route('pengajuan.show', ':id') }}".replace(':id', id), function(data){
        $('#tentang').html(data.tentang);
        $('#id_jenis').html(data.jenis_peraturan.name);
        $('#id_jenis_sub').html(data.jenis_peraturan_sub.name);
        $('#tgl_booking').html(data.tgl_booking);
        $('#note').html(data.note);
        $('#tahun_pembuatan').html(data.tahun_pembuatan);
        $('#instansiname').html(data.instansiname);
        $('#no_produk_hukum').html(data.no_produk_hukum);
        $('#narahubung').html(data.narahubung);
        vSyarat = '';
        vLLepas = '';
        textNull = "<tr><td colspan='3'><center>Tidak ada data.</center></td></tr>";
        if(data.upload_files.length > 0){
            sftp_src = "{{ config('app.sftp_src') }}";
            $.each(data.upload_files, function(index, value){
                if(value.file_for == 'skpd'){
                    vSyarat += "<tr><td width='50px' align='right'>" + parseInt(index + 1) + "</td><td>" + value.filename + "</td><td width='120px'><a href='" + sftp_src + value.path_files + value.folder_files + value.file_name_server + "' target='_blank'><i class='fas fa-sm fa-download'></i> Unduh</a></td></tr>";
                }
                if(value.file_for == 'lembarlepas'){
                    vLLepas += "<tr><td width='50px' align='right'>" + parseInt(index + 1) + "</td><td>" + value.filename + "</td><td width='120px'><a href='" + sftp_src + value.path_files + value.folder_files + value.file_name_server + "' target='_blank'><i class='fas fa-sm fa-download'></i> Unduh</a></td></tr>";
                }
            });
        }
        if(vSyarat == ''){
            vSyarat = textNull;
        }
        if(vLLepas == ''){
            vLLepas = textNull;
        }
        $('#vSyarat').html(vSyarat);
        $('#vLLepas').html(vLLepas);
        
        $.fancybox.open({
            src  : '#vPengajuan',
            type : 'inline',
            opts : {
                clickSlide: false,
                clickOutside: false
            }
        });
        $('#loading').hide();
    });
}
</script>