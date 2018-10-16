        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- LEFT MENU -->
            <?php $this->load->view("template/left_menu_view", null) ?>
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                
            <?php $this->load->view("template/header_menu_view", null) ?>                       

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=base_url("banner/new");?>">Banner</a></li>                    
                    <li class="active">Novo</li>
                </ul>
                <!-- END BREADCRUMB -->  

                <!-- PAGE TITLE -->                    
                <div class="page-title">                    
                    <h2><span class="fa fa-user"></span> Novo Banner</h2>
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
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Cadastro de Banner Pagina Inicial</strong></h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                        </ul>
                                    </div>
                                        
                                    <div class="panel-body">
                                    <form class="form-horizontal" id="cp_crop_banner" method="post" action="<?=base_url("banner/cropBannerPhoto")?>">
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
                                              
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Site <span class="required">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="site" id="site" class="form-control" value="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Banner <span class="required">*</span></label>
                                                    <div class="col-md-7">
                                                            
                                                                <div class="modal-body">
                                                                    <div class="text-center" id="cp_target_banner">
                                                                        Use form below to upload file. Only .jpg files.
                                                                    </div>
                                                                        <input type="hidden" name="cp_img_banner_path" id="cp_img_banner_path"/>
                                                                        <input type="hidden" name="icb_x" id="icb_x"/>
                                                                        <input type="hidden" name="icb_y" id="icb_y"/>
                                                                        <input type="hidden" name="icb_w" id="icb_w"/>
                                                                        <input type="hidden" name="icb_h" id="icb_h"/>                        
                                                                </div>                    
                                                            </form>
                                                             
                                                            <form id="cp_upload_banner" method="post" enctype="multipart/form-data" action="<?=base_url("banner/uploadPhoto")?>">
                                                                <div class="modal-body form-horizontal form-group-separated">
                                                                    <div class="form-group">
                                                                        <label class="col-md-4 control-label">Nova Foto</label>
                                                                        <div class="col-md-4">
                                                                            <input type="file" class="fileinput btn-info" name="file" id="cp_photo_banner" data-filename-placement="inside" title="Escolher"/>
                                                                        </div>                            
                                                                    </div>                        
                                                                </div>
                                                            </form>
                                                    </div>
                                                </div>
                                                
                                                
                                        </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-default">Limpar</button>                                    
                                        <button class="btn btn-primary pull-right disabled" id="cp_banner_accept" >Criar Banner</button>
                                    </div>
                                </div>
                            
                        </div>
                     </div>

                     

                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        <!-- FOOTER -->



