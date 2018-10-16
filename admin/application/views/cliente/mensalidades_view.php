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
                    <h2><span class="fa fa-users"></span> Meus cliente</h2>
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
                                                    <th>Telefone</th>
                                                    <th>Proximo Vencimento</th>
                                                    <th>Meses Atrasados</th>
                                                    <th>Status Mensalidade</th>
                                                    <th>Plano</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach($mensalidades as $mensalidade){
                                            ?>
                                                    <tr id="<?=$mensalidade->cliente_id?>">
                                                        <td><?=$mensalidade->name_company?></td>
                                                        <td><?=$mensalidade->telefone?></td>
                                                        <td><?=$mensalidade->proximo_vencimento->format('Y-m-d')?></td>
                                                        <td><?=$mensalidade->meses_atrasados?></td>
                                                        <td><?=$mensalidade->status_pagamentos ? "Pago" : "Atrasada"?></td>
                                                        <td><?=$mensalidade->plan ? $mensalidade->plan : "Gratuito"?></td>                                                    
                                                        <td>
                                                            <!-- <a href="<?=base_url("cliente/edit_cliente/".$mensalidade->cliente_id) ?>"><button class="btn btn-success btn-condensed"><i class="fa fa-pencil"></i></button></a> -->
                                                            <!-- <button class="btn btn-primary btn-condensed"><i class="fa fa-arrow-up"></i></button> -->
                                                            <button class="btn btn-success  btn-condensed" onclick="notyConfirm<?=$mensalidade->cliente_id?>();"><i class="fa fa-check-circle "></i> Baixar Pagamento</button>
                                                            <script type="text/javascript">                                            
                                                                function notyConfirm<?=$mensalidade->cliente_id?>(){
                                                                    noty({
                                                                        text: 'Baixar pagamento?',
                                                                        layout: 'topRight',
                                                                        buttons: [
                                                                                {addClass: 'btn btn-success btn-clean', text: 'Ok', onClick: function($noty) {
                                                                                    $.ajax({
                                                                                        url: '<?=base_url("financeiro/baixa_pagamento   ") ?>',
                                                                                        type: 'post',
                                                                                        data: {cliente_id: <?=$mensalidade->cliente_id?>},
                                                                                        success: function() {
                                                                                            window.reload();
                                                                                        }
                                                                                    });
                                                                                    $noty.close();
                                                                                    noty({text: 'Pagamento Baixado!', layout: 'topRight', type: 'success'});
                                                                                }
                                                                                },
                                                                                {addClass: 'btn btn-danger btn-clean', text: 'Cancel', onClick: function($noty) {
                                                                                    window.reload();
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



