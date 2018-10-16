        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- LEFT MENU -->
            <?php $this->load->view("template/left_menu_view", null) ?>
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                
            <?php $this->load->view("template/header_menu_view", null) ?>                       

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=base_url("cliente/my_cliente");?>">Minhas Paginas</a></li>                    
                    <li class="active">Nova Pagina</li></li>
                </ul>
                <!-- END BREADCRUMB -->  

                <!-- PAGE TITLE -->                    
                <div class="page-title">                    
                    <h2><span class="fa fa-user"></span>Nova Pagina</h2>
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
                            <form action="<?=base_url();?>pagina/new" method="post" class="form-horizontal" role="form">       
                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Minha Pagina</strong></h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                        </ul>
                                    </div>
                                        
                                    <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Titulo <span class="required">*</span></label>
                                                    <div class="col-md-10">
                                                        <input type="text" name="titulo" id="titulo" class="form-control" value="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">url <span class="required">*</span></label>
                                                    <div class="col-md-10">
                                                        <input type="text" name="url" id="url" class="form-control" value="">
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Descrição</span></label>
                                                    <div class="col-md-10">
                                                    
                                                    <textarea class="summernote" cols="10" name="conteudo" id="conteudo" rows="8" placeholder="" class="form-control"></textarea>
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

                     

                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        <!-- FOOTER -->



