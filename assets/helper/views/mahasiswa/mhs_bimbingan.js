var bimb_table = $('#data-bimbingan').DataTable({
    "ajax": {
      "type":"GET",
      "url":window.location.href+"/Data",
      "dataSrc": function(json){
        return json.data;
      }
    },
    "columns": [
      {"render":function(data, type, row, meta){return '';}, title:"#", "orderable":false},
      {"data": "tgl_bimbingan", title:"Tanggal Bimbingan"},
      {"data": "keterangan", title:"Pembahasan"},
      {"render":
        function(data, type, row, meta){
            if(row.status_bimbingan=="0"){
                return "Belum Disetujui";
            }else{
                return "Sudah Disetujui";
            }
        }, title:"Status Approval"
      }
    ],
    "paging": true,
    "scrollX": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "responsive":true,
    "autoWidth": false,
    "order": [[ 1, 'asc' ]],
    "dom":'t<"bottom"p>'
  });
  
  bimb_table.on( 'order.dt search.dt', function () {
      bimb_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
      });
  }).draw();

setInterval(function(){
    bimb_table.ajax.reload();
}, 5000);
load_progress_combo();
function load_progress_combo(){
    $("#id_progress").empty();
    $.ajax({
      url:base_url("Mahasiswa/Bimbingan/GetProgress"),
      type:'get',
      contentType: false,
      processData: false,
      success: function(response){
        var data = JSON.parse(response);
        if(data.data.length>0){
          $("#id_progress").append('<option value = "" disabled selected>Pilih</option>');
          $.each(data.data, function(i){
            var row = data.data[i];
            $("#id_progress").append('<option value = "'+row.id_progress+'">'+row.judul_progress+'</option>');
          });
        }
      }
    });
    $("#id_progress").select2(
      {
        theme:"bootstrap"
      }
    );
}
$(function(){
  $('#save').on('click', function(){
    var fd = form_data('form-bimbingan');
    $.ajax({
      url:window.location.href+"/Insert",
      type:'POST',
      data:fd,
      contentType: false,
      processData: false,
      success: function(response){
        alert_toast(response);
        if(JSON.parse(response).status=="success"){
          bimb_table.ajax.reload();
          $('#modal-bimbingan').modal('toggle');
        }
      },error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
        alert(xhr.responseText);
      }
    });
  });
});