
<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Rede UCHI - Registrar Usuário</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->      
        <link rel="stylesheet" href="<?=css_url()?>font-awesome.min.css">  
        <link rel="stylesheet" type="text/css" id="theme" href="<?=css_url()?>login-theme.css"/>
        <!-- EOF CSS INCLUDE -->                                  
    </head>
    <body>
        <div class="registration-container" style="background-image: url(<?=base_url()?>assets/images/filhote.jpg); background-position: center; background-blend-mode: soft-light; background-repeat: space; background-size: cover;">  
            <div class="registration-box animated fadeInDown">
                <div class="registration-logo"></div>
        
                <ul class="nav nav-tabs">
                    <li class="active"style="left: -5px;"><a data-toggle="tab" href="#home">Cadastro Usuário</a></li>
                    <li><a data-toggle="tab" href="#menu1">Cadastro Empresa</a></li>
                </ul>

                <div class="tab-content">

                    <!-- CADASTRO USUARIO-->
                    <div id="home" class="tab-pane fade in active">
                        <div class="registration-body">

                            <div class="registration-title">
                                <strong>Cadastro do Usuário</strong>
                            </div>

                            <div class="registration-subtitle"></div>

                            <form id="cadFormUsuario" action="<?=base_url("login/registrar")?>" class="form-horizontal" method="post">
            
                                <h4>Informações Pessoais</h4>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="name" placeholder="Primeiro Nome"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="surname" placeholder="Sobrenome"/>
                                    </div>
                                </div>


                                

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="email" placeholder="E-mail"/>
                                    </div>
                                </div>
                                
                                <h4>Senha</h4>                    
                                
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Repita a Senha"/>
                                    </div>
                                </div>             
                                
                                <h4>Endereço</h4>                    
                                
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="postalcode" name="postalcode" placeholder="Cep"/>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="street" name="street" placeholder="Rua"/>
                                    </div>
                                </div>  

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="district" name="district" placeholder="Bairro"/>
                                    </div>
                                </div>   

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Cidade"/>
                                    </div>
                                </div>   

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="state" name="state" placeholder="Estado"/>
                                    </div>
                                </div>   

                                <div class="form-group push-up-30">
                                    <div class="col-md-6">
                                        <a href="https://uchi.wa-studio.com/login" class="btn btn-link btn-block">Já tem uma conta?</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger btn-block">Cadastrar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    
                    <!-- CADASTO EMPRESA -->
                    <div id="menu1" class="tab-pane fade">
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <div class="registration-body">

                                    <div class="registration-title">
                                        <strong>Cadastro da Empresa</strong>
                                    </div>

                                    <div class="registration-subtitle"></div>
                                    
                                    <form id="cadFormEmpresa" action="<?=base_url("login/registrarempresa")?>" class="form-horizontal" method="post">
                                        
                                        <h4>Informações da Empresa</h4>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="emp_nome" placeholder="Nome da Empresa"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label for="emp_ramo">Ramo:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="emp_ramo" id="emp_ramo">
                                                    <option value="Engenharia">Engenharia</option>
                                                    <option value="Comercio">Comercio</option>
                                                    <option value="Vendas">Vendas</option>
                                                    <option value="Metalurgica">Metalurgica</option>
                                                    <option value="Medicina">Medicina</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="emp_email" placeholder="E-mail"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="emp_cnpj" placeholder="CNPJ"/>
                                            </div>
                                        </div>
                                        
                                        <h4>Senha</h4>                    
                                    
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="password" class="form-control" id="emp_password" name="emp_password" placeholder="Senha"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="password" class="form-control" id="emp_confirm_password" name="emp_confirm_password" placeholder="Repita a Senha"/>
                                            </div>
                                        </div>             
                                    
                                        <h4>Endereço</h4>                    
                                    
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="emp_postalcode" name="emp_postalcode" placeholder="Cep"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="emp_street" name="emp_street" placeholder="Rua"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="emp_district" name="emp_district" placeholder="Bairro"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="emp_city" name="emp_city" placeholder="Cidade"/>
                                            </div>
                                        </div>  

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="emp_state" name="emp_state" placeholder="Estado"/>
                                            </div>
                                        </div>   

                                        <div class="form-group push-up-30">
                                            <div class="col-md-6">
                                                <a href="https://uchi.wa-studio.com/login" class="btn btn-link btn-block">Já tem uma conta?</a>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-danger btn-block">Cadastrar</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>                                                  
                        </div>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="registration-footer">
                    <div class="pull-left">
                        &copy; 2017 Uchi
                    </div>

                    <div class="pull-right">
                        <a href="#">Sobre</a> |
                        <a href="#">Privacidade</a> |
                        <a href="#">Contate-nos</a>
                    </div>
                </div>
            </div> 
        </div>

        <!-- START PLUGINS -->
        <script type="text/javascript" src="<?=js_url(); ?>plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?=js_url(); ?>plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?=js_url(); ?>plugins/bootstrap/bootstrap.min.js"></script>        
        <script type="text/javascript" src="<?=js_url(); ?>plugins/bootstrap/bootstrap.min.js"></script>
        <script type='text/javascript' src='<?=js_url(); ?>plugins/jquery-validation/dist/jquery.validate.js'></script>
        <script type='text/javascript' src='<?=js_url(); ?>plugins/jquery-validation/dist/localization/messages_pt_BR.min.js'></script>
        <script type='text/javascript' src='<?=js_url(); ?>plugins/jquery-validation/dist/additional-methods.min.js'></script>
         <!-- END PLUGINS -->

        <!-- VALIDATION JS -->
        <script type='text/javascript' src='<?=js_url(); ?>usuario.js'></script>
        <!-- Adicionando Javascript -->

    </body>
</html>






