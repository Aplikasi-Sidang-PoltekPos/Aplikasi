var refreshData = true;
loadProgressBimbingan();
function loadProgressBimbingan(id_bimbingan){
    var fd = new FormData();
    fd.append('id_bimbingan', id_bimbingan);
    var html = "<li>";
    html+='<div class="icheck-primary d-inline ml-2">';
    html+='<input type="checkbox" name="IDKONTEN" value="IDKONTEN" id="IDKONTEN" stat>'
    html+='<label for="IDKONTEN"></label>';
    html+='</div>';
    html+='<span class="text">ISIKONTEN</span>';
    html+='</li>';
    $.ajax({
        url:base_url("Dosen/Bimbingan/Detail:ProgressBimbingan"),
        type:'POST',
        data:fd,
        contentType: false,
        processData: false,
        success: function(response){
            var res = JSON.parse(response);
            $('#bimbingan-progress').empty();
            $.each(res.data, function(key, val){
                var output = html;
                output = output.replace("ISIKONTEN",val.nama_progress).replace(/IDKONTEN/g, val.id_bimbingan_progress);
                if(val.status_penyelesaian=="1"){
                    output = output.replace("stat", "checked");
                }else{
                    output = output.replace("stat", "");
                }
                $('#bimbingan-progress').append(output);
            });
        }
    });
  }
var bimb_table = $('#data-bimbingan').DataTable({
    "ajax": {
      "type":"POST",
      "data":function(d){
          d.opsi_tampil = $('#opsi-tampil').children('option:selected').val();
      },
      "url":window.location.href+":Data",
      "dataSrc": function(json){
        if(parseInt(json.total_bimbingan)>=parseInt(json.minimal_bimbingan)){
            activate_tombol_sidang('1');
        }else{
            activate_tombol_sidang('0');
        }
        return json.data;
      }
    },
    "columns": [
      {"render":function(data, type, row, meta){return '';}, title:"#", "orderable":false},
      {"data": "tgl_bimbingan", title:"Tanggal Bimbingan"},
      {"data": "judul_progress", title:"Progress"},
      {"render":
        function(data, type, row, meta){
            return '<button class="btn btn-primary">Aksi</button>';
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
  
  
  function getProgressBimbingan(id_bimbingan){
    var textreturn = "";
    var res = JSON.parse(session.getSession('progressBimbingan'));
    $.each(res.data, function(key, val){
        if(val.id_bimbingan==id_bimbingan){
            switch(val.status_penyelesaian){
                case "0": textreturn = textreturn+"<input type='checkbox' value='"+val.id_bimbingan_progress+"'>"+val.nama_progress+"<br>"; break;
                case "1": textreturn = textreturn+"<input type='checkbox' value='"+val.id_bimbingan_progress+"' checked>"+val.nama_progress+"<br>"; break;
            }
        }
    });
    return textreturn;
  }

$(function(){
    
    $("#data-bimbingan tbody").on('click', 'button', function(){
        var data = bimb_table.row( $(this).parents('tr') ).data();
        session.setSession("id_bimbingan", data.id_bimbingan);
        loadProgressBimbingan(data.id_bimbingan);
        $('#modal-bimbingan').modal('toggle');
    });
    $('#opsi-tampil').on('change', function(){
        bimb_table.ajax.reload();
    });

    $('#save').on('click', function(){
        var checkedId = [];
        $.each($('#modal-bimbingan').find("input[type='checkbox']"), function(){
            if($(this).prop('checked')){
                checkedId.push({"id":$(this).val(), "status":"1"});
            }else{
                checkedId.push({"id":$(this).val(), "status":"0"});
            }
        });
        var fd = new FormData();
        fd.append('catatan', $('#catatan').val());
        fd.append('nilai_bimbingan', $('#nilai').val());
        fd.append('id_bimbingan', session.getSession("id_bimbingan"));
        fd.append('checkId_group', JSON.stringify(checkedId));
        $.ajax({
            url:base_url("Dosen/Bimbingan/Detail:Approve"),
            data:fd,
            type:'POST',
            contentType: false,
            processData: false,
            success: function(response){
                var result = JSON.parse(response);
                if(result.status=="success"){
                    $('#modal-bimbingan').modal('toggle');
                    bimb_table.ajax.reload();
                }
                alert_toast(response);
            }
        });
    });
});

function approve_bimbingan(data){
    
}

function activate_tombol_sidang(status){
    var tombol_sidang = $('#button-sidang');
    if(status=='1'){
        $('#button-sidang').on('click', function(){
            $.redirect(window.location.href+":Sidang", {total_bimbingan:total});
        });
        tombol_sidang.prop('disabled', false);
    }else{
        tombol_sidang.prop('disabled', true);
    }
}