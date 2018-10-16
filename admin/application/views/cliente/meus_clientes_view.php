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
                    <li class="active" >Meus Clientes</li>                    
                </ul>
                <!-- END BREADCRUMB -->  

                <!-- PAGE TITLE -->                    
                <div class="page-title">                    
                    <h2><span class="fa fa-users"></span> Meus Clientes</h2>
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
                                                    <th width="220">Ações</th>
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
                                                            <a href="<?=base_url("cliente/edit_cliente/".$cliente->id_clientes) ?>"><button class="btn btn-success btn-condensed"><i class="fa fa-pencil"></i></button></a>
                                                            <!-- <a href="//base_url("cliente/gerarContrato/".$cliente->id_clientes)"><button class="btn btn-warning btn-condensed"><i class="fa fa-file-pdf-o"></i></button></a> -->
                                                            <button class="btn btn-primary btn-condensed"><i class="fa fa-arrow-up"></i></button>
                                                            <button class="btn btn-info btn-condensed" onclick="notyConfirmBlock<?=$cliente->id_clientes?>();"><i id="block<?=$cliente->id_clientes?>" class="fa <?php if($cliente->ativo==1){ echo "fa-check-square";} else { echo "fa-square-o";}?>"></i></button>
                                                            <button class="btn btn-danger  btn-condensed" onclick="notyConfirm<?=$cliente->id_clientes?>();"><i class="fa fa-times"></i></button>
            <script type="text/javascript">                                            
                function notyConfirm<?=$cliente->id_clientes?>(){
                    noty({
                        text: 'Realmente deseja excluir este registro?',
                        layout: 'topRight',
                        buttons: [
                                {addClass: 'btn btn-success btn-clean', text: 'Ok', onClick: function($noty) {
                                    $.ajax({
                                        url: '<?=base_url("cliente/my_cliente") ?>',
                                        type: 'post',
                                        data: {cliente_to_remove: <?=$cliente->id_clientes?>},
                                        success: function() {
                                            $('#<?=$cliente->id_clientes?>').addClass('hide');
                                        }
                                    });
                                    $noty.close();
                                    noty({text: 'Registro Apagado!', layout: 'topRight', type: 'success'});
                                }
                                },
                                {addClass: 'btn btn-danger btn-clean', text: 'Cancel', onClick: function($noty) {
                                    $noty.close();
                                    }
                                }
                            ]
                    })                                                    
                }
                function notyConfirmBlock<?=$cliente->id_clientes?>(){
                    noty({
                        text: 'Realmente deseja desativar este cliente?',
                        layout: 'topRight',
                        buttons: [
                                {addClass: 'btn btn-success btn-clean', text: 'Ok', onClick: function($noty) {
                                    $.ajax({
                                        url: '<?=base_url("cliente/my_cliente") ?>',
                                        type: 'post',
                                        data: {cliente_to_block: <?=$cliente->id_clientes?>},
                                        success: function() {
                                            $('#block<?=$cliente->id_clientes?>').toggleClass('fa-check-square fa-square-o');
                                        }
                                    });
                                    $noty.close();
                                    noty({text: 'Cliente Desativado!', layout: 'topRight', type: 'success'});
                                }
                                },
                                {addClass: 'btn btn-danger btn-clean', text: 'Cancel', onClick: function($noty) {
                                    $noty.close();
                                    }
                                }
                            ]
                    })                                                    
                }                                            
            </script>
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



