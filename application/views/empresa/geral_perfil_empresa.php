﻿    <div class="container" style="margin-bottom: 14px;">
        <div class="row cxInfor">
            <div class="col-xs-12 col-md-5 col-xl-4 zeroPadding fotoNome">
                <div class="fotoPerfil">
                    <img src="<?=images_url()?><?=$usuario->avatar?>">
                </div>
                <div class="nomeInfor">
                    <h1><?=$usuario->name?></h1>
                    <p>Ingressou: <?php $data = new DateTime($usuario->created); echo $data->format("d/m/Y");?></p>
                </div>
            </div>
            <div class="col-xs-12 col-md-7 col-xl-8 zeroPadding bioBt">
 				<div class="row">
 					<div class="col-12 col-md-9">
						<p class="text-uppercase" style="font-weight: bold;">Sobre mim:</p>
						<p><?=$usuario->aboutme?></p>
						<div class="maisInfor">
							<div class="localizacao"><span class="text-uppercase">Localização:</span> Fortaleza - CE</div>
               				<div class="social">
               					<span class="text-uppercase">Social:</span>
               					<a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
               					<a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
               					<a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
               					<a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
               					<a href="#"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
               					<a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
               				</div>
               				<div class="verMais text-uppercase">
               					<a href="#verMais">+ Ver Mais</a>
               				</div>
						</div>
               		</div>
               		<div class="col-12 col-md-3 btns">
               			<div class="text-uppercase caixaBordaPadrao">Enviar Mensagem<a  data-toggle="modal" data-target="#EnviarMensagem"></a></div>
               			<!-- TIPOS DE BOTÕES -->
               			
						<?php switch ($estadoAmizade) {
							case '0':
							?><div class="text-uppercase caixaBordaAmarelo"><i class="fa fa-clock-o" aria-hidden="true"></i> Aguardando<a href="#"></a></div><?php
								break;
							case '1':
							?><div class="text-uppercase caixaBordaVerde"><i class="fa fa-check" aria-hidden="true"></i> Seguindo<a href="#"></a></div><?php
								break;
							case '2':
							?><div class="text-uppercase caixaPadraoBlock"><i class="fa fa-lock" aria-hidden="true"></i> Fechado</div><?php
								break;
							case '3':
							?><div class="text-uppercase caixaBordaAzul"><i class="fa fa-plus" aria-hidden="true"></i> Seguir<a href="<?= base_url()?>usuario/solicitarAmigo/<?= $usuario->id?>"></a></div><?php
							break;
							

						}?>
               			
					</div>
                </div>
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
                        <p class="text-center posicao">Ranking: #23024</p>
                        <p class="text-center categoria"><?=$usuario->ramo?></p>
                    </div>
                </div>

                

                <div class="anuncio">
                    <img src="<?=images_url()?>/propaganda2.png" class="img-fluid" alt="Anuncio">
                </div>
            </div>
            <div class="col-xs-12 col-lg-6">
                <div class="caixaPadrao conteudoMeio">

                    <div class="conteudo">

                        <?php foreach($vagas as $vag) { ?>

                            <div class="post">


                                <div class="opt">
                                    <div id="button_opts" class="button">
                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                    </div>

                                    <div class="caixa" style="z-index: 1000;">
                                        <ul>
                                            <li onclick=""><i class="fa fa-times float-left" aria-hidden="true"></i> Denunciar</li>
                                        </ul>
                                    </div>

                                </div>
								<a data-toggle="modal" data-target="#visualizarVaga_<?=$vag->id?>" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?=$vag->titulo?></h5>
                    <small class="text-muted"><?= $vag->updated ?></small>
                </div>
                <p class="mb-1"><?=$vag->descricao?></p>
           	     <small class="text-muted"><?=$vag->local?></small>
           	 </a>
                                
                            </div>
                        <?php
                            }
                        ?>

                        <div class="anuncio">
                            <img src="<?=images_url()?>/propaganda1.png" class="img-fluid" alt="Anuncio">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-3 zeroPadding">
                <div class="caixaPadrao caixaRecomendacoes">
					<div class="titulo">Recomendações  &emsp; <a data-toggle="modal" data-target="#fazerRecomendacao"> <b/> + Recomendar</a></div>
					
					<div class="conteudo" style="overflow:scroll " >
						<?php foreach ($recomendacoes as $rec) { ?>
						<div class="post relative">
							<div class="d-flex justify-content-between align-items-center">
								<div class="foto">
									<img src="<?=images_url()?>/<?= $rec->avatar ?>" alt="Foto Recomendações">
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
				<br>
				<div class="caixaPadrao caixaAmigos">
					<div class="titulo">Seguidores (<?= count($amizades)?>)</div>
					<div class="conteudo">
					<?php foreach ($amizades as $amg) { ?>
					<div><a href="<?=base_url()?>usuario/perfil/<?= $amg->amigo2 ?>"><img src="<?=images_url()?>/<?= $amg->data->avatar ?>" alt="Foto Amigo" style="height: 42px; width: 42px;"></a></div>
					<?php } ?>
						
					<?php if(count($amizades) > "12"){ ?>
						<div class="ultimo relative">
							<span>+ <?php print(count($amizades) - "12") ?></span>
							<a href="#linkMaisAmigos" class="tudo"></a>
						</div>
						<?php } ?>
					</div>
				</div>
				<br>
				<div class="caixaPadrao caixaEmpresas">
					<div class="titulo">Funcionarios</div>
					<div class="conteudo">
						<div class="d-flex justify-content-between align-items-center caixa">
							<div class="foto">
								<a href="#linkGrupo">
									<img src="<?=images_url()?>/empresa-img1.png" alt="Imagem Grupo">
								</a>
							</div>
							<div class="infor">
								<strong>Pedrão</strong>
								<br>
								<small>Pedreiro / Medico</small>
							</div>
							<div class="relative star">
								<i class="fa fa-star" aria-hidden="true"></i>
								<a class="tudo" href="#linkGrupo"></a>
							</div>
						</div>
						<!-- \ -->
						<div class="d-flex justify-content-between align-items-center caixa">
							<div class="foto">
								<a href="#linkGrupo">
									<img src="<?=images_url()?>/empresa-img2.png" alt="Imagem Grupo">
								</a>
							</div>
							<div class="infor">
								<strong>Joana</strong>
								<br>
								<small>Transportadora</small>
							</div>
							<div class="relative star plus">
								<i class="fa fa-star-o" aria-hidden="true"></i>
								<a class="tudo" href="#linkGrupo"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
	
<!-- enviarMensagem -->

<div class="modal fade" id="EnviarMensagem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelMensagem">Enviar mensagem para <strong><?php print_r($usuario->name) ?></strong>:</h5>
            </div>
            <form action="<?= base_url()?>empresa/enviarMensagem/<?= $user->id?>/<?= $usuario->id?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>mensagem:</label>
                        <textarea class="form-control" name="mensagem" rows="3"></textarea>
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

<!-- FAZER RECOMENDACOES -->

<div class="modal fade" id="fazerRecomendacao" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditar">Recomende <?= $usuario->name?>  </h5>
            </div>
            <form action="<?= base_url()?>empresa/recomendar/<?= $usuario->id?>" method="post">
                <div class="modal-body">              
                    <div class="form-group">
                        <label>Recomendação:</label>
                        <textarea class="form-control" name="Recomendacao" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Estrelas:</label>
						<input class="form-control" type="number" name="estrelas" min="1" max="5" value="1" >
						<div class="estrelas">
									<i class="fa fa-star amarelo" aria-hidden="true"></i>
									<i class="fa fa-star amarelo" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
								</div>
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