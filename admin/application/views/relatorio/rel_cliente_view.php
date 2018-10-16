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
                    <h2><span class="fa fa-user"></span> Relatorio de Clientes</h2>
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
                            <form id="editFormCliente" action="<?=base_url("relatorio/clientes");?>/<?=$this->uri->segment(3)?>" enctype="multipart/form-data" method="post" class="form-horizontal" role="form">       
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Relatorio de Clientes</strong></h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                        </ul>
                                    </div>
                                        
                                    <div class="panel-body">
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Estado <span class="required">*</span></label>
                                    <div class="col-md-3">                   
                                        <select class="form-control select" data-style="btn-primary" style="display: none;" name="estado" id="estado">
                                        <option value="" select>Escolha o Estado</option>
                                         <?php
                                            foreach($estados as $uf){
                                         ?>
                                            <option value="<?=$uf->uf?>"><?=$uf->estado?></option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Cidade <span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <select class="form-control" data-style="btn-primary" style="display: none;" name="cidades" id="cidades" >
                                        <option value="" select>Escolha o Estado</option>
                                        </select>
                                        <span id="carregando" style="display: none;" >Aguarde, carregando...</span> 
                                    </div>
                                </div>
                                    
                                             
                                        </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-default">Limpar</button>                                    
                                        <button class="btn btn-primary pull-right">Listar</button>
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