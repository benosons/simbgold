

jQuery(function(){
	jQuery('.rate-rs').rateit({ max: 5, step: 1, resetable :false});
	
	jQuery('#account_group').live('change',function(){
		if(jQuery(this).val() == 'add')
		{
			jQuery('.additional').fadeIn();
		}else{
			jQuery('.additional').fadeOut();
		}
	});
	
	jQuery('#group_type').live('change',function(){
		if(jQuery(this).val() == "parent")
		{
			jQuery('#rs_fk').val(jQuery('#account_group option:selected').text()).attr('readonly','readonly');
		}else{
			jQuery('#rs_fk').val('').removeAttr('readonly','readonly');
		}
	});
	
	jQuery('.generateCity').live('change',function(){
		loadCityByProvince(jQuery(this).val(), '#selectcity');
	});
	
	//jQuery('#selectProvince').html(loadProvince());
	loadProvince('selectProvince');
});

function loadAccountGroup(target){
	jQuery.post(base_url+'member/loadAccountGroup',function(data){
		var prop	= '';
		prop += '<option value=""> -- Pilih Kelompok -- </option>';
		jQuery.each(data, function(key, value){
			prop += '<option value="'+value.id+'"> '+value.name+' </option>';
		});
		prop += '<option value="add">+ Tambah Kelompok Baru</option>';
		jQuery(target).html(prop);
	},'json');
}

function loadfile(page,target){
	jQuery.post(base_url+'member/loadForm',{page:page},function(data){
		jQuery(target).html(data);
	});
}

function loadProvince(target){
	jQuery.post(base_url+'general/getProvince',function(data){
		var prop	= '';
		prop += '<option value=""> -- Pilih Propinsi -- </option>';
		jQuery.each(data, function(key, value){
			prop += '<option value="'+value.id+'"> '+value.name+' </option>';
		});
		jQuery('#'+target).html(prop);
	},'json');
}

function loadCategoriesUPK(target)
{
	jQuery.post(base_url+'general/UPKCategories',function(data){
		var prop	= '';
		prop += '<option value=""> -- Pilih Kategori UPK -- </option>';
		jQuery.each(data, function(key, value){
			prop += '<option value="'+value.id+'"> '+value.name+' </option>';
		});
		jQuery(target).html(prop);
	},'json');
}

function loadCityByProvince(province,target){
	jQuery.post(base_url+'member/getCity',{province:province},function(val){
		var city	= '';
		jQuery.each(val, function(key, value){
			city += '<option value="'+value.id+'"> '+value.name+' </option>';
		});
		jQuery(target).html(city);
	},'json');
}