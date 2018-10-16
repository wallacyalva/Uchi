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
                    <h2><span class="fa fa-user"></span> Novo Cliente</h2>
                </div>
                <!-- END PAGE TITLE -->
                <?php 
                $msg = $this->session->flashdata('msg');
                if ($msg){
                ?>  
                    <div class="col-md-12">
                        <div class="<?php if($msg['tipo']==1){ echo "alert alert-success";}elseif($msg['tipo']==2){echo "alert alert-danger";}?>" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <?=$msg['texto']?>.
                        </div>
                    </div>
                <?php } ?>
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">      
                        <div class="col-md-12">
                            <form action="<?=base_url("cliente/edit_cliente");?>/<?=$this->uri->segment(3)?>" enctype="multipart/form-data" method="post" class="form-horizontal" role="form">       
                                <div class="panel panel-default panel-toggled">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Minhas Informações</strong></h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                        </ul>
                                    </div>
                                        
                                    <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Nome da Empresa <span class="required">*</span></label>
                                                    <div class="col-md-10">
                                                        <input type="text" name="name_company" id="name_company" class="form-control" value="<?=$cliente->name_company?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Email <span class="required">*</span></label>
                                                    <div class="col-md-10">
                                                        <input type="text" name="email" id="email" class="form-control" value="<?=$cliente->email?>">
                                                    </div>
                                                </div>
                                        
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Responsável <span class="required">*</span></label>
                                                    <div class="col-md-10">
                                                        <input type="text" name="responsible" id="responsible" class="form-control" value="<?=$cliente->responsible?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">CEP (Sem Traços) <span class="required">*</span></label>
                                                    <div class="col-md-2">
                                                        <input type="number" name="zip_code" id="zip_code" class="form-control" value="<?=$cliente->zip_code?>">
                                        
                                                    </div>
                                                </div>                                           
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Endereço <span class="required">*</span></label>
                                                    <div class="col-md-10">
                                                        <input type="text" name="address" id="address" class="form-control" value="<?=$cliente->address?>">
                                                    </div>
                                                </div>                                           
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Bairro <span class="required">*</span></label>
                                                    <div class="col-md-10">
                                                        <input type="text" name="district" id="district" class="form-control" value="<?=$cliente->district?>">
                                                    </div>
                                                </div>                                         
                                                                
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Cidade</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="city" id="city" class="form-control" value="<?=$cliente->city?>">
                                                    </div>
                                                </div>                                           
                                                                                            
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Estado <span class="required">*</span></label>
                                                    <div class="col-md-2">
                                                    <select name="state" class="select-general form-control">
                                                <option value="<?=$cliente->state?>" selected><?=$cliente->state?></option>            
                                                <option value="AC">AC</option>            
                                                <option value="AL">AL</option>            
                                                <option value="AM">AM</option>            
                                                <option value="AP">AP</option>            
                                                <option value="BA">BA</option>            
                                                <option value="CE">CE</option>            
                                                <option value="DF">DF</option>            
                                                <option value="ES">ES</option>            
                                                <option value="GO">GO</option>            
                                                <option value="MA">MA</option>            
                                                <option value="MG">MG</option>            
                                                <option value="MS">MS</option>            
                                                <option value="MT">MT</option>            
                                                <option value="PA">PA</option>            
                                                <option value="PB">PB</option>            
                                                <option value="PE">PE</option>            
                                                <option value="PI">PI</option>            
                                                <option value="PR">PR</option>            
                                                <option value="RJ">RJ</option>            
                                                <option value="RN">RN</option>            
                                                <option value="RO">RO</option>            
                                                <option value="RR">RR</option>            
                                                <option value="RS">RS</option>            
                                                <option value="SC">SC</option>            
                                                <option value="SE">SE</option>            
                                                <option value="SP">SP</option>            
                                                <option value="TO">TO</option>            
                                            </select>      
                                                    </div>
                                                </div>  
                                                
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Telefone <span class="required">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="number" name="phone" id="phone" class="form-control" value="<?=$cliente->phone?>">
                                                    </div>
                                                </div> 

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Telefone2 <span class="required">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="number" name="phone2" id="phone2" class="form-control" value="<?=$cliente->phone2?>">
                                                    </div>
                                                </div> 


                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Site <span class="required">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="site" id="site" class="form-control" value="<?=$cliente->site?>">
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Facebook</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="facebook" id="facebook" class="form-control" value="<?=$cliente->facebook?>">
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">twitter</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="twitter" id="twitter" class="form-control" value="<?=$cliente->twitter?>">
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">google</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="google" id="google" class="form-control" value="<?=$cliente->google?>">
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Descrição</span></label>
                                                    <div class="col-md-7">
                                                    <textarea cols="6" name="description" id="description" required="" rows="8" placeholder="" class="form-control"><?=$cliente->descricao?></textarea>
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
                                <div class="panel panel-default panel-toggled">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Mudar Imagem de Capa</strong></h3>
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


                     <div class="row">      
                        <div class="col-md-12">
                            <form action="<?=base_url("cliente/edit_cliente");?>/<?=$this->uri->segment(3)?>" method="post" class="form-horizontal" role="form">       
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



