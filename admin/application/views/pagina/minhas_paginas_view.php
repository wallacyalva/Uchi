        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- LEFT MENU -->
            <?php $this->load->view("template/left_menu_view", null) ?>
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                
            <?php $this->load->view("template/header_menu_view", null) ?>                       

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=base_url("pagina/new");?>">Nova Pagina</a></li>
                    <li class="active" >Minhas Paginas</li>                    
                </ul>
                <!-- END BREADCRUMB -->  

                <!-- PAGE TITLE -->                    
                <div class="page-title">                    
                    <h2><span class="fa fa-users"></span> Paginas</h2>
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
                                                    <th>url</th>
                                                    <th width="160">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach($paginas as $pagina){
                                            ?>
                                                    <tr id="<?=$pagina->idpagina?>">
                                                        <td><?=$pagina->titulo?></td>
                                                        <td><?=$pagina->url?></td>
                                                                                                      
                                                        <td>
                                                            <a href="<?=base_url("pagina/editar/".$pagina->idpagina) ?>"><button class="btn btn-success btn-condensed"><i class="fa fa-pencil"></i></button></a>
                                                            <button class="btn btn-danger  btn-condensed" onclick="notyConfirm<?=$pagina->idpagina?>();"><i class="fa fa-times"></i></button>
            <script type="text/javascript">                                            
                function notyConfirm<?=$pagina->idpagina?>(){
                    noty({
                        text: 'Realmente deseja excluir este registro?',
                        layout: 'topRight',
                        buttons: [
                                {addClass: 'btn btn-success btn-clean', text: 'Ok', onClick: function($noty) {
                                    $.ajax({
                                        url: '<?=base_url("pagina/paginas") ?>',
                                        type: 'post',
                                        data: {pagina_to_remove: <?=$pagina->idpagina?>},
                                        success: function() {
                                            $('#<?=$pagina->idpagina?>').addClass('hide');
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



