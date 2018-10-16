        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- LEFT MENU -->
            <?php $this->load->view("template/left_menu_view", null) ?>
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                
            <?php $this->load->view("template/header_menu_view", null) ?>                       

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=base_url("banner/");?>">Banners</a></li>                    
                    <li class="active">Visualizar</li>
                </ul>
                <!-- END BREADCRUMB -->  

                <!-- PAGE TITLE -->                    
                <div class="page-title">                    
                    <h2><span class="fa fa-star"></span> Banners </h2>
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
                            foreach($banners as $banner){
                        ?> 
                        <!-- CONTACT ITEM -->     
                            <div class="col-md-4">
                                    
                                    <div class="panel panel-default">
                                        <a class="panel-body btn btn-default" href="banner/editar/<?=$banner->id?>">
                                            <div class="image">
                                               <img src="<?=base_url("uploads/images/banners")?>/<?=$banner->banner?>" class="img-thumbnail" alt="<?=$banner->municipio?>">
                                            </div>
                                            <div class="panel-body">
                                            <div class="contact-info">
                                                <p style="text-align:left;"><small>Estado: </small><?=$banner->uf?></p>
                                                <p style="text-align:left;"><small>Cidade: </small><?=$banner->municipio?></p>
                                            </div>
                                            </div>
                                        </a>                                
                            
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