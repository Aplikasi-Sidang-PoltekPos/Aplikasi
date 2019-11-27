var bimb_table = $('#data-bimbingan').DataTable({
    "ajax": {
      "type":"GET",
      "url":base_url("Mahasiswa/Bimbingan/Data"),
      "dataSrc": function(json){
        return json.data;
      }
    },
    "columns": [
      {"render":function(data, type, row, meta){return '';}, title:"#", "orderable":false},
      {"data": "tgl_bimbingan", title:"Tanggal Bimbingan", width:"20%"},
      {"render":function(data, type, row, meta){
        return '<button class="btn btn-block btn-warning" id="cek-daftar-progress">Cek Daftar Progress</button>';
      }, title:"Pembahasan"},
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


load_progress_combo();
function load_progress_combo(){
    $("#id_kegiatan_progress").empty();
    $.ajax({
      url:base_url("Mahasiswa/Bimbingan/GetProgress"),
      type:'get',
      contentType: false,
      processData: false,
      success: function(response){
        var data = JSON.parse(response);
        if(data.data.length>0){
          $("#id_kegiatan_progress").append('<option value = "" disabled selected>Pilih</option>');
          $.each(data.data, function(i){
            var row = data.data[i];
            $("#id_kegiatan_progress").append('<option value = "'+row.id_kegiatan_progress+'">'+row.judul_progress+'</option>');
          });
        }
      }
    });
    
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
          insert_bimbingan_progress();
          load_progress_combo();
        }
      },error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
        alert(xhr.responseText);
      }
    });
    
  });
  
  $('#tambah-bimbingan-progress').on('click', function(){
    add_bimbingan_progress();
  });
  
  $('#judul-bimbingan-progress').focus(function(){
    $(this).on('keypress', function(e){
      if(e.which == 13){
        add_bimbingan_progress();
      }
    });
  });
  $('input').keypress(function(e){
    if(e.which==13){
      return false;
    }
  });
  $('#list-bimbingan-progress').on('click', '#hapus-progress', function(){
    $(this).closest('li').remove();
    //$(this).closest('li').find('span').text();
  });
});

function add_bimbingan_progress(){
  if($('#judul-bimbingan-progress').val()!=""){
    var html = "<li>";
          html += '<span class="text">ISIKONTEN</span>';
          html += '<div class="tools">';
          html += '<i class="fas fa-trash-alt" id="hapus-progress"></i>';
          html += '</div>';
          html += '</li>';
          var progress = $('#judul-bimbingan-progress').val();
          var content = html.replace('ISIKONTEN', progress);
          $('#list-bimbingan-progress').append(content);
          $('#judul-bimbingan-progress').val("");
          $('#judul-bimbingan-progress').focus();
  }
}

function resetModal(){
  $('#tgl_bimbingan').val();
  $('#id_kegiatan_progress').eq(0).prop('selected', true);
  $('#list-bimbingan-progress').empty();
  $('#judul-bimbingan-progress').val("");
}

function insert_bimbingan_progress(){
  var data = [];
  $('ul#list-bimbingan-progress span').each(function(){
    data.push($(this).text());
  });
  var fd = new FormData();
  fd.append('listprogress', JSON.stringify(data));
  $.ajax({
    url:base_url("Mahasiswa/Bimbingan/InsertProgressBimbingan"),
    type:'post',
    data:fd,
    contentType: false,
    processData: false,
    success: function(response){
      var res = JSON.parse(response);
      alert_toast(response);
      if(res.status=="success"){
        
      }
      //$('#list-progress').append(html);
    }
  });
}
function load_bimbingan_progress(){
  $.ajax({
    url:base_url("Mahasiswa/Bimbingan/TampilProgress"),
    type:'get',
    contentType: false,
    processData: false,
    success: function(response){
      var res = JSON.parse(response);
        var html = "<li>";
        html += '<span class="text"><data></data>ISIKONTEN</span>';
        html += '<small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>'
        html += '<div class="tools">';
        html += '<i class="fas fa-edit"></i>';
        html += '<i class="fas fa-trash-alt"></i>';
        html += '</div>';
        html += '</li>';
        $('#list-bimbingan-progress').empty();
        $.each(res.data, function(index, value){
            var content = html;
            content = content.replace('ISIKONTEN', value.judul_progress);
            $('#list-bimbingan-progress').append(content);
        });
        //$('#list-progress').append(html);
    }
  });
}