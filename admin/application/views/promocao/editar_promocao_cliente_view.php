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
                    <h2><span class="fa fa-star"></span> Nova Promoção para o cliente (<?=$cliente->name_company?>) </h2>
                </div>
                <!-- END PAGE TITLE -->
                <?php 
                $msg = $this->session->flashdata('msg');
                if ($msg){
                ?>  
                    <div class="col-md-12">
                        <div class="<?php if($msg['tipo']==1){ echo "alert alert-success";}elseif($msg['tipo']==2){echo "alert alert-danger";}?>" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <?=$msg['texto']?>
                        </div>
                    </div>
                <?php } ?>
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">      
                        <div class="col-md-12">
                            <form id="addFormPromocao" action="<?=base_url("promocao/editarpromocaocliente/".$this->uri->segment(3)."/".$promocoes->id);?>"  enctype="multipart/form-data" method="post" class="form-horizontal" role="form">       
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Promoção</strong></h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                        </ul>
                                    </div>
                                        
                                    <div class="panel-body">

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Titulo da Promoção<span class="required">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="title_promotion" id="title_promotion" class="form-control" value="<?=$promocoes->titulo?>">
                                                    </div>
                                                </div>
                               
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Valor do Produto</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="price_product" id="price_product" placeholder="" value="<?=$promocoes->valor_produto?>" maxlength="7">
                                                         <span class="formError"></span>
                                                    </div>
                                                </div>   

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Desconto (%)</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="price_discount" id="price_discount" placeholder="" value="<?=$promocoes->desconto?>" maxlength="2">
                                                         <span class="formError"></span>
                                                    </div>
                                                </div> 

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Contagem regressiva</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="active_days" id="active_days" placeholder="" value="<?=$promocoes->dias_countdown?>" maxlength="3">
                                                         <span class="formError"></span>
                                                    </div>
                                                </div>                             

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Quantidade disponível</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="product_quantity" id="product_quantity" placeholder="" value="<?=$promocoes->qtdprodutos?>" maxlength="4">
                                                         <span class="formError"></span>
                                                    </div>
                                                </div>                             
                                                                              
                                                                
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Regras</span></label>
                                                    <div class="col-md-7">
                                                    <textarea cols="6" name="rule" id="rule" required="" rows="4" placeholder="" class="form-control"><?=$promocoes->regra?></textarea>
                                                    <span class="help-block contadorRule">500</span>
                                                    </div>                                                    
                                                </div>                                             

                                           
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Descrição</span></label>
                                                    <div class="col-md-7">
                                                    <textarea cols="6" name="description" id="description" required="" rows="4" placeholder="" class="form-control"><?=$promocoes->descricao?></textarea>
                                                    <span class="help-block contadorDescription">500</span>
                                                    </div>
                                                </div> 

                                                <div class="form-group">
                                                <label class="col-md-3 control-label">&nbsp;</label>
                                                    <div class="col-md-9">
                                                        <a class="file-input-wrapper btn btn-default  fileinput btn-primary">

                                                        <input type="file" value="" class="fileinput btn-primary" name="file_image_promocao" id="file_image_promocao" data-filename-placement="inside" title="Escolha a Imagem da Promoção."></a>
                                                    </div>
                                            </div>
                                             
                                        </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-default">Limpar</button>                                    
                                        <button id="criar" class="btn btn-primary pull-right">Alterar</button>
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