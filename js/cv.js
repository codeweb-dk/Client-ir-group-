$(function() {
	// Validate the contact form
  $('#cvform').validate({
  	// Specify what the errors should look like
  	// when they are dynamically added to the form
  	errorPlacement: function (error, element) {
            var name = $(element).attr("name");
            error.appendTo($("#" + name + "_validate"));
        },
  	
  	// Add requirements to each of the fields
  	rules: {
  		InputFornavn: {
  			required: true,
  			minlength: 2
  		},
  		InputPostnr: {
  			required: true
  		
  		},
  		InputEfternavn: {
  			required: true
  		
  		},
  		InputTelefon: {
  			required: true
  		
  		},
  		InputAdresse: {
  			required: true
  		
  		},
  		InputEmail: {
  			required: true
  		
  		}  		
  		
  	},
  	
  	// Specify what error messages to display
  	// when the user does something horrid
  	messages: {
  		InputFornavn: {
  			required: "Please enter your name.",
  			minlength: jQuery.format("At least {0} characters required.")
  		},
  		
  		InputPostnr: {
  			required: "Please enter your post nr"
  			
  		},
  		InputTelefon: {
  			required: "Please enter your telefon"
  			
  		},
  		InputEfternavn: {
  			required: "Please enter your efternavn"
  			
  		},
  		InputAdresse: {
  			required: "Please enter your adresse"
  			
  		},
  		InputEmail: {
  			required: "Please enter your email"
  			
  		}
  		
  		
  	},
  	
  	// Use Ajax to send everything to processForm.php
  	submitHandler: function(form) {
  		$("#send").attr("value", "Sending...");
  		$(form).ajaxSubmit({
  			success: function(responseText, statusText, xhr, $form) {
  				$(form).slideUp("fast");
  				$("#response").html(responseText).hide().slideDown("fast");
  			}
  		});
  		return false;
  	}
  });
});