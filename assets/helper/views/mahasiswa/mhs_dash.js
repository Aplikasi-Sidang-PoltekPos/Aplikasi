$(function(){
   $('#accept').on('click', function(){
        var fd = new FormData();
        fd.append('status_acc', 'accept');
        $.ajax({
            url:base_url("Mahasiswa/Proyek/AccProposal"),
            type:'post',
            data:fd,
            contentType: false,
            processData: false,
            success: function(response){
              alert_toast(response);
              var data = JSON.parse(response);
              if(data.status=="success"){
                $('#heading').html('');
              }
            }
          });
      
   });

   $('#cancel').on('click', function(){
    var fd = new FormData();
    fd.append('status_acc', 'cancel');
    $.ajax({
        url:base_url("Mahasiswa/Proyek/AccProposal"),
        type:'post',
        data:fd,
        contentType: false,
        processData: false,
        success: function(response){
          alert_toast(response);
          var data = JSON.parse(response);
          if(data.status=="success"){
            $('#heading').html('');
          }
        }
      });
   });
});