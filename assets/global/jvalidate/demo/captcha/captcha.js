

$(function(){
	$("body").on("click", "#refreshimg", function(){
		$.post("newsession");
		$("#captchaimage").load("image_req");
		return false;
	});

	$("#submit_form").validate({
		rules: {

			captcha1: {
				required: true,
				remote: {
					url: "process",
					type: "get"
						}

			}
		},
		messages: {

			captcha1: {
				required: "Please enter a valid Captcha",
				remote: "Correct captcha is required. Click the captcha to generate a new one"

		},
		submitHandler: function() {
			alert("Correct captcha!");
		},
		success: function(label) {
			label.addClass("valid").text("Valid captcha!")
		},
		onkeyup: false



	});

});
