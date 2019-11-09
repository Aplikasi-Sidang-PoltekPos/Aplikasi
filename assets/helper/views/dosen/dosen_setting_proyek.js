
function load_progress(){
    $.ajax({
        url:base_url("Dosen/SettingProyek/Data"),
        type:'get',
        contentType: false,
        processData: false,
        success: function(response){
          var res = JSON.parse(response);
          text_setter(res.data_kegiatan.data, 'form');
            var html = "<li>";
            html += '<span class="text">ISIKONTEN</span>';
            html += '<small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>'
            html += '<div class="tools">';
            html += '<i class="fas fa-edit"></i>';
            html += '<i class="fas fa-trash-alt"></i>';
            html += '</div>';
            html += '</li>';
            $('#list-progress').empty();
            $.each(res.data_progress.data, function(index, value){
                var content = html;
                content = content.replace('ISIKONTEN', value.nama_progress);
                $('#list-progress').append(content);
            });
            //$('#list-progress').append(html);
        }
      });
}
load_progress();
$(function(){
    $("input.number").on("keypress keyup blur",function (event) {    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
         if ((event.which < 48 || event.which > 57)) {
             event.preventDefault();
         }
     });
    $('#persentase_sidang').on('input', function(){
        hitung_persentase('sidang');
    });
    
    $('#persentase_bimbingan').on('input', function(){
        hitung_persentase('bimbingan');
    });
    $('#persentase_progress').on('input', function(){
        hitung_persentase('progress');
    });
    $('#tambah-progress').on('click', function(){
        var fd = new FormData();
        var isi = $('#judul-progress').val();
        fd.append('nama_progress', isi);
        fd.append('condition', 'insert');
        modify_progress(fd);
    });
    $('#btn-update').on('click', function(){
        var fd = form_data('form-proyek-koor');
        update_proyek(fd);
    });
});

function update_proyek(formdata){
    $.ajax({
        url:base_url("Dosen/SettingProyek/UpdateProyek"),
        type:'post',
        data:formdata,
        contentType: false,
        processData: false,
        success: function(response){
            alert_toast(response);
        }
      });
}

function modify_progress(formdata){
    $.ajax({
        url:base_url("Dosen/SettingProyek/SendSetting"),
        type:'post',
        data:formdata,
        contentType: false,
        processData: false,
        success: function(response){
            alert_toast(response);
            var res = JSON.parse(response);
            if(res.status=="success"){
                $('#judul-progress').val("");
            }
            load_progress();
        }
      });
}

function hitung_persentase(changed){
    var sidang = $('#persentase_sidang');
    var bimbing = $('#persentase_bimbingan');
    var progress = $('#persentase_progress');
    var total = parseInt(sidang.val())+parseInt(bimbing.val())+parseInt(progress.val());
    if(total>100){
        switch(changed){
            case "bimbingan": 
                bimbing.val(100-sidang.val()-progress.val());
            break;
            case "sidang":  
                sidang.val(100-bimbing.val()-progress.val());
            break;
            case "progress":   
                progress.val(100-bimbing.val()-sidang.val());
            break;
        }
    }
}