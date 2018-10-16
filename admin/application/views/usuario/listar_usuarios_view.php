<div class="page-container">
    <?php $this->load->view("template/left_menu_view", null); ?>
    <div class="page-content"> 
        <?php $this->load->view("template/header_menu_view", null); ?>                                     
        <div class="page-title">                    
            <h2><span class="fa fa-users"></span> Listar Usuários</h2>
        </div>
        <?php $msg = $this->session->flashdata('msg'); if ($msg) { ?>
            <div class="row">      
                <div class="col-md-12">
                    <div class="<?php if($msg['tipo']==1){ echo "alert alert-success";}elseif($msg['tipo']==2){echo "alert alert-danger";}?>" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Fechar</span></button>
                        <?=$msg['texto']?>.
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table datatable table-striped table-condensed table-actions">
                                    <thead>
                                        <tr>
                                            <th>Nome:</th>
                                            <th>Ramo:</th>
                                            <th>Email:</th>
                                            <th>Ativo:</th>
                                            <th width="120">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($usuarios as $usuario) { ?>
                                            <tr id="user_<?=$usuario->id?>">
                                                <td><?=$usuario->name." ".$usuario->surname?></td>
                                                <td><?=$usuario->ramo?></td>
                                                <td><?=$usuario->email?></td>
                                                <td><?=$usuario->active ? "Sim" : "Não"?></td>                                                    
                                                <td>
                                                    <a href="<?=base_url()?>usuario/editar/<?=$usuario->id?>"><button class="btn btn-success btn-condensed"><i class="fa fa-pencil"></i></button></a>
                                                    <button class="btn btn-danger btn-condensed" onclick="deleteConfirm(<?=$usuario->id?>)"><i class="fa fa-times"></i></button>
                                                </td>                                                    
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                              
</div>
<script type="text/javascript">                                            
    function deleteConfirm(id_usuario) {
        noty({
            text: 'Realmente deseja excluir este registro?',
            layout: 'topRight',
            buttons: [{addClass: 'btn btn-success btn-clean', text: 'Ok', onClick: function($noty) {
                $.ajax({
                    url: '<?=base_url()?>usuario/deletar',
                    type: 'post',
                    data: {cliente_to_remove: id_usuario},
                    success: function() {
                        $('#user_' + id_usuario).attr("class","hidden");
                    }
                });
                $noty.close();
                noty({text: 'Registro Apagado!', layout: 'topRight', type: 'success'});
                }},
                {addClass: 'btn btn-danger btn-clean', text: 'Cancel', onClick: function($noty) {
                    $noty.close();
                    }
                }
            ]
        })                                                    
    }                                
</script>