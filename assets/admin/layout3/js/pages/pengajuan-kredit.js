$(function(){
	$("#l_kategori_no, #q_l_kategori_no").change(function(){		
		var id=$(this).attr("id");
		var parent = $(this).parent();
		var nilai = $(this).val();
		var data={'id':nilai};
		if (id=="l_kategori_no"){
			var target_combo = $("#l_merk_no");
		}else{
			var target_combo = $("#q_l_merk_no");				
		}
		var url = "ajax/get_merk";
		cari_ajax_combo("post", parent, data, target_combo, url);
		$("#select2-l_merk_no-container").html("");
		$("#select2-l_barang_no-container").html("");
	})
	
	$("#l_merk_no, #q_l_merk_no").change(function(){		
		var id=$(this).attr("id");
		var parent = $(this).parent();
		var nilai = $("#l_kategori_no").val();
		var merk = $("#"+id).val();
		var data={'id':nilai,'merk':merk};
		if (id=="l_merk_no"){
			var target_combo = $("#l_barang_no");
		}else{
			var target_combo = $("#q_l_barang_no");				
		}
		var url = "ajax/get_barang";
		cari_ajax_combo("post", parent, data, target_combo, url);
		$("#select2-l_barang_no-container").html("");
	})
});