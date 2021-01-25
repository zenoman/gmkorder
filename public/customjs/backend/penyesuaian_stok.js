$(function() {
    $('.select2').select2();

    $('.select2').on('select2:select', function(e) {
        $('#panelnya').loading('toggle');
        var kode = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/backend/penyesuaian-stok/cari-detail-barang/' + kode,
            success: function(data) {
                return {
                    results: $.map(data, function(item) {
                        $("#stok").val(item.stok);
                        $("#hpp").val(item.hpp);
                        $("#harga_jual").val(item.harga);
                        $('#aksi').focus();
                    })
                }
            },
            complete: function() {
                $('#panelnya').loading('stop');
            }
        });
    });
});

function validasiinput(){
    if($('#keterangan').val()=='' ||$('#jumlah').val()==''||$('#stok').val()==''){
        Swal.fire({
            title: 'Maaf',
            text: 'Semua data wajib di isi!'
          })
        return false;
    }else{
        return true;
    }
}