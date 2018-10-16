        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- LEFT MENU -->
            <?php $this->load->view("template/left_menu_view", null) ?>
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                
            <?php $this->load->view("template/header_menu_view", null) ?>                       

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=base_url("plano/new");?>">Novo Plano</a></li>                    
                    <li class="active">Novo</li>
                </ul>
                <!-- END BREADCRUMB -->  

                <!-- PAGE TITLE -->                    
                <div class="page-title">                    
                    <h2><span class="fa fa-pencil-square-o"></span> Planos</h2>
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
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Cadastro de Plano</strong></h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                        </ul>
                                    </div>
                                        
                                    <div class="panel-body">
                                    <form id="addFormPlano" class="form-horizontal" method="post" action="<?=base_url("plano/new")?>">
                                                    
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Nome do Plano <span class="required">*</span></label>
                                                    <div class="col-md-4">
                                                    <input type="text" class="form-control" name="plano" id="plano" placeholder="" value="" maxlength="50">
                                                         <span class="formError"></span>
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Valor Mensal <span class="required">*</span></label>
                                                    <div class="col-md-2">
                                                    <input type="text" class="form-control" name="valor" id="valor" placeholder="" value="" maxlength="50">
                                                    <span class="help-block">Example: 999.99</span>                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Descrição <span class="required">*</span></label>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" name="descricao" id="descricao" placeholder="" value="" maxlength="150">
                                                         <span class="formError"></span>
                                                    </div>
                                                </div> 

                                        </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-default">Limpar</button>                                    
                                        <button class="btn btn-primary pull-right" id="criarCategoria" >Criar</button>
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



