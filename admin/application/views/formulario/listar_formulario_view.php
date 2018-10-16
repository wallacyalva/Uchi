<div class="page-container">

    <?php $this->load->view("template/left_menu_view", null); ?>

    <div class="page-content">    

        <?php $this->load->view("template/header_menu_view", null); ?>                       

        <ul class="breadcrumb">
            <li><a href="<?=base_url()?>usuario">Home</a></li>                    
            <li class="active"><a href="<?=base_url()?>formulario/listarFormularios">Listar Formulário</a></li>
        </ul>
                
        <div class="page-title">                    
            <h2><span class="fa fa-user"></span> Listar Formulário</h2>
        </div>

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
                                            <th>Campos:</th>
                                            <th>Criado Em:</th>
                                            <th>Ações:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($formularios as $formulario) { ?>
                                        
                                            <tr id="<?=$formulario->id?>">
                                                <td><?=$formulario->nome?></td>
                                                <td><?=$formulario->number?></td>
                                                <td><?php $data = new DateTime($formulario->created); echo $data->format("d/m/Y");?></td>
                                                <td width="100">
                                                    <a href="<?=base_url("../formulario/responder/$formulario->id")?>" class="btn btn-info"><span class="fa fa-eye"> Visualizar</span></a>
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