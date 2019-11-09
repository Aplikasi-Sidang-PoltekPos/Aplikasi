$.ajax({
    url:base_url("Dosen/SettingProyek/Data"),
    type:'get',
    contentType: false,
    processData: false,
    success: function(response){
      var res = JSON.parse(response);
      text_setter(res.data_kegiatan.data, 'form');
    }
  });
$(function(){
    $("input.number").on("keypress keyup blur",function (event) {    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
         if ((event.which < 48 || event.which > 57)) {
             event.preventDefault();
         }
     });
    $('#persentase_sidang').on('input', function(){
        var input = $(this).val();
        if($.isNumeric(input.substring(input.length-1, input.length))){
            hitung_persentase('sidang');
        }else{
            $(this).val(input.substring(0,input.length-1));
        }
        
    });
    
    $('#persentase_bimbingan').on('input', function(){
        var input = $(this).val();
        if($.isNumeric(input.substring(input.length-1, input.length))){
            hitung_persentase('bimbingan');
        }else{
            $(this).val(input.substring(0,input.length-1));
        }
    });
    $('#persentase_progress').on('input', function(){
        var input = $(this).val();
        if($.isNumeric(input.substring(input.length-1, input.length))){
            hitung_persentase('progress');
        }else{
            $(this).val(input.substring(0,input.length-1));
        }
    });
});

function hitung_persentase(changed){
    var sidang = $('#persentase_sidang');
    var bimbing = $('#persentase_bimbingan');
    var progress = $('#persentase_progress');
    var total = parseInt(sidang.val())+parseInt(bimbing.val())+parseInt(progress.val());
    if(total>100){
        switch(changed){
            case "bimbing": 
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