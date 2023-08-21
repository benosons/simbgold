$(function(){
	$("#l_prop_no, #q_l_prop_no").change(function(){		
		var id=$(this).attr("id");
		var parent = $(this).parent();
		var nilai = $(this).val();
		var data={'id':nilai};
		if (id=="l_prop_no"){
			if($('#l_kota_no').length) 
				var target_combo = $("#l_kota_no");
			else
				var target_combo = $("#l_parent_coklit_no");
		}else{
			if($('#q_l_kota_no').length) 
				var target_combo = $("#q_l_kota_no");
			else
				var target_combo = $("#q_l_parent_coklit_no");
				
		}
		var url = "ajax/get_kota";
		cari_ajax_combo("post", parent, data, target_combo, url);
		$("#select2-l_tps_no-container").html("");
		$("#select2-l_dusun_no-container").html("");
		$("#select2-l_kelurahan_no-container").html("");
		$("#select2-l_kecamatan_no-container").html("");
		$("#select2-l_kota_no-container").html("");
	})
	$("#l_kota_no, #q_l_kota_no").change(function(){	
		var id=$(this).attr("id");
		var parent = $(this).parent();
		var nilai = $(this).val();
		var data={'id':nilai};
		if (id=="l_kota_no"){
			if($('#l_kecamatan_no').length) 
				var target_combo = $("#l_kecamatan_no");
			else
				var target_combo = $("#l_parent_coklit_no");
		}else{
			if($('#q_l_kecamatan_no').length) 
				var target_combo = $("#q_l_kecamatan_no");
			else
				var target_combo = $("#q_l_parent_coklit_no");
				
		}
		var url = "ajax/get_kecamatan";
		cari_ajax_combo("post", parent, data, target_combo, url);
		$("#select2-l_tps_no-container").html("");
		$("#select2-l_dusun_no-container").html("");
		$("#select2-l_kelurahan_no-container").html("");
		$("#select2-l_kecamatan_no-container").html("");
	})
	
	$("#l_kecamatan_no, #q_l_kecamatan_no").change(function(){	
		var id=$(this).attr("id");
		var parent = $(this).parent();
		var nilai = $(this).val();
		var data={'id':nilai};
		
		if (id=="l_kecamatan_no"){
			if($('#l_kelurahan_no').length) 
				var target_combo = $("#l_kelurahan_no");
			else
				var target_combo = $("#l_parent_coklit_no");
		}else{
			if($('#q_l_kelurahan_no').length){ 
				var target_combo = $("#q_l_kelurahan_no");
			}else{
				var target_combo = $("#q_l_parent_coklit_no");
			}
		}
		var url = "ajax/get_kelurahan";
		if (modul_name!=='data_rqc' || $('#q_l_kelurahan_no').length){
			cari_ajax_combo("post", parent, data, target_combo, url);
			$("#select2-l_tps_no-container").html("");
			$("#select2-l_dusun_no-container").html("");
			$("#select2-l_kelurahan_no-container").html("");
		}
	})
	$("#l_kelurahan_no, #q_l_kelurahan_no").change(function(){	
		if($('#q_l_dusun_no').length || $('#l_dusun_no').length || $('#l_tps_no').length || $('#l_parent_coklit_no').length){
			var id=$(this).attr("id");
			var parent = $(this).parent();
			var nilai = $(this).val();
			var data={'id':nilai};
			if (id=="l_kelurahan_no"){
				if($('#l_dusun_no').length) 
					var target_combo = $("#l_dusun_no");
				else if($('#l_tps_no').length) 
					var target_combo = $("#l_tps_no");
				else
					var target_combo = $("#l_parent_coklit_no");
			}else{
				if($('#q_l_dusun_no').length) 
					var target_combo = $("#q_l_dusun_no");
				else if($('#q_l_tps_no').length) 
					var target_combo = $("#q_l_tps_no");
				else
					var target_combo = $("#q_l_parent_coklit_no");
					
			}
			if($('#l_tps_no').length) 
				var url = "ajax/get_tps";
			else
				var url = "ajax/get_dusun";
			cari_ajax_combo("post", parent, data, target_combo, url);
			
			$("#select2-l_tps_no-container").html("");
			$("#select2-l_dusun_no-container").html("");
		}
	})
	
	$("#l_dusun_no, #q_l_dusun_no").change(function(){		
		var id = $(this).attr("id");
		var kel=5;
		var parent = $(this).parent();
		var nilai = $(this).val();
		var data={'id':nilai,'kel':kel};
		if (id=="l_dusun_no"){
			if($('#l_team_dusun_no').length) 
				var target_combo = $("#l_team_dusun_no");
		}else{
			if($('#q_l_team_dusun_no').length) 
				var target_combo = $("#q_l_team_dusun_no");
		}
		if (target_combo.length==0)
			return false;
		var url = "ajax/get-team-dusun";
		$("#l_team_dusun_no").val('');
		$("#select2-l_team_dusun_no-container").attr('title','').html('');
		cari_ajax_combo("post", parent, data, target_combo, url);
	})
	
	$("#l_jml_pria, #l_jml_wanita").change(function(){
		var pria=parseInt($("#l_jml_pria").val());
		var wanita=parseInt($("#l_jml_wanita").val());
		if(isNaN(pria))
			pria=0;
		if(isNaN(wanita))
			wanita=0;
		
		var dpt=0;
		if ($("#l_jml_pria").val().length || $("#l_jml_wanita").val().length){
			$("#l_jml_dpt").removeAttr("readonly").attr("readonly", "readonly");
			dpt = pria+wanita;
			$("#l_jml_dpt").val(dpt);
		}else{
			$("#l_jml_dpt").removeAttr("readonly");
		}
	})
	
	$("span.accordion.glyphicon").click(function(){
		var sts = $(this).data("sts");
		var accor = $(this).data("class");
		if (sts==1){
			$("."+accor).removeClass("hide");
			$(this).removeClass("glyphicon-download").addClass("glyphicon-upload");
			$(this).data("sts", 0);
		}else{
			$("."+accor).removeClass("hide").addClass("hide");
			$(this).removeClass("glyphicon-upload").addClass("glyphicon-download");
			$(this).data("sts", 1);
		}
	})
	$("#hp").change(function(){		
		var parent = $(this).parent();
		var nilai = $(this).val();
		var data={'id':nilai};
		var target_combo = $(this).find(".provider");
		var url = "ajax/get-provider";
		cari_ajax_combo("post", parent, data, target_combo, url);
	})
});