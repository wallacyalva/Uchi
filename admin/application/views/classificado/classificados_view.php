        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- LEFT MENU -->
            <?php $this->load->view("template/left_menu_view", null) ?>
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                
            <?php $this->load->view("template/header_menu_view", null) ?>                       

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=base_url("usuario")?>">Home</a></li>
                    <li class="active">Meus Classificados</li>                    
                </ul>
                <!-- END BREADCRUMB -->  

                <!-- PAGE TITLE -->                    
                <div class="page-title">                    
                    <h2><span class="fa fa-users"></span> Classificados</h2>
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
                                                    <th>Titulo</th>
                                                    <th width="240">Cidade</th>
                                                    <th>Texto</th>
                                                    <th width="140">data</th>
                                                    <th width="140">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach($classificados as $classificado){
                                            ?>
                                                    <tr id="<?=$classificado->idclassificados?>">
                                                        <td><?=$classificado->titulo?></td>
                                                        <td><?=$classificado->cidade?></td>
                                                        <td><?=$classificado->texto?></td>
                                                        <td><?=$classificado->data?></td>                                                    
                                                        <td>
                                                            <button class="btn btn-info btn-condensed" onclick="notyConfirmBlock<?=$classificado->idclassificados?>();"><i id="block<?=$classificado->idclassificados?>" class="fa <?php if($classificado->ativo==1){ echo "fa-check-square";} else { echo "fa-square-o";}?>"></i></button>
                                                            <button class="btn btn-danger  btn-condensed" onclick="notyConfirm<?=$classificado->idclassificados?>();"><i class="fa fa-times"></i></button>
            <script type="text/javascript">                                            
                function notyConfirm<?=$classificado->idclassificados?>(){
                    noty({
                        text: 'Realmente deseja excluir este registro?',
                        layout: 'topRight',
                        buttons: [
                                {addClass: 'btn btn-success btn-clean', text: 'Ok', onClick: function($noty) {
                                    $.ajax({
                                        url: '<?=base_url("classificado/classificados") ?>',
                                        type: 'post',
                                        data: {classificado_to_remove: <?=$classificado->idclassificados?>},
                                        success: function() {
                                            $('#<?=$classificado->idclassificados?>').addClass('hide');
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
                function notyConfirmBlock<?=$classificado->idclassificados?>(){
                    noty({
                        text: 'Realmente deseja desativar este classificado?',
                        layout: 'topRight',
                        buttons: [
                                {addClass: 'btn btn-success btn-clean', text: 'Ok', onClick: function($noty) {
                                    $.ajax({
                                        url: '<?=base_url("classificado/classificados") ?>',
                                        type: 'post',
                                        data: {classificado_to_block: <?=$classificado->idclassificados?>},
                                        success: function() {
                                            $('#block<?=$classificado->idclassificados?>').toggleClass('fa-check-square fa-square-o');
                                        }
                                    });
                                    $noty.close();
                                    noty({text: 'Classificado Desativado!', layout: 'topRight', type: 'success'});
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



