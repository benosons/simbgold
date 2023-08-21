$(function(){
	$("body").on("click", "#refreshimg", function(){
		$.post("newsession");
		$("#captchaimage").load("image_req");
		return false;
	});

	$( "#fg_pembuatan" )
		.change(function() {
			var str = "";
			$( "#fg_pembuatan option:selected" ).each(function() {
				str += $( this ).val();
			});
			// alert(str);
			if (str == 1) {
					$( "#form_nib" ).show();
					$("#submit_form").validate();
					// $('#nib').rules('add',  { required: true });
					$('#nib').rules('add',  {
							required: true,
							remote : {
								url: "cek_nib",
								type: "post"
							},
						messages: {
								required: "Wajib diisi",
								remote: "NIB tidak terdaftar pada system kami"

						}
					});
					// $("#submit_form").validate({
					// 	rules: {
					// 			nib: {
					// 		required: true,
					// 		remote : {
					// 			url: "cek_nib",
					// 			type: "post"
					// 				}
					// 			}
					// 		},
					// 	messages: {
					// 			nib: {
					// 			required: "Wajib diisi",
					// 			remote: "Data Not Exist"
					// 		}
					// 	}
					// });
					// $('#nib').rules('add',  { required: true });
					// $('#submit_form').rules('add',  {
					//
					// 		nib: 'required';
					//
					// });
				 // $( "#nib" ).text( str );
			} else {
				$( "#form_nib" ).hide();
				$('#nib').rules('remove',  'required')
			}

		})
		// .trigger( "change" );

	$("#submit_form").validate({
		rules: {
			tipe_permohonan: "required",
			fungsi_pembuatan: "required",
			username1: {
				required: true,
				minlength: 6,
				regex : "^[a-zA-Z0-9-_.]+$",
				remote : {
					url: "cek_user_name",
					type: "post"
						}
			},

			password1: {
				required: true,
				minlength: 6,
				atLeastOneLetter: true,
				atLeastOneNumber: true

			},
			confirm_password: {
				required: true,
				minlength: 6,
				equalTo: "#password1"
			},
			email: {
				required: true,
				email: true
			},
			captcha1: {
				required: true,
				remote: {
					url: "process",
					type: "get"
						}

			}
		},
		messages: {
			tipe_permohonan: "Wajib diisi",
			fungsi_pembuatan: "Wajib diisi",
			username1: {
				required: "Wajib diisi",
				minlength: "Username yang digunakan minimal 6 karakter",
				regex: "Hanya menggunakan huruf, nomor, garis bawah, titik dan garis strip tengah",
				remote: "username sudah digunakan"
			},
			password1: {
				required: "Wajib diisi",
				minlength: "Password yang digunakan minimal 6 karakter",
				atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				atLeastOneNumber: "Password harus berupa gabungan huruf dan angka",
			},
			confirm_password: {
				required: "Wajib diisi",
				minlength: "password yang digunakan minimal 6 karakter",
				equalTo: "Harap memasukan password yang sama dengan diatas"
			},
			captcha1: {
				required: "Wajib diisi",
				remote: "Kode keamanan tidak sesuai. Klik gambar/Kode keamanan untuk membuat kode baru"
			},
			email: {
				required: "Wajib diisi",
				email: "Harap masukkan Format email dengan benar"
			}

		},

		// submitHandler: function() {
		// 	alert("Correct captcha!");
		// },
		// success: function(label) {
		// 	label.addClass("valid").text("Valid captcha!")
		// },
		// onkeyup: false
		onkeyup: true,
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );

			// Add `has-feedback` class to the parent div.form-group
			// in order to add icons to inputs
			element.parents( ".col-sm-8" ).addClass( "has-feedback" );

			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.parent( "label" ) );
			} else {
				error.insertAfter( element );
			}

			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if ( !element.next( "span" )[ 0 ] ) {
				$( "<span class='glyphicon glyphicon-remove form-control-feedback' style='display: flex;'></span>" ).insertAfter( element );
			}
		},
		success: function ( label, element ) {
			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if ( !$( element ).next( "span" )[ 0 ] ) {
				$( "<span class='glyphicon glyphicon-ok form-control-feedback' style='display: flex;'></span>" ).insertAfter( $( element ) );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-8" ).addClass( "has-error" ).removeClass( "has-success" );
			$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
		},
		unhighlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-8" ).addClass( "has-success" ).removeClass( "has-error" );
			$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
		}


	});

});
