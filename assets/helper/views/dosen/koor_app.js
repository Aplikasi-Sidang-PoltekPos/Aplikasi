var id_proyek = "";
var approval_table = $('#data-approval').DataTable({
    "ajax": {
      "type":"POST",
      "url":window.location.href+"/Data",
      "dataSrc": function(json){
        return json.data;
      }
    },
    "columns": [
      {"render":function(data, type, row, meta){return '';}, title:"#", "orderable":false},
      {"data": "judul_proyek", title:"Judul Proyek"},
      {"data": "nama_kegiatan",title:"Kegiatan"},
      {"render":
        function(data, type, row, meta){
          return '<button type="button" class="btn btn-default" id="btn-approve">Aksi</button>';
        }, title:"Aksi"
      }
    ],
    "paging": true,
    "scrollX": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    "responsive":true,
    "order": [[ 1, 'asc' ]],
    "dom":'t<"bottom"p>'
  });

  approval_table.on( 'order.dt search.dt', function () {
    approval_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    });
  }).draw();
  setInterval(function(){
      approval_table.ajax.reload();
  }, 5000);
  function proyek_tolak(id){
    var fd = new FormData();
    fd.append('id_proyek', id);
    $.ajax({
        url:window.location.href+"/Tolak",
        type:'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          alert_toast(response);
          if(JSON.parse(response).status=="success"){
            approval_table.ajax.reload();
          }
        }
      });
  }

  function pilih_pembimbing(){
    $.ajax({
      url:base_url("Dosen/Approval/PilihPembimbing:Data"),
      type:'post',
      contentType:false,
      processData:false,
      success:function(response){
        $("#select-pembimbing").empty();
        $.each(JSON.parse(response).data, function(index, value){
          $("#select-pembimbing").append("<option value='"+value.nik+"'>"+value.nama+"</option>");
        });
      }
    });
  }

  function approve_proyek(){
    var fd = form_data('form-approval');
    fd.append('id_proyek', id_proyek);
    id_proyek = "";
    $.ajax({
      url:base_url("Dosen/Approval/PilihPembimbing:Update"),
      type:'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        alert_toast(response);
        if(JSON.parse(response).status=="success"){
            $("#modal-approval").modal('toggle');
            approval_table.ajax.reload();
        }
      }
    }); 
  }
$(function(){    
      $("#data-approval tbody").on('click', '#btn-approve', function(){
        var data = approval_table.row( $(this).parents('tr') ).data();
        $('#modal-approval').modal('toggle');
        id_proyek = data.id_proyek;
        pilih_pembimbing();
        //session.setSessions({id_proyek:data.id_proyek, judul_proyek:data.judul_proyek});
        //window.location.href=base_url("Dosen/Approval/PilihPembimbing");
      });

      $("#data-approval tbody").on('click', '#btn-tolak', function(){
        var data = approval_table.row( $(this).parents('tr') ).data();
        var notif_config = {
            title:"Anda yakin mau menolak proposal ini?",
            message:"Judul Proposal : "+data.judul_proyek,
            status:"question",
            yes_text:"Ya",
            no_text:"Tidak",
            function_call:"proyek_tolak",
            param:data.id_proyek,
            type:"confirmation"
          };
          alert_toast(JSON.stringify(notif_config));
      });

      $('#save').on('click', function(){
        approve_proyek();
      });
});