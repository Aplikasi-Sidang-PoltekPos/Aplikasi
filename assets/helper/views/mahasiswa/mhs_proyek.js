var timer;

$(function(){
  setContentView();
  var configall = "";
  function setContentView(){
    $.ajax({
      url:window.location.href+"/Data",
      type:'get',
      contentType: false,
      processData: false,
      success: function(response){
        var data = JSON.parse(response);
        if(data.col_config!=""){
          $('#content-data').load(window.location.href+"/Content", {content:data.col_config}, function(){
            configall = data.col_config;
            setContentData(data.col_config);
          });
        }
      }
    }); 
  }
  
  function setContentData(config){
    template_event(config);
    if(config=="detail"){
      var fd = new FormData();
      fd.append('config', config);
      load_detail_data(fd);
      timer = setInterval(function(){
        load_detail_data(fd);
      }, 5000);    
    }
  }
  function load_obyek_penelitian(){
    $('#obyek_penelitian').empty();
    $.ajax({
      url:base_url("Mahasiswa/Proyek/TampilObyek"),
      type:'get',
      contentType: false,
      processData: false,
      success: function(response){
        var res = JSON.parse(response);
        $.each(res.data, function(index, value){
          var tags = $('#obyek_penelitian');
          tags.append('<option value="'+value.id_penelitian+'">'+value.nama_penelitian+'</option>')
        });
      }
    });
  }
  
  function template_event(view){
    if(view=="detail"){
      $('#modal-pilih-anggota').on('click', '#save', function(){
        var fd = form_data('form-ajukan-anggota');
        $.ajax({
          url:window.location.href+"/AjukanAnggota",
          type:'post',
          data:fd,
          contentType: false,
          processData: false,
          success: function(response){
            alert_toast(response);
            var data = JSON.parse(response);
            if(data.status=="success"){
              setContentData('detail');
              $('#modal-pilih-anggota').modal('toggle');
            }
          }
        });
      });
      $('#modal-pilih-anggota').on('shown.bs.modal', function(e){
        refreshComboAnggota();
      });
      $('#modal-anggota-proyek').on('click', '#accept', function(){
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
                $('#modal-anggota-proyek').modal('hide');
                setContentData('detail');
              }
            }
          });
        });

        $('#modal-anggota-proyek').on('click', '#cancel',function(){
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
                  $('#modal-anggota-proyek').modal('hide');
                  setContentView();
                }
              }
            });
        });
    }else if(view=="kegiatan"){
      load_obyek_penelitian();
      var kegiatan_table = $('#data-kegiatan').DataTable({
        "ajax": {
          "type":"POST",
          "data":function(d){
            d.config = view,
            d.tampilngulang = $('#check-ngulang').prop('checked')
          },
          "url":window.location.href+"/Data:Proyek",
          "dataSrc": function(json){
            return json.data;
          }
        },
        "columns": [
          {"render":function(data, type, row, meta){return '';}, title:"#", "orderable":false},
          {"data": "nama_kegiatan",title:"Kegiatan"},
          {"render":
            function(data, type, row, meta){
              return date_converter(row.tgl_mulai)+"-"+date_converter(row.tgl_selesai);
            }, title:"Tanggal Kegiatan"
          },
          {"data": "nama_prodi", title:"Program Studi"},
          {"data": "semester", title:"Semester"},
          {"render":
            function(data, type, row, meta){
              return '<button type="button" class="btn btn-default" id="btn-pilih-kegiatan">Ikuti</button>';
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

      timer = setInterval(function(){
        kegiatan_table.ajax.reload();
      }, 5000);
      
      kegiatan_table.on( 'order.dt search.dt', function () {
        kegiatan_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
      }).draw();
      var id_kegiatan = "";
      $("#data-kegiatan tbody").on('click', '#btn-pilih-kegiatan', function(){
        var data = kegiatan_table.row( $(this).parents('tr') ).data();
        id_kegiatan = data.id_kegiatan;
        $("#modal-pilih-kegiatan").modal('toggle');
        refreshComboAnggota();
      });
      $("#check-ngulang").on('change', function(){
        kegiatan_table.ajax.reload();
      });
      $("#modal-pilih-kegiatan").on('click', '#save-pilih-kegiatan', function(){
        $("#modal-pilih-kegiatan").modal('toggle');
        var fd = form_data('form-pilih-kegiatan');
        fd.append('id_kegiatan', id_kegiatan);
        id_kegiatan = "";
        $.ajax({
          url:window.location.href+"/Insert",
          type:'POST',
          data:fd,
          contentType: false,
          processData: false,
          success: function(response){
            var data = JSON.parse(response);
            alert_toast(response);
            if(data.status=="success"){
              setContentView();
            }
          },error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            alert(xhr.responseText);
          }
        });
      });
    }
  }
});

function refreshComboAnggota(){
  $("#npm_anggota").empty();
    $.ajax({
      url:window.location.href+"/Data:Anggota",
      type:'get',
      contentType: false,
      processData: false,
      success: function(response){
        var data = JSON.parse(response);
        if(data.data.length>0){
          $("#npm_anggota").append('<option value = "" disabled selected>Pilih Anggota</option>');
          $.each(data.data, function(i){
            var row = data.data[i];
            $("#npm_anggota").append('<option value = "'+row.npm+'">'+row.nama+' ('+row.npm+')</option>');
          });
        }
      }
    });
    $("#npm_anggota, #obyek_penelitian").select2(
      {
        theme:"bootstrap"
      }
    );
}

function load_detail_data(fd){
  $.ajax({
    url:window.location.href+"/Data:Proyek",
    type:'POST',
    data:fd,
    contentType: false,
    processData: false,
    success: function(response){
      var data = JSON.parse(response);
      switch(data.data[0].status_proyek){
        case "0": 
          data.data[0].status_proyek="Anggota Belum Acc";
          if(data.data[0].npm_anggota==null){
            data.data[0].status_proyek="Anggota Menolak<br><button type='button' class='btn btn-primary' id='ajukan-anggota-ulang' data-toggle='modal' data-target='#modal-pilih-anggota'>Ajukan Ulang</button>";
          }else if(data.extras.status_anggota=="anggota"){
            data.data[0].status_proyek="Butuh Persetujuan Sebagai Anggota<br><button type='button' class='btn btn-primary' id='ajukan-anggota-ulang' data-toggle='modal' data-target='#modal-anggota-proyek'>Terima</button>";
          }
          
          $('#nama_proyek').html('Nama Proyek : '+data.data[0].nama_kegiatan);
          $('#nama_pemohon').html('Nama Pemohon : '+data.data[0].nama_ketua);
        break;
        case "1": data.data[0].status_proyek="Belum Diterima"; break;
        case "2": data.data[0].status_proyek="Diterima"; break;
      }
      //GN01 Ini Yang Diganti (Text)
      text_setter(data.data, 'text');
    }
  });
}

