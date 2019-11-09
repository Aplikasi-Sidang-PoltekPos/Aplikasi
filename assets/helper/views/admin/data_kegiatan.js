var columns = [
  {"render":function(data, type, row, meta){return '';}, title:"#", "orderable":false},
  {"data": "nama_kegiatan",title:"Kegiatan"},
  {"render":
    function(data, type, row, meta){
      return date_converter(row.tgl_mulai)+"-"+date_converter(row.tgl_selesai);
    }, title:"Tanggal Kegiatan"
  },
  {"data":"nama_koor", title: "Koordinator"},
  {"data": "angkatan", title:"Tahun Ajaran"},
  {"data": "semester", title:"Semester"}
  /*,
  {"render":
    function(data, type, row, meta){
      switch(row.status_mulai){
        case "0": return "<button class='btn btn-default' id='btn_mulai'>Mulai</button>"; break;
        case "1": return "Berjalan"; break;
        case "2": return "Selesai"; break;
      }
    }, title:"Status"
  }*/
];
var kegiatan_table = setting_table(window.location.href+"/Data", columns);
$(function(){
  kegiatan_table.on( 'order.dt search.dt', function () {
      kegiatan_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
      } );
  }).draw();

  $("#kegiatan_search").on('keyup', function(){
    kegiatan_table.search( this.value ).draw();
  });

  $("#data-kegiatan tbody").on('click', '#btn_mulai', function(){
    var data = kegiatan_table.row( $(this).parents('tr') ).data();
    var fd = {id_kegiatan:data.id_kegiatan};
    var notif_config = {
      title:"Mulai Kegiatan?",
      message:"Kegiatan "+data.nama_kegiatan+" yakin dimulai?",
      status:"question",
      yes_text:"Ya",
      no_text:"Tidak",
      function_call:"mulai_kegiatan",
      param:fd,
      type:"confirmation"
    };
    alert_toast(JSON.stringify(notif_config));
  });

  $("#form-kegiatan-modal").click(function(){
    $("#id_koordinator").empty();
    $.ajax({
      url:base_url("Admin/Kegiatan/DataKoor"),
      type:'get',
      contentType: false,
      processData: false,
      success: function(response){
        var data = JSON.parse(response);
        if(data.data.length>0){
          $("#id_koordinator").append('<option value = "" disabled selected>Pilih Dosen</option>');
          $.each(data.data, function(i){
            var row = data.data[i];
            $("#id_koordinator").append('<option value = "'+row.nik+'">'+row.nama+'</option>');
          });
        }else{
          $("#id_koordinator").append('<option value = "" disabled selected>Tidak Ada Dosen Tersedia</option>');
        }
      }
    });
  });

  $("#save").click(function(){
    var fd = form_data('form-kegiatan');

    $.ajax({
      url:window.location.href+"/Insert",
      type:'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        alert_toast(response);
        if(JSON.parse(response).status=="success"){
          $('#modal-kegiatan').modal('toggle');
          kegiatan_table.ajax.reload();
          form_clear('form-kegiatan');
        }
      }
    });
  });

  $("#delete").click(function(){
    Swal.fire('Success', 'Data Deleted', 'success');
  });

  
  
});

function hitung_persentase(changed){
  var sidang = $('#persentase_sidang');
  var bimbing = $('#persentase_bimbingan');
  if(sidang.val()+bimbing.val()>100){
    switch(changed){
      case "bimbing": sidang.val(100-bimbing.val()); break;
      case "sidang": bimbing.val(100-sidang.val()); break;
    }
  }
}

function mulai_kegiatan(data){
  var fd = new FormData();
  for ( var key in data ) {
      fd.append(key, data[key]);
  }

  $.ajax({
      url:window.location.href+"/UpdateStatus",
      data:fd,
      type:'POST',
      contentType: false,
      processData: false,
      success: function(response){
        var result = JSON.parse(response);
        if(result.status=="success"){
            kegiatan_table.ajax.reload();
        }
        alert_toast(response);
      }
  });
}