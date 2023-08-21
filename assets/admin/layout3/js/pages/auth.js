$(function(){
	$("#download").click(function(){
		$("#view_download").removeClass('hide');
		$("#view_login").addClass('hide');
		$("#view_faq").addClass('hide');
	})
	$("#btn_faq").click(function(){
		$("#view_download").removeClass('hide').addClass('hide');
		$("#view_login").removeClass('hide').addClass('hide');
		$("#view_faq").removeClass('hide');
	})
	$(".back_login").click(function(){
		$("#view_login").removeClass('hide');
		$("#view_download").removeClass('hide').addClass('hide');
		$("#view_faq").removeClass('hide').addClass('hide');
	})
	$(".back_download").click(function(){
		$("#view_login").removeClass('hide').addClass('hide');
		$("#view_download").removeClass('hide');
		$("#view_faq").removeClass('hide').addClass('hide');
	})
	$(".back_login").click(function(){
		$("#view_login").removeClass('hide');
		$("#view_download").removeClass('hide').addClass('hide');
		$("#view_faq").removeClass('hide').addClass('hide');
	})
	
	$("#btn_search").click(function(){
		var id=$("#search").val();
		url = base_url + 'auth/faq';
		var data={id:id};
		
		$.ajax({
			type:"post",
			url:url,
			data:data,
			success:function(result){	
				$("#accordion").html(result)
			},
			error:function($msg){
				pesan_toastr('Error Load Database','err','Error','toast-top-center');
			},
			complate:function(){
				
			}
		})
	})
	$(".kelompok").click(function(){
		var id=$(this).data("id");
		$("#kel_"+id).fadeToggle(1000);
	})
});