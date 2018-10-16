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
                <div class="text-uppercase caixaBordaAmarelo">Portfólio<a href="#"></a></div>
                <div class="text-uppercase caixaBordaVermelho">Validações<a href="#"></a></div>
                <div class="text-uppercase caixaBordaVerde">Recomendações<a href="#"></a></div>
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
            <form action="usuario/editarInfo" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Sobre Você:</label>
                        <textarea class="form-control" name="sobre" rows="3"><?=$usuario->aboutme ? $usuario->aboutme : ""?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Nascimento:</label>
                        <input type='text' class="form-control" name="nascimento" value="<?=$usuario->birthdate ? $usuario->birthdate : ""?>">
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

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-lg-3 zeroPadding">
            <div class="cxRanking">
                <div class="imgBackground" style="background: url(<?=images_url()?>backgroundProfissao.jpg);"></div>
                <div class="rankInfor">
                    <div class="trofeu"><img src="<?=images_url()?>trofeu.png"></div>
                    <p class="text-center posicao">Ranking: #20024</p>
                    <p class="text-center categoria">Categoria <?=$usuario->ramo?></p>
                    <div class="barras">
                        <div class="grupo">
                            <div class="barra">
                                <div class="analitico" style="width: 70%;"></div>
                            </div>
                            <div class="porcent">70%</div>
                        </div>
                        <div class="grupo">
                            <div class="barra">
                                <div class="criativo" style="width: 30%;"></div>
                            </div>
                            <div class="porcent">30%</div>
                        </div>
                        <div class="grupo">
                            <div class="barra">
                                <div class="operacional" style="width: 80%;"><img src="<?=images_url()?>destaque.png" class="destaque"></div>
                            </div>
                            <div class="porcent">80%</div>
                        </div>
                        <div class="grupo">
                            <div class="barra">
                                <div class="relacional" style="width: 45%;"></div>
                            </div>
                            <div class="porcent">45%</div>
                        </div>
                    </div>
                    <p class="desc">
                        <span class="text-uppercase txtAzul">Analítico</span> | 
                        <span class="text-uppercase txtAmarelo">Criativo</span> | 
                        <span class="text-uppercase txtVermelho">operaciona</span>l | 
                        <span class="text-uppercase txtVerde">relacional</span>
                    </p>
                </div>
            </div>

            <div class="lateralBt">
                <div class="educacional">
                    Dimensão Educacional
                    <a href="#educacional"></a>
                </div>
                <div class="profissional">
                    Dimensão profissional
                    <a href="#profissional"></a>
                </div>
                <div class="comportamental">
                    Dimensão comportamental
                    <a href="#comportamental"></a>
                </div>
                <div class="cases">
                    Cases
                    <a href="#cases"></a>
                </div>
            </div>

            <div class="anuncio">
                <img src="<?=images_url()?>propaganda2.png" class="img-fluid" alt="Anuncio">
            </div>
        </div>
        <div class="col-xs-12 col-lg-9 zeroPaddingRight">
            <div class="caixaPadrao conteudoMeio areaEmpresaCadastro">
                <div class="row">
                    <div class="col">
<div class="lista">
    <div class="list-group">
        <?php foreach($vaga as $vagas) { ?>
            <a data-toggle="modal" data-target="#visualizarVaga_<?=$vagas->id?>" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?=$vagas->titulo?></h5>
                    <small class="text-muted"><?= $vagas->updated ?></small>
                </div>
                <p class="mb-1"><?=$vagas->descricao?></p>
                <small class="text-muted"><?=$vagas->local?></small>
            </a>
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#visualizarVaga_<?=$vagas->id?>">Visualizar</button>
            <!-- <div class="modal fade" id="opts_<?=$vagas->id?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 text-center"><button type="button" class="btn btn-primary text-center" data-dismiss="modal" style="width: 75px; height: 75px;"><span class="fa fa-eye" style="display: block; font-size: 35px;"></span><p style="margin: 0; font-size: 11px;">Vizualizar</p></button></div>
                                    <div class="col-md-4 text-center"><button data-toggle="modal" data-target="#AlterarEventoVaga_0" class="btn btn-success text-center" style="width: 75px; height: 75px;"><span class="fa fa-pencil" style="display: block; font-size: 35px;"></span><p style="margin: 0; font-size: 11px;">Editar</p></button></div>
                                    <div class="col-md-4 text-center"><button data-toggle="modal" data-target="#opts2_<?=$vagas->id?>" class="btn btn-danger text-center" style="width: 75px; height: 75px;"><span class="fa fa-trash" style="display: block; font-size: 35px;"></span><p style="margin: 0; font-size: 11px;">Excluir</p></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->


            <!-- <div class="modal fade" id="opts2_<?=$vagas->id?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">Aviso!</div>
                        <div class="modal-body">Você realmente deseja excluir a vaga: "<?=$vagas->titulo?>" ?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            <button type="button" class="btn btn-primary" onclick="location.href='<?=base_url()?>empresa/deletarVaga/<?=$vagas->id?>'">Sim</button>
                        </div>
                    </div>
                </div>
            </div> -->



            <div class="modal fade" id="visualizarVaga_<?=$vagas->id?>" tabindex="-1" role="dialog" aria-labelledby="CadastrarEventoVagaLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?=base_url()?>empresa/responderVaga/<?=$vagas->id?>/<?=$vagas->id_empresa?>" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AlterarEventoVagaLabel">Vaga</h5>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                            <div class="col-md-3"><label for="titulo"><h6>Titulo:<?=$vagas->titulo?></label></h6></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                            <div class="col-md-3"><label for="titulo"><h6>Salario:R$<?=$vagas->salario?></label></h6></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                            <div class="col-md-3"><label for="titulo"><h6>Local:<?=$vagas->local?></label></h6></div>
                                            </div>
                                        </div>
                                     
                                        <div class="form-group col-md-12">
                                        <label for="descricao">Descrição:</label><br>
                                            <div class="row"><div class="col-md-12"><p><?=$vagas->descricao?></p></div></div>
                                        </div>        
                                    </div>
                                </div>                                        
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Cadastrar-se</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        <?php } ?>
    </div>
</div>
</div>
</div>
</div>
</div>