function RegistrationFormValidation(serverSideData) {

	var errors = {};
	var _this = this;

	var pattern = '^[' + serverSideData.latvian_alphabet + ' ]+$';
	var regexp = new RegExp(pattern, 'gi');
	var regexp2 = new RegExp('^[' + serverSideData.latvian_alphabet + ' ]+$', 'gi');

	this.bindEvents = function() {
		$('form').submit(function(e) {
			_this.validate();
			if(hasErrors()) {
				e.preventDefault();
				showErrors();
			}
		});
	}

	this.validate = function() {
		resetErrors();
		var name = $('#name').val();
		var surname = $('#surname').val();
		var email = $('#email').val();
		var password = $('#password').val();
		var password_confirmation = $('#password_confirmation').val();
		var messages = serverSideData.messages;

		if(name.length < 1) {
			errors.name_required = messages["name_required"];
		}
		if(name.length > 30) {
			errors.name_max = messages["name_max"];	
		}
		
		if (!regexp.test(name)) {
			errors.name_regex = messages['name_regex'];
		}
		resetRegexp();

		if(surname.length < 1) {
			errors.surname_required = messages["surname_required"];
		}
		if(surname.length > 50) {
			errors.surname_max = messages["surname_max"];
		}
		if (!regexp.test(surname)) {
			errors.surname_regex = messages['surname_regex'];
		}
		resetRegexp();
		

		if(email.length < 1) {
			errors.email_required = messages["email_required"];
		}
		if(!validateEmail(email)) {
			errors.email_email = messages["email_email"];
		}
		if(email.length > 255) {
			errors.email_max = messages["email_max"];
		}
		if(!emailUnique(email)) {
			errors.email_unique = serverSideData.messages["email_unique"];
		}

		if(password.length < 1) {
			errors.password_required = messages["password_required"];
		}
		if(password.length < 8) {
			errors.password_min = messages["password_min"];
		}
		if(password.length > 255) {
			errors.password_max = messages["password_max"];
		}
		if(password != password_confirmation) {
			errors.password_confirmed = messages["password_confirmed"];
		}
		
		return false;
	}

	function emailUnique(email) {
		var result = false;
		$.ajax( {
			url: serverSideData.email_check_link,
			dataType: 'json',
			async: false,
			data: { email: email } 
		}).done(function( json ) {
				console.log(json)
		    	if(json.user && json.user != null) {
		    		result = false;
		    	} else {
		    		result = true;
		    	}
		  	})
		  	.fail(function( jqxhr, textStatus, error ) {
				result = false;
			});
		return result;
	}

	function resetErrors() {
		errors = {};
		hideErrors();
	}

	function hideErrors() {
		$('.error').removeClass('error');
		$('.errors').remove();
	}

	function resetRegexp() {
		regexp.lastIndex = 0;
	}

	function hasErrors() {
		return !$.isEmptyObject(errors);
	}

	function showErrors() {
		if(hasErrors()) {
			$('form').prepend('<div class="errors">Kļūdas: <ul></ul></div>');
		}
		for(var i in errors) {
			var errorField = getFieldNameFromIndex(i);
			$("#"+errorField).addClass("error");
			if(errorField == "password") {
				$('#password_confirmation').addClass('error');
			}
			$('.errors ul').append('<li>' + errors[i] + '</li>');
		}
	}

	function getFieldNameFromIndex(i) {
		var indexParts = i.split("_");
		return indexParts[0];
	}

	function validateEmail(email) {
	    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(email);
	}

}

var SharedEvents = function() {
	$('.reset-form').click(function(e) {
		e.preventDefault();
		$('input[type="text"]').val('');
		$('input[type="password"]').val('');
	});
}

var serverSideData = $('#json-container').data('json');
if(serverSideData.client_side_validation && serverSideData.client_side_validation == true) {
	var registrationFormValidation = new RegistrationFormValidation(serverSideData);
	registrationFormValidation.bindEvents();
}

var sharedEvents = new SharedEvents();