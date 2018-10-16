$(document).ready(function(){
	$("#addFormPromocao").validate({
	  rules: {
		title_promotion: {
            required: true,
						alphas: true,
						maxlength: 40
        },
        price_product: {
            required: true,
            number: true
          },
          price_discount: {
            required: true,
            numbers: true,
            maxlength: 2
          },
          active_days: {
            required: true,
            numbers: true,
            maxlength: 3
          },
          product_quantity: {
            required: true,
            numbers: true,
            maxlength: 4
          }
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
  
  $("#criar").prop('disabled', 'disabled');
  
	$("#addFormPromocao").on('keyup blur', function(){
	  if($("#addFormPromocao").valid()){
		$("#criar").prop('disabled', false);
	  }else{
		$("#criar").prop('disabled', 'disabled');
	  }
	});
  });
//   $(document).ready(function(){
//     $("#price_product").inputmask('decimal', {
//         'alias': 'numeric',
//         'groupSeparator': '.',
//         'autoGroup': true,
//         'digits': 2,
//         // 'radixPoint': ",",
//         'digitsOptional': true,
//         'allowMinus': false,
//         // 'prefix': 'R$ ',
//         'placeholder': ''
//     });
//   });
$(document).ready(function(){
    $("#rule").bind("input keyup paste", function (){
        var maximo = 500;
        var disponivel = maximo - $(this).val().length;
        if(disponivel < 0) {
            var texto = $(this).val().substr(0, maximo); 
            $(this).val(texto);
            disponivel = 0;
        }
        $(".contadorRule").text(disponivel);
    });
    $("#description").bind("input keyup paste", function (){
        var maximo = 500;
        var disponivel = maximo - $(this).val().length;
        if(disponivel < 0) {
            var texto = $(this).val().substr(0, maximo); 
            $(this).val(texto);
            disponivel = 0;
        }
        $(".contadorDescription").text(disponivel);
    });
});