<div class="page-container">
    <?php $this->load->view("template/left_menu_view", null); ?>
    <div class="page-content">    
        <?php $this->load->view("template/header_menu_view", null); ?>                                      
        <div class="page-title">                    
            <h2><span class="fa fa-user"></span> Editar Usuário</h2>
        </div>
        <?php $msg = $this->session->flashdata('msg'); if ($msg) { ?>  
            <div class="col-md-12">
                <div class="<?php if($msg['tipo']==1){ echo "alert alert-success";}elseif($msg['tipo']==2){echo "alert alert-danger";}?>" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <?=$msg['texto']?>.
                </div>
            </div>
        <?php } ?>
        <div class="page-content-wrap">
            <div class="row">      
                <div class="col-md-12">
                    <form id="editarUsuário" action="<?=base_url()?>usuario/editar/<?=$usuario->id?>?>" method="post" class="form-horizontal" role="form">       
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Usuário Nº: <?=$usuario->id?></strong></h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                            </div>      
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Nome:</label>
                                    <div class="col-md-10">
                                        <input type="text" name="name" id="name" class="form-control" value="<?=$usuario->name?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Sobrenome:</label>
                                    <div class="col-md-10">
                                        <input type="text" name="surname" id="surname" class="form-control" value="<?=$usuario->surname?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Email:</label>
                                    <div class="col-md-10">
                                        <input type="text" name="email" id="email" class="form-control" value="<?=$usuario->email?>">
                                    </div>
                                </div>
                                        
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Ramo:</label>
                                    <div class="col-md-10">                   
                                        <select class="form-control select" data-style="btn-primary" name="ramo" id="ramo">
                                            <?php foreach($ramos as $ramo) { ?>
                                                <?php if($ramo->nome == $usuario->ramo) { ?>
                                                    <option value="<?=$ramo->nome?>" selected><?=$ramo->nome?></option>
                                                <?php } else { ?>
                                                    <option value="<?=$ramo->nome?>"><?=$ramo->nome?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
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
                            <input type="hidden" name="id" id="id" value="<?=$usuario->id?>">
                            <div class="panel-footer">
                                <button class="btn btn-default">Limpar</button>                                    
                                <button class="btn btn-primary pull-right">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>            
</div>