        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- LEFT MENU -->
            <?php $this->load->view("template/left_menu_view", null) ?>
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                
            <?php $this->load->view("template/header_menu_view", null) ?>                       

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=base_url("categoria/new");?>">Categoria</a></li>                    
                    <li class="active">Novo</li>
                </ul>
                <!-- END BREADCRUMB -->  

                <!-- PAGE TITLE -->                    
                <div class="page-title">                    
                    <h2><span class="fa fa-user"></span> Categorias</h2>
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
                                        <h3 class="panel-title"><strong>Cadastro de Categorias e Sub-Categorias</strong></h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                        </ul>
                                    </div>
                                        
                                    <div class="panel-body">
                                    <form class="form-horizontal" id="cadFormCategoria" method="post" action="<?=base_url("categoria/editar_categoria/".$this->uri->segment(3)."")?>">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">É uma Categora Pai? <span class="required">*</span></label>
                                                    <div class="col-md-3 form-material">                   
                                                    <div class="checkbox-material">
                                                        <input type="checkbox" name="anId1" id="anId1" <?php if(!$onecategoria->pai){ echo "checked";}?>>
                                                        <label for="anId1">
                                                        Sim</label>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="categoriaid">
                                                    <label class="col-md-3 control-label">Categoria Principal <span class="required">*</span></label>
                                                    <div class="col-md-3">                   
                                                        <select class="form-control"  name="categoriaPrincipal" id="categoriaPrincipal">
                            
                                    
                                                        <option value="0" <?php if(!$onecategoria->pai){ echo "selected";}else{} ?>>Está é a Categoria Principal</option>
                                                         <?php
                                                            foreach($categorias as $categoria){
                                                         ?>
                                                            <option value="<?=$categoria->id?>" <?php if($onecategoria->pai==$categoria->id){ echo "selected";}else{} ?>><?=$categoria->descricao?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Nome categoria <span class="required">*</span></label>
                                                    <div class="col-md-4">
                                                    <input type="text" class="form-control" name="categoria" id="categoria" placeholder="" value="<?=$onecategoria->descricao?>" maxlength="40">
                                                         <span class="formError"></span>
                                                    </div>
                                                </div>

                                                     <div class="form-group">
                                                    <label class="col-md-3 control-label">É uma Categora de? <span class="required">*</span></label>
                                                        <div class="col-md-6 form-material"> 

                                                        <label class="radio-material">
                                                            <input id="radio1" type="radio" name="tipo" value="1" <?php if($onecategoria->tipo==1) {echo "checked";}?>>
                                                            <span class="outer"><span class="inner"></span></span> Anuncios
                                                        </label>                                            
                                                        <label class="radio-material">
                                                            <input id="radio2" type="radio" name="tipo" value="2" <?php if($onecategoria->tipo==2) {echo "checked";}?>>
                                                            <span class="outer"><span class="inner"></span></span> Classificados
                                                        </label>
                                                        <label class="radio-material">
                                                            <input id="radio3" type="radio" name="tipo" value="3" <?php if($onecategoria->tipo==3) {echo "checked";}?>>
                                                            <span class="outer"><span class="inner"></span></span> Promoções
                                                        </label>
                                                        </div>
                                                  </div> 
                                                                                   
                                        </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-default">Limpar</button>                                    
                                        <button class="btn btn-primary pull-right" id="criarCategoria" >Atualizar</button>
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



