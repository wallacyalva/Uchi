        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- LEFT MENU -->
            <?php $this->load->view("template/left_menu_view", null) ?>
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                
            <?php $this->load->view("template/header_menu_view", null) ?>                       

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=base_url();?>usuario">Usuário</a></li>                    
                    <li class="active">Profile</li>
                </ul>
                <!-- END BREADCRUMB -->  

                <!-- PAGE TITLE -->                    
                <div class="page-title">                    
                    <h2><span class="fa fa-user"></span> Meus Dados</h2>
                </div>
                <!-- END PAGE TITLE -->
                <?php 
                $msg = $this->session->flashdata('msg');
                if ($msg){
                ?>
                    
                <div class="row">      
                    <div class="col-md-12">
                        <div class="<?php if($msg['tipo']==1){ echo "alert alert-success";}elseif($msg['tipo']==2){echo "alert alert-danger";}?>" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <?=$msg['texto']?>.
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">      
                        <div class="col-md-12">
                            <form action="<?=base_url();?>usuario/profile" method="post" class="form-horizontal" role="form">       
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Minhas Informações</strong></h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                        </ul>
                                    </div>
                                        
                                    <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Nome</label>
                                                    <div class="col-md-10">
                                                        <input type="text" name="name" id="name" class="form-control" value="<?=$user->name?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">E-mail</label>
                                                    <div class="col-md-10">
                                                        <input type="email" name="username_email" id="username_email" class="form-control" value="<?=$user->email?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Telefone</label>
                                                    <div class="col-md-2">
                                                        <input type="number" name="phone" id="phone" class="form-control" value="<?=$user->phone?>">
                                        
                                                    </div>
                                                </div>                                           
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">CEP</label>
                                                    <div class="col-md-2">
                                                        <input type="number" name="zip_code" id="zip_code" class="form-control" value="<?=$user->zip_code?>">
                                                    </div>
                                                </div>                                           
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Endereço</label>
                                                    <div class="col-md-10">
                                                        <input type="text" name="address" id="address" class="form-control" value="<?=$user->address?>">
                                                    </div>
                                                </div>                                                                                  
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Bairro</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="district" id="district" class="form-control" value="<?=$user->district?>">
                                                    </div>
                                                </div>                                           
                                                                
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Cidade</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="city" id="city" class="form-control" value="<?=$user->city?>">
                                                    </div>
                                                </div>                                           
                                                                                            
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Estado</label>
                                                    <div class="col-md-2">
                                                        <input type="text" name="state" id="state" class="form-control" value="<?=$user->state?>">
                                                    </div>
                                                </div>                                           
                                        </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-default">Limpar</button>                                    
                                        <button class="btn btn-primary pull-right">Salvar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                     </div>

                     <div class="row">      
                        <div class="col-md-12">
                            <form action="<?=base_url();?>usuario/change_password" method="post" class="form-horizontal" role="form">       
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Alterar Senha</strong></h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Nova Senha</label>
                                                    <div class="col-md-10">
                                                        <input type="password" name="new_password" id="new_password" class="form-control">
                                                    </div>
                                                </div>                                  
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Confirmar Senha</label>
                                                    <div class="col-md-10">
                                                        <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control">
                                                    </div>
                                                </div>                                  
                                        </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-default">Limpar</button>                                    
                                        <button class="btn btn-primary pull-right">Alterar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                     </div>

                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        <!-- FOOTER -->



