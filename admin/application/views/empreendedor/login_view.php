<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Empreendedor - Achei de Tudo</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo css_url(); ?>/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                      
    </head>
    <body>
        
        <div class="login-container login-v2">
            
            <div class="login-box animated fadeInDown">
                <div class="login-body">
                    <div class="login-title"><strong>Bem Vindo</strong>, Por Favor faça seu login.</div>
                    <form action="<?=base_url(); ?>" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-user"></span>
                                </div>
                                <input type="text" class="form-control" placeholder="email"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-lock"></span>
                                </div>                                
                                <input type="password" class="form-control" placeholder="senha"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="">Recuperar senha?</a>
                        </div>          
                        <div class="col-md-6 text-right">
                            <a href="">Criar Conta</a>
                        </div>              
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-block">Acessar</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2017 Achei de Tudo
                    </div>
                    <div class="pull-right">
                        <a href="">Sobre</a> |
                        <a href="">Privacidade</a> |
                        <a href="">Contato</a>
                    </div>
                </div>
            </div>
            
        </div>
        
    </body>
</html>






