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
                    <h2><span class="fa fa-star"></span> Promoções do cliente (<?=$cliente->name_company?>) </h2>
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
                        <?php
                            foreach($promocoes as $promocao){
                        ?> 
                        <!-- CONTACT ITEM -->     
                            <div class="col-md-4">
                                    
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="image">
                                                <img src="../../../uploads/images_promocao/<?=$promocao->capa?>" class="img-thumbnail" alt="Nadia Ali">
                                            </div>
                                            <div class="panel-body">
                                            <div class="contact-info">
                                                <p><small>Titulo:</small><?=$promocao->titulo?></p>
                                                <p><small>Valor do Produto:</small><?=$promocao->valor_produto?></p>
                                                <p><small>Quantidade de Produtos:</small><?=$promocao->qtdprodutos?></p>                                   
                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                            <a href="<?=base_url("promocao/editarpromocaocliente/".$this->uri->segment(3)."/".$promocao->id);?>"><button class="btn btn-primary btn-condensed"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-condensed"><i class="fa fa-pause"></i></button>
                                            </div>
                                        </div>                                
                            
                                    </div>
                            </div>
                        <!-- END CONTACT ITEM -->
                        <?php
                            }
                        ?>
                     </div>
                <!-- END PAGE CONTENT WRAPPER -->    
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        <!-- FOOTER -->