$(document).ready(function(){
	$("#editDataMyUser").validate({
	  rules: {
		name: {
            required: true,
            alphas: true,
            maxlength: 60
        },
		username_email: {
            required: true,
            email: true,
        },
        phone: {
            required: true,
        },
        zip_code: {
            required: true,
            numbers: true,
            maxlength: 8
        },
        address: {
            required: true,
        },
        district: {
            required: true,
        },
        city: {
            required: true,
        },
        state: {
            required: true,
        },
	  },
	  errorElement: "em",
				  errorPlacement: function ( error, element ) {
					  // Add the `help-block` class to the error element
					  error.addClass( "help-block" );
  
					  // Add `has-feedback` class to the parent div.form-group
					  // in order to add icons to inputs
					  element.parents( ".col-sm-5" ).addClass( "has-feedback" );
  
					  if ( element.prop( "type" ) === "checkbox" ) {
						  error.insertAfter( element.parent( "label" ) );
					  } else {
						  error.insertAfter( element );
					  }
  
					  // Add the span element, if doesn't exists, and apply the icon classes to it.
					  if ( !element.next( "span" )[ 0 ] ) {
						  $( "<span class='glyphicon glyphicon-remove form-control-feedback'>&nbsp;</span>" ).insertAfter( element );
					  }
				  },
				  success: function ( label, element ) {
					  // Add the span element, if doesn't exists, and apply the icon classes to it.
					  if ( !$( element ).next( "span" )[ 0 ] ) {
						  $( "<span class='glyphicon glyphicon-ok form-control-feedback'>&nbsp;</span>" ).insertAfter( $( element ) );
					  }
				  },
				  highlight: function ( element, errorClass, validClass ) {
					  $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
					  $( element ).next( "div" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				  },
				  unhighlight: function ( element, errorClass, validClass ) {
					  $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
					  $( element ).next( "div" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				  }
  
	});
  
	jQuery.validator.addMethod("alphas", function(value, element) {
	  return this.optional(element) || /^[a-zA-Z\D]+$/.test( value );
	}, 'Somente Letras.');
	jQuery.validator.addMethod("numbers", function(value, element) {
	  return this.optional(element) || /^[0-9]+$/.test( value );
    }, 'Somente Números.');    
});

$(document).ready(function(){
	$("#editPasswordMyUser").validate({
	  rules: {
        new_password: {
            required: true,
            minlength: 5,
        },
        confirm_new_password: {
            required: true,
            minlength: 5,
            equalTo: "#new_password",
        },
	  },
	  errorElement: "em",
				  errorPlacement: function ( error, element ) {
					  // Add the `help-block` class to the error element
					  error.addClass( "help-block" );
  
					  // Add `has-feedback` class to the parent div.form-group
					  // in order to add icons to inputs
					  element.parents( ".col-sm-5" ).addClass( "has-feedback" );
  
					  if ( element.prop( "type" ) === "checkbox" ) {
						  error.insertAfter( element.parent( "label" ) );
					  } else {
						  error.insertAfter( element );
					  }
  
					  // Add the span element, if doesn't exists, and apply the icon classes to it.
					  if ( !element.next( "span" )[ 0 ] ) {
						  $( "<span class='glyphicon glyphicon-remove form-control-feedback'>&nbsp;</span>" ).insertAfter( element );
					  }
				  },
				  success: function ( label, element ) {
					  // Add the span element, if doesn't exists, and apply the icon classes to it.
					  if ( !$( element ).next( "span" )[ 0 ] ) {
						  $( "<span class='glyphicon glyphicon-ok form-control-feedback'>&nbsp;</span>" ).insertAfter( $( element ) );
					  }
				  },
				  highlight: function ( element, errorClass, validClass ) {
					  $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
					  $( element ).next( "div" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				  },
				  unhighlight: function ( element, errorClass, validClass ) {
					  $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
					  $( element ).next( "div" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				  }
  
	});
  
	jQuery.validator.addMethod("alphas", function(value, element) {
	  return this.optional(element) || /^[a-zA-Z\D]+$/.test( value );
	}, 'Somente Letras.');
	jQuery.validator.addMethod("numbers", function(value, element) {
	  return this.optional(element) || /^[0-9]+$/.test( value );
    }, 'Somente Números.');    
});