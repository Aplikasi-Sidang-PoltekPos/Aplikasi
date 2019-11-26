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
      {"data": "nama_kegiatan", title:"Kegiatan"},
      {"data": "judul_proyek", title:"Judul"},
      {"render": function(data, type, row, meta){
        var kewajiban = row.min_bimbingan-row.total_bimbingan;
        if(kewajiban<=0){
          return '0';
        }else{
          return kewajiban;
        }
      }, title:"Kewajiban Bimbingan",  width:"10%"},
      {"render":
        function(data, type, row, meta){
          var anggota = "";
          if(row.npm_anggota!=null){
            anggota = '<p>'+row.nama_anggota+'('+row.npm_anggota+')</p>';
          }
          return '<p>'+row.nama_ketua+'('+row.npm_ketua+')</p>'+anggota;
        }, title:"Peserta"
      },
      {"render":
        function(data, type, row, meta){
            return "<button class='btn btn-success' id='tampilkan'>Tampilkan</button>";
        }, title:"Aksi"
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
  $(function(){
    $("#data-bimbingan tbody").on('click', '#tampilkan', function(){
        var data = bimb_table.row( $(this).parents('tr') ).data();
        $.redirect(window.location.href+"/Detail", {id_proyek:data.id_proyek});
    });
  });