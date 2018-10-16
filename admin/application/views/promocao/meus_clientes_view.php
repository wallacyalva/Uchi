        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- LEFT MENU -->
            <?php $this->load->view("template/left_menu_view", null) ?>
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                
            <?php $this->load->view("template/header_menu_view", null) ?>                       

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=base_url("cliente/new_cliente");?>">Novo Cliente</a></li>                    
                    <li class="active">Meus Clientes</li>
                </ul>
                <!-- END BREADCRUMB -->  

                <!-- PAGE TITLE -->                    
                <div class="page-title">                    
                    <h2><span class="fa fa-star"></span> Meus Clientes -> Promoções</h2>
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

                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table datatable table-striped table-condensed table-actions">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Responsavel</th>
                                                    <th>Telefone</th>
                                                    <th width="100">Plano</th>
                                                    <th width="120">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach($clientes as $cliente){
                                            ?>
                                                    <tr id="<?=$cliente->id_clientes?>">
                                                        <td><?=$cliente->name_company?></td>
                                                        <td><?=$cliente->responsible?></td>
                                                        <td><?=$cliente->phone?> / <?=$cliente->phone2?></td>
                                                        <td><?=$cliente->plano?></td>                                                    
                                                        <td>
                                                            <a href="<?=base_url("promocao/new/".$cliente->id_clientes) ?>"><button class="btn btn-warning btn-condensed"><i class="fa fa-star"></i></button></a>
                                                            <a href="<?=base_url("promocao/cliente/".$cliente->id_clientes) ?>"><button class="btn btn-primary btn-condensed"><i class="fa fa-eye"></i></button></a>
                                                        </td>                                                    
                                                    </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->
                        </div>
                    </div>
                     

                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        <!-- FOOTER -->



