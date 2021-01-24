$(function () {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })
    $('.select2').select2();

    $(".select2").val(null).trigger('change');

    //=================================================
    $('#produk').on('select2:select',function(e){
      $('#panelnya').loading('toggle');
        var kode = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/backend/transaksi-manual/cari-detail-barang/'+kode,
            success:function (data){
          return {
            results : $.map(data, function (item){
              $("#stok").val(item.stok);
              $("#harga").val(item.harga_jual);
            })
          }
        },complete:function(){
                  $('#panelnya').loading('stop');
              }
              });
          });
  });
  