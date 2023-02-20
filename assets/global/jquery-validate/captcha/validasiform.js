$(function () {
	
	$("#from_biodata").validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
 
        rules: {
			roleplayer: {
                        required: true
                    },
			anda: {
				//password:true,
				required: true,
				minlength: 6,
				maxlength: 20,
				regex: "^[a-zA-Z0-9]+$",
				atLeastOneLetter: true,
				atLeastOneNumber: true

			},
			siapa: {
				required: true,
				email: true,
				
			},
			
		},
		messages: {
			roleplayer: {
				required: "Silahkan Pilih Salah Satu",
			},
			anda: {
				required: "Wajib diisi",
				minlength: "Password yang digunakan minimal 6 karakter",
				maxlength: "Password yang digunakan maksimal 20 karakter",
				atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				atLeastOneNumber: "Password harus berupa gabungan huruf dan angka",
				regex: "Hanya menggunakan huruf dan angka",
			},
			siapa: {
				required: "Wajib diisi",
				email: "Harap masukkan Format email dengan benar"
			},


		},

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        //.closest('.form-group').addClass('has-error'); // set error class to the control group
						.closest('.form-group').removeClass('has-success').addClass('has-error');
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        //.closest('.form-group').removeClass('has-error'); // set error class to the control group
						.closest('.form-group').removeClass('has-error').addClass('has-success');
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

        
    });
});

$(function () {
	

	$("#from_data_password").validate({
		rules: {
			reset_pass: {
				required: true,
				email:true,
			}
			
		},
		highlight: function (element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function (element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		errorClass: 'help-block',

		messages: {
			reset_pass:
			{
				required: "Harap Masukan Email Anda !",
				email: "Harap Masukkan Format Email Dengan Benar !",
			}
		},
		//submitHandler: function(form) {
		//form.submit();
		//},

	});

});

$(function () {
	

	$("#frmLogin").validate({
		rules: {
			
			saya: {
				required: true,
				//email: true,
				regex: "^[a-zA-Z0-9-_.@]+$",
			},
			bukan: {
				//password: true,
				regex: "^[a-zA-Z0-9]+$",
				required: true,
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				//atLeastOneNumber: "Password harus berupa gabungan huruf dan angka",
				minlength: 6
			}
		},
		highlight: function (element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function (element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		errorClass: 'help-block',

		messages: {
			//usernamenya: "Harap Masukan Username Anda !",
			bukan: {
				required: "Wajib diisi",
				minlength: "Password yang digunakan minimal 6 karakter",
				//atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				//atLeastOneNumber: "Password harus berupa gabungan huruf dan angka",
				regex: "Hanya menggunakan huruf dan angka",
			},
			
			saya: {
				required: "Harap Masukan Email / Username Anda !",
				//email: "Harap masukkan Format email dengan benar",
				//remote: "Email sudah digunakan",
				regex: "Harap masukkan Format username / email dengan benar",
			},

		},
		//submitHandler: function(form) {
		//form.submit();
		//},

		//submitHandler: function () {
			//form.submit();
		//},

	});

});


$(function () {

	$("#ubahpassword").validate({
		rules: {
			new_password: {
				required: true,
				minlength: 6,
				atLeastOneLetter: true,
				atLeastOneNumber: true
			},
			confirm_atas: {
				required: true,
				minlength: 6,
				equalTo: "#new_password"
			}
		},

		messages: {
			new_password: {
				required: "Wajib diisi",
				minlength: "Password yang digunakan minimal 6 karakter",
				atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				atLeastOneNumber: "Password harus berupa gabungan huruf dan angka",
			},
			confirm_atas: {
				required: "Wajib diisi",
				minlength: "password yang digunakan minimal 6 karakter",
				equalTo: "Harap memasukan password yang sama dengan diatas"
			}

		},

		errorElement: "em",
		errorPlacement: function (error, element) {
			element.parents(".col-sm-8").addClass("has-feedback");

			if (element.prop("type") === "checkbox") {
				error.insertAfter(element.parent("label"));
			} else {
				error.insertAfter(element);
			}
			if (!element.next("i")[0]) {
				$("<i class='glyphicon glyphicon-remove form-control-feedback' style='display: flex;'></i>").insertAfter(element);
			}
		},
		success: function (label, element) {
			// Add the i element, if doesn't exists, and apply the icon classes to it.
			if (!$(element).next("i")[0]) {
				$("<i class='glyphicon glyphicon-ok form-control-feedback' style='display: flex;'></i>").insertAfter($(element));

			}
		},
		highlight: function (element, errorClass, validClass) {
			$(element).next("i").addClass("glyphicon-remove").removeClass("glyphicon-ok");
			$(element).parents(".col-sm-8").addClass("has-error").removeClass("has-success");

		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).next("i").addClass("glyphicon-ok").removeClass("glyphicon-remove");
			$(element).parents(".col-sm-8").addClass("has-success").removeClass("has-error");

		},

		submitHandler: function () {
			form.submit();
		},


	});

});

$(function () {

	$("#formakundinas").validate({
		rules: {
			usernamedinas: {
				required: true,
				minlength: 5,
				regex: "^[a-zA-Z0-9-_.]+$",
				remote: {
					url: base_url + "front/cek_user_namedinas",
					type: "post"
				}
			},
			passworddinas: {
				required: true,
				minlength: 6,
				atLeastOneLetter: true,
				atLeastOneNumber: true
			},
			confirm_dinas: {
				required: true,
				minlength: 6,
				equalTo: "#passworddinas"
			}
		},

		messages: {
			usernamedinas: {
				required: "Wajib diisi",
				minlength: "Username yang digunakan minimal 6 karakter",
				regex: "Hanya menggunakan huruf, nomor, garis bawah, titik dan garis strip tengah",
				remote: "username sudah digunakan"
			},
			passworddinas: {
				required: "Wajib diisi",
				minlength: "Password yang digunakan minimal 6 karakter",
				atLeastOneLetter: "Password harus berupa gabungan huruf dan angka",
				atLeastOneNumber: "Password harus berupa gabungan huruf dan angka",
			},
			confirm_dinas: {
				required: "Wajib diisi",
				minlength: "password yang digunakan minimal 6 karakter",
				equalTo: "Harap memasukan password yang sama dengan diatas"
			}

		},

		errorElement: "em",
		errorPlacement: function (error, element) {
			element.parents(".col-sm-8").addClass("has-feedback");

			if (element.prop("type") === "checkbox") {
				error.insertAfter(element.parent("label"));
			} else {
				error.insertAfter(element);
			}
			if (!element.next("i")[0]) {
				$("<i class='glyphicon glyphicon-remove form-control-feedback' style='display: flex;'></i>").insertAfter(element);
			}
		},
		success: function (label, element) {
			// Add the i element, if doesn't exists, and apply the icon classes to it.
			if (!$(element).next("i")[0]) {
				$("<i class='glyphicon glyphicon-ok form-control-feedback' style='display: flex;'></i>").insertAfter($(element));

			}
		},
		highlight: function (element, errorClass, validClass) {
			$(element).next("i").addClass("glyphicon-remove").removeClass("glyphicon-ok");
			$(element).parents(".col-sm-8").addClass("has-error").removeClass("has-success");

		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).next("i").addClass("glyphicon-ok").removeClass("glyphicon-remove");
			$(element).parents(".col-sm-8").addClass("has-success").removeClass("has-error");

		},

		submitHandler: function () {
			form.submit();
		},


	});

});

// $.validator.setDefaults( {
// 	submitHandler: function () {
// 		alert( "submitted!" );
// 	}
// } );

/**
 * Custom validator for contains at least one lower-case letter
 */
$.validator.addMethod("atLeastOneLowercaseLetter", function (value, element) {
	return this.optional(element) || /[a-z]+/.test(value);
}, "Must have at least one lowercase letter");

/**
 * Custom validator for contains at least one upper-case letter.
 */
$.validator.addMethod("atLeastOneUppercaseLetter", function (value, element) {
	return this.optional(element) || /[A-Z]+/.test(value);
}, "Must have at least one uppercase letter");

$.validator.addMethod("atLeastOneLetter", function (value, element) {
	return this.optional(element) || /[a-zA-Z]+/.test(value);
}, "Must have at least one letter");

/**
 * Custom validator for contains at least one number.
 */
$.validator.addMethod("atLeastOneNumber", function (value, element) {
	return this.optional(element) || /[0-9]+/.test(value);
}, "Must have at least one number");

/**
 * Custom validator for contains at least one symbol.
 */
$.validator.addMethod("atLeastOneSymbol", function (value, element) {
	return this.optional(element) || /[!@#$%^&*()]+/.test(value);
}, "Must have at least one symbol");



$.validator.addMethod(
	"regex",
	function (value, element, regexp) {
		var re = new RegExp(regexp);
		return this.optional(element) || re.test(value);
	},
	"Please check your input."
);

function reloadata() {
	location.reload();
}

function batal() {
	location.reload();
}

jQuery(document).ready(function () {
	// initiate layout and plugins
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Demo.init(); // init demo features
	Index.init(); // init index page
	Portfolio.init();
	UIExtendedModals.init();
	UIBlockUI.init();
});

