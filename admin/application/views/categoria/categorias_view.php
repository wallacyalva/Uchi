        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- LEFT MENU -->
            <?php $this->load->view("template/left_menu_view", null) ?>
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                
            <?php $this->load->view("template/header_menu_view", null) ?>                       

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=base_url("categoria/new");?>">Nova</a></li>
                    <li class="active" >Categorias</li>                    
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
                                                    <th>Descrição</th>
                                                    <th>É Uma Categoria.</th>
                                                    <th width="140" style="align:center">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach($categorias as $categoria){
                                            ?>
                                                    <tr id="<?=$categoria->id?>">
                                                        <td><?=$categoria->descricao?></td>
                                                        <td><?php if($categoria->pai){ echo "NÃO";}else{ echo "SIM";}?></td>                                                
                                                        <td>
                                                            <a href="<?=base_url("categoria/editar_categoria/".$categoria->id) ?>"><button class="btn btn-success btn-condensed"><i class="fa fa-pencil"></i></button></a>
                                                            <button class="btn btn-danger  btn-condensed" onclick="notyConfirm<?=$categoria->id?>();"><i class="fa fa-times"></i></button>
            <script type="text/javascript">                                            
                function notyConfirm<?=$categoria->id?>(){
                    noty({
                        text: 'Realmente deseja excluir este registro?',
                        layout: 'topRight',
                        buttons: [
                                {addClass: 'btn btn-success btn-clean', text: 'Ok', onClick: function($noty) {
                                    $.ajax({
                                        url: '<?=base_url("categoria/categorias") ?>',
                                        type: 'post',
                                        data: {categoria_to_remove: <?=$categoria->id?>},
                                        success: function() {
                                            $('#<?=$categoria->id?>').addClass('hide');
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



