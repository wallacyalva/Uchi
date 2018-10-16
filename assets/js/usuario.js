$(document).ready(function(){
	$("#cadFormUsuario").validate({
	  rules: {
		name: {
            required: true,
            alphas: true,
            maxlength: 60
        },
		surname: {
            required: true,
        },
        ramo: {
            required: true,
        },
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 5,
        },
        confirm_password: {
            required: true,
            minlength: 5,
            equalTo: "#password",
        },  
        postalcode: {
            required: true,
            numbers: true,
            maxlength: 8
        },
        street: {
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
						  $( "<span class='fa fa-times form-control-feedback'>&nbsp;</span>" ).insertAfter( element );
					  }
				  },
				  success: function ( element ) {
					  // Add the span element, if doesn't exists, and apply the icon classes to it.
					  if ( !element.next( "span" )[ 0 ] ) {
						  $( "<span class='fa fa-check form-control-feedback'>&nbsp;</span>" ).insertAfter( element );
					  }
				  },
				  highlight: function ( element ) {
					  $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
					  $( element ).next( "span" ).addClass( "fa-times" ).removeClass( "fa-check" );
				  },
				  unhighlight: function ( element ) {
					  $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
					  $( element ).next( "span" ).addClass( "fa-check" ).removeClass( "fa-times" );
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
	$("#cadFormEmpresa").validate({
	  rules: {
		emp_nome: {
            required: true,
            alphas: true,
            maxlength: 60
        },
		emp_ramo: {
            required: true,
        },
        emp_email: {
            required: true,
            email: true,
        },
        emp_cnpj: {
            required: true,
        },
        emp_password: {
            required: true,
            minlength: 5,
        },
        emp_confirm_password: {
            required: true,
            minlength: 5,
            equalTo: "#emp_password",
        },  
        emp_postalcode: {
            required: true,
            numbers: true,
            maxlength: 8
        },
        emp_street: {
            required: true,
        },
        emp_district: {
            required: true,
        },
        emp_city: {
            required: true,
        },
        emp_state: {
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
						  $( "<span class='fa fa-times form-control-feedback'>&nbsp;</span>" ).insertAfter( element );
					  }
				  },
				  success: function ( element ) {
					  // Add the span element, if doesn't exists, and apply the icon classes to it.
					  if ( !element.next( "span" )[ 0 ] ) {
						  $( "<span class='fa fa-check form-control-feedback'>&nbsp;</span>" ).insertAfter( element );
					  }
				  },
                  highlight: function ( element ) {
                    $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
                    $( element ).next( "span" ).addClass( "fa-times" ).removeClass( "fa-check" );
                  },
                  unhighlight: function ( element ) {
                    $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
                    $( element ).next( "span" ).addClass( "fa-check" ).removeClass( "fa-times" );
                  }
  
	});
  
	jQuery.validator.addMethod("alphas", function(value, element) {
	  return this.optional(element) || /^[a-zA-Z\D]+$/.test( value );
	}, 'Somente Letras.');
	jQuery.validator.addMethod("numbers", function(value, element) {
	  return this.optional(element) || /^[0-9]+$/.test( value );
    }, 'Somente Números.');    
});




$(document).ready(function() {

    function limpa_formulário_cep2() {
        // Limpa valores do formulário de cep.
        $("#emp_street").val("");
        $("#emp_district").val("");
        $("#emp_city").val("");
        $("#emp_state").val("");
        $("#emp_ibge").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#emp_postalcode").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#emp_street").val("...");
                $("#emp_district").val("...");
                $("#emp_city").val("...");
                $("#emp_state").val("...");
                $("#emp_ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#emp_street").val(dados.logradouro);
                        $("#emp_district").val(dados.bairro);
                        $("#emp_city").val(dados.localidade);
                        $("#emp_state").val(dados.uf);
                        $("#emp_ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep2();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep2();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep2();
        }
    });
});

/* PAGE TABBED */
$(".page-tabs a").on("click",function(){
    $(".page-tabs a").removeClass("active");
    $(this).addClass("active");
    $(".page-tabs-item").removeClass("active");        
    $($(this).attr("href")).addClass("active");
    return false;
});
/* END PAGE TABBED */
    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#street").val("");
            $("#district").val("");
            $("#city").val("");
            $("#state").val("");
            $("#ibge").val("");
        }
        
        //Quando o campo cep perde o foco.
        $("#postalcode").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#street").val("...");
                    $("#district").val("...");
                    $("#city").val("...");
                    $("#state").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#street").val(dados.logradouro);
                            $("#district").val(dados.bairro);
                            $("#city").val(dados.localidade);
                            $("#state").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });