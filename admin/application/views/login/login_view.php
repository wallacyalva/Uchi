<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>BACKOFFICE - Achei de Tudo</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- JAVASCRIPT JS  -->
<script type="text/javascript" src="<?php echo js_url(); ?>jquery-3.1.1.min.js"></script>        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo css_url(); ?>theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                      
    </head>
    <body>
        
        <div class="login-container login-v2">
            
            <div class="login-box animated fadeInDown">
                <div class="login-body">
                    <div class="login-title"><strong>Bem Vindo</strong>, Por Favor faça seu login.</div>
                    <form  method="post" id="formlogin" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-user"></span>
                                </div>
                                <input type="text" name="username_email" id="username_email" class="form-control" placeholder="email"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-lock"></span>
                                </div>                                
                                <input type="password" name="password" id="password" class="form-control" placeholder="senha"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="error" style="color: #B64645" id="logerror"></div> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-block btn-acessar hide" id="load" disabled="disabled"><i class='fa fa-spinner fa-spin '></i> Acessando...</button>
                            <button class="btn btn-primary btn-lg btn-block btn-acessar" id="acessar">Acessar</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2018 Achei de Tudo
                    </div>
                    <div class="pull-right">
                        <a href="https://www.acheidetudo.wa-studio.com">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
<script>  
$(document).on('submit', '#formlogin', function(event) {
	event.preventDefault();
	/* Act on the event */
	var userName = $('input[id=username_email]');
	var password = $('input[id=password]');
	var status = true;

	$.ajax({
		url: '<?=base_url(); ?>' + 'login/check_user',
		type: 'POST',
		dataType: 'json',
		data: {
			username_email: userName.val(),
			password: password.val()
        },
        beforeSend: function() {
            $('#acessar').addClass('hide');
            $('#load').removeClass('hide');
        },
		success: function(event){
			if(event.status == status){
                console.log(status);
                $('#acessar').addClass('hide');
                $('#load').removeClass('hide');
				window.location.href = '<?php echo base_url(); ?>' + 'usuario';
			}else{
                $('#load').addClass('hide');
                $('#acessar').removeClass('hide');
				$('.error').text('Invalid username or password!');
			}
		},
		error: function(event){
            $('.error').text('Ocorreu um erro, Por Favor tente novamente.');
		}
	});
});
</script>       
    </body>
</html>






