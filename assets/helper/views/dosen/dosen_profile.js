$(function(){
    $("#save").on('click', function(){
        var fd = form_data('form-profile');
        $.ajax({
            url:window.location.href+"/Update",
            type:'POST',
            data:fd,
            contentType: false,
            processData: false,
            success: function(response){
              var data = JSON.parse(response);
              alert_toast(response);
              if(data.status=="success"){
                  $('#modal2').modal('toggle');
                  form_setter(fd);
              }
            },error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                alert(xhr.responseText);
              }
          }); 
    });
});