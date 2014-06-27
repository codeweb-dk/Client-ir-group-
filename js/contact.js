$(function() {
	// Validate the contact form
  $('#contactform').validate({
  	// Specify what the errors should look like
  	// when they are dynamically added to the form
  	errorPlacement: function (error, element) {
            var name = $(element).attr("name");
            error.appendTo($("#" + name + "_validate"));
        },
  	
  	// Add requirements to each of the fields
  	rules: {
  		InputName: {
  			required: true,
  			minlength: 2
  		},
  		InputEmail: {
  			required: true,
  			email: true
  		},
  		InputAdress: {
  			required: true
  			
  		},
  		InputPostNr: {
  			required: true
  		
  		},
  		InputMessage: {
  			required: true,
  			minlength: 10
  		},
  		InputReal: {
  			required: true
  			
  		}
  	},
  	
  	// Specify what error messages to display
  	// when the user does something horrid
  	messages: {
  		InputName: {
  			required: "Please enter your name.",
  			minlength: jQuery.format("At least {0} characters required.")
  		},
  		InputEmail: {
  			required: "Please enter your email.",
  			email: "Please enter a valid email."
  		},
  		InputMessage: {
  			required: "Please enter a message.",
  			minlength: jQuery.format("At least {0} characters required.")
  		},
  		InputAdress: {
  			required: "Please enter your adress."
  			
  		},
  		InputPostNr: {
  			required: "Please enter your post nr"
  			
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