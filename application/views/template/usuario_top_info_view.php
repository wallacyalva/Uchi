<div class="container" style="margin-bottom: 14px;">
    <div class="row cxInfor">
        <div class="col-xs-12 col-md-5 col-xl-4 zeroPadding fotoNome">
            <div class="fotoPerfil" id="user_image">
                <a href="#" class="" data-toggle="modal" data-target="#modal_change_photo">
                    <img src="<?=images_url()?><?=$usuario->avatar?>">
                </a>
            </div>
            <div class="nomeInfor">
                <h1><?=$usuario->name?></h1>
                <p>Ingressou: <?php $date = new DateTime($usuario->created); echo $date->format('d/m/Y')?></p>
            </div>
        </div>
        <div class="col-xs-12 col-md-7 col-xl-8 zeroPadding bioBt">
            <p class="text-uppercase" style="font-weight: bold;">Sobre mim:</p>
            <p><?=$usuario->aboutme ? $usuario->aboutme : "Você ainda não tem escreveu sobre você, altere seus dados agora cliquando no botão a baixo."?></p>
            <div class="btInline">
                <div class="text-uppercase caixaBordaAzul">Dados Pessoais<a data-toggle="modal" data-target="#editarInformacoes"></a></div>
                <div class="text-uppercase caixaBordaAmarelo">Portfólio<a data-toggle="modal" data-target="#editarPortifolio"></a></div>
                <div class="text-uppercase caixaBordaVermelho">Validações<a href="#"></a></div>
                <div class="text-uppercase caixaBordaVerde">Recomendações<a data-toggle="modal" data-target="#recomendacoes"></a></div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CHANGE PHOTO -->
<div class="modal animated fadeIn" id="modal_change_photo" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title" id="smallModalHead">Trocar Foto</h4>
            </div>                    
            <form id="cp_crop" method="post" action="<?=base_url("usuario/cropPhoto")?>">
            <div class="modal-body">
                <div class="text-center" id="cp_target">Use este formulario para trocar sua imagem de perfil.</div>
                <input type="hidden" name="cp_img_path" id="cp_img_path"/>
                <input type="hidden" name="ic_x" id="ic_x"/>
                <input type="hidden" name="ic_y" id="ic_y"/>
                <input type="hidden" name="ic_w" id="ic_w"/>
                <input type="hidden" name="ic_h" id="ic_h"/>                        
            </div>                    
            </form>
            <form id="cp_upload" method="post" enctype="multipart/form-data" action="<?=base_url("usuario/changePhoto")?>">
            <div class="modal-body form-horizontal form-group-separated">
                <div class="form-group">
                    <label class="col-md-4 control-label">Nova Foto</label>
                    <div class="col-md-4">
                        <input type="file" class="fileinput btn-info" name="file" id="cp_photo" data-filename-placement="inside" title="Escolher"/>
                    </div>                            
                </div>                        
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-success disabled" id="cp_accept">Salvar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL CHANGE PHOTO -->

<!-- MODAL EDITAR INFO-->

<div class="modal fade" id="editarInformacoes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditar">Editar Informações</h5>
            </div>
            <form action="<?=base_url()?>usuario/editarInfo" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Sobre Você:</label>
                        <textarea class="form-control" name="sobre" rows="3"><?=$usuario->aboutme ? $usuario->aboutme : ""?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Idade:</label>
                        <input type='text' class="form-control" name="Idade" value="<?=$usuario->Idade ? $usuario->Idade : ""?>">
                    </div>
                    <div class="form-group">
                        <label>Estado Civil:</label>
                        <input type='text' class="form-control" name="Civil" value="<?=$usuario->Civil ? $usuario->Civil : ""?>">
                    </div>
                    <div class="form-group">
                        <label>Nasciolidade:</label>
                        <input type='text' class="form-control" name="Nasciolidade" value="<?=$usuario->Nasciolidade ? $usuario->Nasciolidade : ""?>">
                    </div>
                    <div class="form-group">
                        <label>Endereço Eletrônico:</label>
                        <input type='text' class="form-control" name="Eletronico" value="<?=$usuario->Eletronico ? $usuario->Eletronico : ""?>">
                    </div>
                    <div class="form-group">
                        <label>Telefone:</label>
                        <input type='text' class="form-control" name="Telefone" value="<?=$usuario->Telefone ? $usuario->Telefone : ""?>">
                    </div>
                    <h4>Endereço</h4>
                    <div class="form-group">
                        <label>Rua:</label>
                        <input type='text' class="form-control" name="Rua" value="<?=$usuario->street ? $usuario->street : ""?>">
                    </div>
                    <div class="form-group">
                        <label>Bairro:</label>
                        <input type='text' class="form-control" name="Bairro" value="<?=$usuario->district ? $usuario->district : ""?>">
                    </div>
                    <div class="form-group">
                        <label>Cidade:</label>
                        <input type='text' class="form-control" name="Cidade" value="<?=$usuario->city ? $usuario->city : ""?>">
                    </div>
                    <div class="form-group">
                        <label>Estado:</label>
                        <input type='text' class="form-control" name="Estado" value="<?=$usuario->state ? $usuario->state : ""?>">
                    </div>
                    <div class="form-group">
                        <label>Código Postal:</label>
                        <input type='text' class="form-control" name="Postal" value="<?=$usuario->postalcode ? $usuario->postalcode : ""?>">
                    </div>
              
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR portifolio-->

<div class="modal fade" id="editarPortifolio" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditar">Seu Portfólio</h5>
            </div>
            <form action="usuario/editarPortifolio" method="post">
                <div class="modal-body">
                    <h6>Objetivos</h6>
                    <div class="form-group">
                        <label>Curto Prazo:</label>
                        <textarea class="form-control" name="curto" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Longo Prazo:</label>
                        <textarea class="form-control" name="longo" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Area de Atuação:</label>
                        <textarea class="form-control" name="area" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Experiencias Anteriores:</label>
                        <textarea class="form-control" name="experiencias" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Suas habilidades:</label>
                        <textarea class="form-control" name="habilidades" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Referencias de Seus Trabalhos:</label>
                        <textarea class="form-control" name="referencias" rows="3"></textarea>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- recomendacoes -->

<div class="modal fade" id="recomendacoes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditar">Recomendações</h5>
            </div>
            <div class="caixaPadrao caixaRecomendacoes">
            <form action="" method="post">
            <?php  if(count($recomendacoes) == "0"){
                print_r("Sem recomendacoes");
            } ?>
                        <div class="conteudo">
						<?php foreach ($recomendacoes as $rec) { ?>
						<div class="post relative">
							<div class="d-flex justify-content-between align-items-center">
								<div class="foto">
									<img src="<?=images_url()?><?= $rec->avatar ?>" alt="Foto Recomendações">
								</div>
								<div class="coment">
									"<span class="txt"><?= $rec->texto ?></span>"
								</div>
							</div>
							<div class="d-flex justify-content-between align-items-center">
								<div class="estrelas">
									<i class="fa fa-star amarelo" aria-hidden="true"></i>
									<i class="fa fa-star <?= $rec->estrelas >= "2" ? "amarelo" : "" ?>" aria-hidden="true"></i>
									<i class="fa fa-star <?= $rec->estrelas >= "3" ? "amarelo" : "" ?>" aria-hidden="true"></i>
									<i class="fa fa-star <?= $rec->estrelas >= "4" ? "amarelo" : "" ?>" aria-hidden="true"></i>
									<i class="fa fa-star <?= $rec->estrelas == "5" ? "amarelo" : "" ?>" aria-hidden="true"></i>
								</div>
								<div class="data text-uppercase"><?= date('d : m : Y', strtotime($rec->data)) ?></div>
							</div>
							<a href="#abrirModalRecomendacao" class="tudo"></a>
						</div>
						<?php } ?>
					</div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                </div>
            </form>
        </div>
    </div>
</div>
