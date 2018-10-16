<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Rede UCHI - Login</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- JAVASCRIPT JS  -->
<script type="text/javascript" src="<?=js_url()?>jquery-3.1.1.min.js"></script>        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" href="<?=css_url()?>font-awesome.min.css">
        <link rel="stylesheet" type="text/css" id="theme" href="<?=css_url()?>login-theme.css"/>
        <!-- EOF CSS INCLUDE -->                                      
    </head>
    <body>
 
        <div class="login-container" style="background-image: url(<?=base_url()?>assets/images/filhote.jpg); background-position: center; background-blend-mode: soft-light;">
            
            <div class="login-box animated fadeInDown">
                 <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Bem Vindo</strong>, Por Favor faça seu login.</div>
                    <form  method="post" id="formlogin" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-user"></span>
                                </div>
                                <input type="text" name="email" id="email" class="form-control" placeholder="email"/>
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
                    <div class="form-group login-footer">
                        <div class="col-md-6">
                            <a href="">Recuperar senha?</a>
                        </div>          
                        <div class="col-md-6 text-right">
                            <a href="<?=base_url("login/registrar")?>">Criar Conta</a>
                        </div>              
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-block btn-acessar hide" id="load" disabled="disabled"><i class='fa fa-spinner fa-spin '></i> Acessando...</button>
                            <button class="btn btn-primary btn-lg btn-block btn-acessar" id="acessar">Acessar</button>
                            <input type="submit" style="position: absolute; left: -9999px">
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                    <strong>  &copy; 2017 Uchi</strong>
                    </div>
                    <div class="pull-right">
                    <strong>
                        <a href="" class="cavalos">Sobre</a> |
                        <a href="" class="cavalos">Privacidade</a> |
                        <a href="" class="cavalos">Contato</a>
                        </strong>
                    </div>
                </div>
            </div>
        </div>
<script>  
$(document).on('submit', '#formlogin', function(event) {
	event.preventDefault();
	/* Act on the event */
	var userName = $('input[id=email]');
	var password = $('input[id=password]');
	var status = true;

	$.ajax({
		url: '<?=base_url('login/check_user')?>',
		type: 'POST',
		dataType: 'json',
		data: {
			email: userName.val(),
			password: password.val()
        },
        beforeSend: function() {
            $('#acessar').addClass('hide');
            $('#load').removeClass('hide');
        },
		success: function(event){
			if(event.status == status){
                $('#acessar').addClass('hide');
                $('#load').removeClass('hide');
                if(event.is_user){
				    window.location.href = '<?=base_url('usuario')?>';
                } else {
                    window.location.href = '<?=base_url('empresa')?>';
                }
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
