jQuery(document).ready(function($) {
  $('#nama_rekanan').change(function() {
      var id_rekanan = $(this).val();

      var category = $(this).data('category');

      $.get(home_url + '/amp/pesanan/getAddress', function(data) {
          var data = $.parseJSON(data);
          var alamat_rekanan = $('#alamat_rekanan'),
          category_rekanan = $('#category_rekanan');
          alamat_rekanan.empty();
          category_rekanan.empty();

          $.each(data, function(key, value) {
            if (value.id_rekanan == id_rekanan) {
              alamat_rekanan.val(value.alamat);
              category_rekanan.val(value.category_rekanan);
            }
          });
      });
  }); 

  $('#volume_kontrak, #harga_satuan, #ppn').change(function() {
  		var volume_kontrak = $('#volume_kontrak').val(),
  		harga_satuan = $('#harga_satuan').val(),
  		ppn = $('#ppn').val()

  		if (volume_kontrak != 0 && harga_satuan != 0) {

        var ppn = (volume_kontrak*harga_satuan) * (ppn/100);
  			$('#jumlah_harga').val(volume_kontrak * harga_satuan + ppn);
  		}
  });

	var no_pesanan1 = 1, no_pesanan2 = 1;

	$('#save_pesanan1').click(function(e) {
  	e.preventDefault();

		var uraian = $('#uraian_pesanan1'),
		volume_kontrak = $('#volume_kontrak'),
		harga_satuan = $('#harga_satuan');
		jumlah_harga = $('#jumlah_harga');

    var html_input = '<div id="countPesanan" data-id="'+no_pesanan1+'"><input type="text" name="uraian_pesanan[]" value="'+uraian.val()+'" data-id="'+no_pesanan1+'" readonly="readonly"><input type="text" name="volume_kontrak[]" value="'+volume_kontrak.val()+'" data-id="'+no_pesanan1+'" readonly="readonly"><input type="text" name="harga_satuan[]" value="'+harga_satuan.val()+'" data-id="'+no_pesanan1+'" readonly="readonly"><input type="text" name="jumlah_harga[]" value="'+jumlah_harga.val()+'" data-id="'+no_pesanan1+'" readonly="readonly"></div>';

  	var html_tabel = '<tr class="gradeU"><td>'+no_pesanan1+'</td><td>'+$("#uraian_pesanan1 option:selected").html()+'</td><td>'+volume_kontrak.val()+'</td><td>'+harga_satuan.val()+'</td><td>'+jumlah_harga.val()+'</td><td><a class="btn btn-danger btn-sm btn-icon icon-left remove__table" data-id="'+no_pesanan1+'" href=""><i class="entypo-eye" ></i>Hapus</a></td></tr>';

  	$('#load__pesanan1').append(html_input);
  	$('#load__table_pesanan1').append(html_tabel);

  	// uraian.val('');
    $("#uraian_pesanan1").val("").change();
  	volume_kontrak.val('');
  	harga_satuan.val('');
  	jumlah_harga.val();

  	no_pesanan1++;
  }); 

  $(document).on('click', '.remove__table', function(e) {
    e.preventDefault();

    var id=$(this).data('id');

    $('#countPesanan').find('[data-id='+id+']').remove();
    $(this).parent().parent().remove();
  });
});

