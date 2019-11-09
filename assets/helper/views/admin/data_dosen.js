var columns = [
  {"render":function(data, type, row, meta){return '';}, title:"#", "orderable":false},
  {"data": "nik", title:"NIK"},
  {"data": "nama", title:"Nama"},
  {"render":
    function(data, type, row, meta){
      return row.tempat_lahir+", "+date_converter(row.tgl_lahir);
    }, title:"Tempat, Tanggal Lahir"
  },
  {"data": "alamat", title:"Alamat"},
  {"render":
    function(data, type, row, meta){
      return "<a href='https://"+row.link_jurnal+"'>"+row.judul_jurnal+"</a>";
    }, title:"Jurnal"
  },
  {"data": "research_interest", title:"Research Interest"}
];
var dsn_table = setting_table(window.location.href+"/Data", columns);

dsn_table.on( 'order.dt search.dt', function () {
    dsn_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();

$("#dsn_search").on('keyup', function(){
  dsn_table.search( this.value ).draw();
});

$(function(){
  $("#save").click(function(){
      var fd = form_data('form-dosen');
      $.ajax({
        url:window.location.href+"/Insert",
        type:'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          alert_toast(response);
          if(JSON.parse(response).status=="success"){
            $('#modal-dosen').modal('toggle');
            dsn_table.ajax.reload();
          }
          document.getElementById('save').disabled=true;
        }
      });
  });
  $("#delete").click(function(){
    alert_toast('{"title":"Coba", "text":"Mau Delete?", "status":"warning","yes_text":"Ya", "no_text":"No", "function_call":"cobain", "type":"confirmation"}');
    //Swal.fire('Success', 'Data Deleted', 'success');
  });
});
