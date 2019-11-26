var sidang_table = $('#data-sidang').DataTable({
    "ajax": {
      "type":"POST",
      "data":function(d){
          d.option = $('#select-nilai').children('option:selected').val();
      },
      "url":base_url("Dosen/Sidang/Data"),
      "dataSrc": function(json){
        return json.data;
      }
    },
    "columns": [
      {"render":function(data, type, row, meta){return '';}, title:"#", "orderable":false},
      {"data": "judul_proyek", title:"Judul Proyek"},
      {"data": "tgl_sidang", title:"Tanggal Sidang"}
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
  
  sidang_table.on( 'order.dt search.dt', function () {
      sidang_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
      });
  }).draw();
$(function(){

});