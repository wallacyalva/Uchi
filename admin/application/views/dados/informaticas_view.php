<div class="page-container">
    <?php $this->load->view("template/left_menu_view", null); ?>
    <div class="page-content">
        <ul class="breadcrumb">
            <li><a href="<?=base_url("area");?>">Home</a></li>
            <li class="active" >Clientes Classificados</li>                    
        </ul>                             
        <div class="page-title">                    
            <h2><span class="fa fa-users"></span> Informaticas</h2>
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
                                <form action="<?=base_url()?>dados/insertInformatica" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-3 form-group"><label for="nome"><h3>Adicionar Informatica:</h3></label></div>
                                            <div class="col-md-8 form-group"><input type="text" class="form-control" name="nome" id="nome" placeholder="Nome"></div>
                                            <div class="col-md-1 form-group"><button type="submit" class="btn btn-success">Inserir</button></div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 10px">
                                        <div class="col-md-12">
                                            <div class="col-md-3 form-group"><label for="nome"><h3>Filiação:</h3></label></div>
                                            <div class="col-md-9 form-group"><select class="form-control" name="pai" id="pai">
                                                <option value="0">Nenhuma Filiação (Nova Categoria)</option>
                                                <?php foreach($informaticas as $informatica) { ?>
                                                    <?php if($informatica->pai == 0) { ?>
                                                        <option value="<?=$informatica->id?>"><?=$informatica->nome?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select></div>
                                        </div>
                                    </div>
                                </form>
                                <table class="table datatable table-striped table-condensed table-actions">
                                    <thead>
                                        <tr>
                                            <th>Nome:</th>
                                            <th>Tipo:</th>
                                            <th width="150">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($informaticas as $informatica) { ?>
                                            <tr id="area_<?=$informatica->id?>">
                                                <td><?=$informatica->nome?></td>
                                                <td><?=$informatica->pai == 0 ? "<p class='text-warning'>Categoria</p>" : "<p class='text-info'>Sub-Categoria</p>" ?></td>                                               
                                                <td>
                                                    <button class="btn btn-warning btn-condensed" onclick="alterarModal(<?=$informatica->id?>)"><i class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-danger btn-condensed" onclick="deleteConfirm(<?=$informatica->id?>,'<?=$informatica->pai == 0 ? "Categoria" : "Sub-Categoria" ?>')"><i class="fa fa-times"></i></button>
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
<div id="alterarModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url()?>dados/alterarInformatica" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Alterar Nome:</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3 form-group"><label for="nome"><h3>Nome:</h3></label></div>
                        <div class="col-md-9 form-group"><input type="text" class="form-control" name="nome_modal" id="nome_modal" placeholder="Nome"></div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-12">
                        <div class="col-md-3 form-group"><label for="nome"><h3>Filiação:</h3></label></div>
                        <div class="col-md-9 form-group"><select class="form-control" name="pai_modal" id="pai_modal">
                            <option value="0">Nenhuma Filiação (Nova Categoria)</option>
                            <?php foreach($informaticas as $informatica) { ?>
                                <?php if($informatica->pai == 0) { ?>
                                    <option value="<?=$informatica->id?>"><?=$informatica->nome?></option>
                                <?php } ?>
                            <?php } ?>
                        </select></div>
                    </div>
                    <input type="hidden" name="id_modal" id="id_modal" value="0">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="javascript:window.location.reload()">Cancelar</button>
                    <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function alterarModal(id) {
        $("#id_modal").attr("value",id);
        $("#alterarModal").find("option[value='" + id + "']").remove();
        $("#alterarModal").modal("show");
    }                                       
    function deleteConfirm(id, text) {
        noty({
            text: 'Realmente deseja excluir esta ' + text + ' ?',
            layout: 'topRight',
            buttons: [{addClass: 'btn btn-success btn-clean', text: 'Sim', onClick: function($noty) {
                $.ajax({
                    url: '<?=base_url()?>dados/deletarInformatica',
                    type: 'post',
                    data: {id: id},
                    success: function() {
                        $('#area_' + id).attr("class","hidden");
                    }
                });
                $noty.close();
                noty({text: text + ' Apagada!', layout: 'topRight', type: 'success'});
                }},
                {addClass: 'btn btn-danger btn-clean', text: 'Não', onClick: function($noty) {
                    $noty.close();
                    }
                }
            ]
        })                                                    
    }                                
</script>