<div class="container">
	<div class="row" style="margin-top: 80px;">
		<div class="col-xs-12 col-lg-3 zeroPadding">

			<div class="caixaPadrao inforEmpresa">
				<div class="titulo">
					Informações
				</div>
				<div class="conteudo">
					<p>
						<strong>Sobre: </strong>
						<br>
						<?=$emp->sobre ? $emp->sobre : "-"?>
					</p>
					<p>
						<strong>Criada em:</strong>
						<?=$emp->criacao ? $emp->criacao : "-"?>
					</p>
					<p>
						<strong>Localidade:</strong>
						<?=$emp->local ? $emp->local : "-"?>
					</p>
					<p>
						<strong>Telefone:</strong>
						<?=$emp->Telefone ? $emp->Telefone : "-"?>
					</p>
					<p>
						<strong>Contato:</strong>
						<?=$emp->contato ? $emp->contato : "-"?>
					</p>
					<p>
						<strong>Website:</strong>
						<?=$emp->site ? $emp->site : "-"?>
					</p>

					<button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#editarInformacoes">
						Editar informações
					</button>

					<!--- modal - editar informações -->
					<div class="modal fade" id="editarInformacoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="ModalLabelEditar">Editar Informações</h5>
								</div>
								<form action="empresa/editarInfo" method="post">
									<div class="modal-body">
										<div class="form-group">
											<label>Breve descrição:</label>
											<textarea class="form-control" name="sobre" rows="3">
												<?=$emp->sobre ? $emp->sobre : ""?>
											</textarea>
										</div>
										<div class="form-group">
											<label>Criada em:</label>
											<input type="text" class="form-control" value="<?=$emp->criacao ? $emp->criacao : " "?>" name="criacao" placeholder="Ex.: 1993">
										</div>
										<div class="form-group">
											<label>Localidade::</label>
											<input type="text" class="form-control" value="<?=$emp->local ? $emp->local : " "?>" name="local" placeholder="Ex.: Salvador - BA">
										</div>
										<div class="form-group">
											<label>Telefone:</label>
											<input type="text" class="form-control" value="<?=$emp->Telefone ? $emp->Telefone : " "?>" name="phone" placeholder="Ex.: 9 98227655">
										</div>
										<div class="form-group">
											<label>Contato:</label>
											<input type="text" class="form-control" value="<?=$emp->contato ? $emp->contato : " "?>" name="contato" placeholder="Ex.: contato@email.com">
										</div>
										<div class="form-group">
											<label>Website:</label>
											<input type="text" class="form-control" value="<?=$emp->site ? $emp->site : " "?>" name="site" placeholder="Ex.: www.meusite.com.br">
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
					<!--- modal -->
				</div>
			</div>

		</div>
		<div class="col-xs-12 col-lg-9 zeroPaddingRight">
			<div class="caixaPadrao conteudoMeio areaEmpresaCadastro">
				<div class="row">
					<div class="col">
						<div class="bt">
							Cadastrar Evento/Vaga
							<a href="#CadastrarEventoVaga" class="tudo" data-toggle="modal" data-target="#CadastrarEventoVaga"></a>
						</div>
						<!-- Modal -->
						<div class="modal fade" id="CadastrarEventoVaga" tabindex="-1" role="dialog" aria-labelledby="CadastrarEventoVagaLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form action="<?=base_url()?>empresa/cadastrarVaga" method="post">
										<div class="modal-header">
											<h5 class="modal-title" id="CadastrarEventoVagaLabel">Cadastrar Evento/Vaga</h5>
										</div>
										<div class="modal-body">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group col-md-12">
														<div class="row">
															<div class="col-md-3">
																<label for="titulo">
																	<h6>Título:</h6>
																</label>
															</div>
															<div class="col-md-9">
																<input type="text" class="form-control" placeholder="Título" name="titulo" id="titulo">
															</div>
														</div>
													</div>
													<div class="form-group col-md-12">
														<div class="row">
															<div class="col-md-3">
																<label for="salario">
																	<h6>Sálario:</h6>
																</label>
															</div>
															<div class="col-md-9">
																<input type="number" min="0" step="0.01" class="form-control" placeholder="Sálario" name="salario" id="salario">
															</div>
														</div>
													</div>
													<div class="form-group col-md-12">
														<div class="row">
															<div class="col-md-3">
																<label for="local">
																	<h6>Local:</h6>
																</label>
															</div>
															<div class="col-md-9">
																<input type="text" class="form-control" placeholder="Local" name="local" id="local">
															</div>
														</div>
													</div>
													<div class="form-group col-md-12">
														<div class="row">
															<div class="col-md-3">
																<label for="area">
																	<h6>Area:</h6>
																</label>
															</div>
															<div class="col-md-9">
																<select class="form-control" name="area" id="area">
																	<option value="1">OPT 1</option>
																	<option value="2">OPT 2</option>
																	<option value="3">OPT 3</option>
																	<option value="4">OPT 4</option>
																	<option value="5">OPT 5</option>
																</select>
															</div>
														</div>
													</div>
													<div class="form-group col-md-12">
														<div class="row">
															<div class="col-md-12">
																<textarea class="form-control" name="descricao" id="descricao" rows="10">Descrição da vaga.</textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-primary">Cadastrar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Fim Modal -->
						<!-- Lista -->
						<hr>
						<div class="lista">
							<div class="list-group">
								<?php foreach($vagas as $vaga) { ?>
								<a data-toggle="modal" data-target="#opts_<?=$vaga->id?>" class="list-group-item list-group-item-action flex-column align-items-start">
									<div class="d-flex w-100 justify-content-between">
										<h5 class="mb-1">
											<?=$vaga->titulo?>
										</h5>
										<small class="text-muted">3 dias atrás</small>
									</div>
									<p class="mb-1">
										<?=$vaga->descricao?>
									</p>
									<small class="text-muted">
										<?=$vaga->local?>
									</small>
								</a>
								<div class="modal fade" id="opts_<?=$vaga->id?>" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-body">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-4 text-center">
															<button type="button" class="btn btn-primary text-center" data-dismiss="modal" style="width: 75px; height: 75px;">
																<span class="fa fa-eye" style="display: block; font-size: 35px;"></span>
																<p style="margin: 0; font-size: 11px;">Vizualizar</p>
															</button>
														</div>
														<div class="col-md-4 text-center">
															<button data-toggle="modal" data-target="#AlterarEventoVaga_0" class="btn btn-success text-center" style="width: 75px; height: 75px;">
																<span class="fa fa-pencil" style="display: block; font-size: 35px;"></span>
																<p style="margin: 0; font-size: 11px;">Editar</p>
															</button>
														</div>
														<div class="col-md-4 text-center">
															<button data-toggle="modal" data-target="#opts2_<?=$vagas[0]->id?>" class="btn btn-danger text-center" style="width: 75px; height: 75px;">
																<span class="fa fa-trash" style="display: block; font-size: 35px;"></span>
																<p style="margin: 0; font-size: 11px;">Excluir</p>
																</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="opts2_<?=$vaga->id?>" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">Aviso!</div>
											<div class="modal-body">Você realmente deseja excluir a vaga: "
												<?=$vaga->titulo?>" ?</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
												<button type="button" class="btn btn-primary" onclick="location.href='<?=base_url()?>empresa/deletarVaga/<?=$vaga->id?>'">Sim</button>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="AlterarEventoVaga_0" tabindex="-1" role="dialog" aria-labelledby="CadastrarEventoVagaLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<form action="<?=base_url()?>empresa/alterarVaga" method="post">
												<div class="modal-header">
													<h5 class="modal-title" id="AlterarEventoVagaLabel">Alterar Evento/Vaga</h5>
												</div>
												<div class="modal-body">
													<div class="col-md-12">
														<div class="row">
															<div class="form-group col-md-12">
																<div class="row">
																	<div class="col-md-3">
																		<label for="titulo">
																			<h6>Título:</h6>
																		</label>
																	</div>
																	<div class="col-md-9">
																		<input type="text" class="form-control" value="<?=$vaga->titulo?>" name="titulo" id="titulo">
																	</div>
																</div>
															</div>
															<div class="form-group col-md-12">
																<div class="row">
																	<div class="col-md-3">
																		<label for="salario">
																			<h6>Sálario:</h6>
																		</label>
																	</div>
																	<div class="col-md-9">
																		<input type="number" min="0" step="0.01" class="form-control" value="<?=$vaga->salario?>" name="salario" id="salario">
																	</div>
																</div>
															</div>
															<div class="form-group col-md-12">
																<div class="row">
																	<div class="col-md-3">
																		<label for="local">
																			<h6>Local:</h6>
																		</label>
																	</div>
																	<div class="col-md-9">
																		<input type="text" class="form-control" value="<?=$vaga->local?>" name="local" id="local">
																	</div>
																</div>
															</div>
															<div class="form-group col-md-12">
																<div class="row">
																	<div class="col-md-3">
																		<label for="area">
																			<h6>Area:</h6>
																		</label>
																	</div>
																	<div class="col-md-9">
																		<select class="form-control" name="area" id="area">
																			<option value="1">OPT 1</option>
																			<option value="2">OPT 2</option>
																			<option value="3">OPT 3</option>
																			<option value="4">OPT 4</option>
																			<option value="5">OPT 5</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="form-group col-md-12">
																<div class="row">
																	<div class="col-md-12">
																		<textarea class="form-control" name="descricao" id="descricao" rows="5" style="resize: none;">
																			<?=$vaga->descricao?>
																		</textarea>
																	</div>
																</div>
																<input type="hidden" value="<?=$vaga->id?>" name="id">
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
													<button type="submit" class="btn btn-primary">Alterar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<?php }  ?>
								
							</div>
						</div>
						<!-- Fim Lista -->
						<!-- Paginação -->
						<nav aria-label="Nevagação">
							<ul class="pagination justify-content-center">
								<li class="page-item">
									<a class="page-link" href="#" aria-label="Anterior">
										<span aria-hidden="true">&laquo;</span>
										<span class="sr-only">Anterior</span>
									</a>
								</li>
								<li class="page-item active">
									<a class="page-link" href="#">1</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#">2</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#">3</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#" aria-label="Próximo">
										<span aria-hidden="true">&raquo;</span>
										<span class="sr-only">Próximo</span>
									</a>
								</li>
							</ul>
						</nav>
						<!-- Fim Paginação -->
					</div>

					<div class="col-12 d-block d-sm-none">
						<hr>
					</div>

					<div class="col">
						<div class="bt">
							Cadastro de Cases
							<a href="#CadastroCases" class="tudo" data-toggle="modal" data-target="#CadastroCases"></a>
						</div>
						<!-- Modal -->
						<div class="modal fade" id="CadastroCases" tabindex="-1" role="dialog" aria-labelledby="CadastroCasesLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<form action="<?=base_url()?>empresa/cadastrarCases" method="post">
										<div class="modal-header">
											<h5 class="modal-title" id="CadastroCasesLabel">Cadastrar Case</h5>
										</div>
										<div class="modal-body">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group col-md-12">
														<div class="row">
															<div class="col-md-3">
																<label for="titulo">
																	<h6>Título:</h6>
																</label>
															</div>
															<div class="col-md-9">
																<input type="text" class="form-control" placeholder="Título" name="titulo" id="titulo">
															</div>
														</div>
													</div>
													
													
													<div class="form-group col-md-12">
														<div class="row">
															<div class="col-md-12">
																<textarea class="form-control" name="texto" id="texto" rows="10">Texto...</textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-primary">Cadastrar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Fim Modal -->
						<!-- Lista -->
						<hr>
						<div class="lista">
							<div class="list-group">
							<?php foreach($cases as $case) { ?>
								<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
									<div class="d-flex w-100 justify-content-between">
										<h5 class="mb-1"><?= $case->titulo?></h5>
									</div>
									<p class="mb-1"><?= $case->texto?></p>
									<small class="text-muted"><?= $case->id_usuario?></small>
								</a>
							<?php }  ?>
							</div>
						</div>
						<!-- Fim Lista -->
						<!-- Paginação -->
						<nav aria-label="Nevagação">
							<ul class="pagination justify-content-center">
								<li class="page-item">
									<a class="page-link" href="#" aria-label="Anterior">
										<span aria-hidden="true">&laquo;</span>
										<span class="sr-only">Antetior</span>
									</a>
								</li>
								<li class="page-item active">
									<a class="page-link" href="#">1</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#">2</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#">3</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#" aria-label="Próximo">
										<span aria-hidden="true">&raquo;</span>
										<span class="sr-only">Próximo</span>
									</a>
								</li>
							</ul>
						</nav>
						<!-- Fim Paginação -->
					</div>
				</div>
			</div>

			<div class="caixaPadrao conteudoMeio equalizadorEmpresa">

				<div class="conteudo">

					<form action="">
						<h3>Ranking</h3>
						<br>
						<div class="row">
							<div class="col-12 col-sm-4">
								<label for="selectProfissao">Tipo de profissional:</label>
								<div id="div_subarea" >
								<select onchange="carregarSubAreas(this.value);" class="form-control custom-select" id="selectProfissao">
								<div id="subAreas" >
									<?php foreach($ramos as $ramo) {?>
										<option value="<?=$ramo->id?>"><?=$ramo->nome?></option>
									<?php } ?>
									</div>
								</select>
								</div>
							</div>
							<div class="col-12 col-sm-4">
								<label for="selectPerfil">Perfil desejado:</label>
								<select class="form-control custom-select" id="selectPerfil">
									<option value="1">Analítico</option>
									<option value="2">Criativo</option>
									<option value="3">Operacional</option>
									<option value="4">Relacional</option>
								</select>
							</div>
							<div class="col-12 col-sm-4">
								<label for="selectQtd">Quantidade de resultados:</label>
								<select class="form-control custom-select" id="selectQtd">
									<option value="5">5</option>
									<option value="15">15</option>
									<option value="30">30</option>
								</select>
							</div>
						</div>

						<br>

						<div class="row">
							<div class="col-12 col-sm-8">
								<label>Local:</label>
								<div id="externo" >
								<select  onchange="carregarMunicipios(this.value);" class="form-control custom-select" id="selectEstado">
								
									<option value="0">Selecione um Estado</option>
									<option value="SP">São Paulo</option>
									<option value="RO">Rondônia</option>
									<option value="AP">Amapá</option>
									<option value="AM">Amazonas</option>
									<option value="PA">Pará</option>
									<option value="RR">Roraima </option>
									<option value="TO">Tocantins</option>
									<option value="AL">Alagoas</option>
									<option value="BH">Bahia</option>
									<option value="CE">Ceará</option>
									<option value="PB">Paraíba</option>
									<option value="PE">Pernambuco</option>
									<option value="PI">Piauí</option>
									<option value="RN">Rio Grande do Norte</option>
									<option value="SE">Sergipe</option>
									<option value="GO">Goiás</option>
									<option value="MT">Mato Grosso</option>
									<option value="MS">Mato Grosso do Sul</option>
									<option value="DF">Distrito Federal</option>
									<option value="ES">Espírito Santo</option>
									<option value="MG">Minas Gerais</option>
									<option value="RJ">Rio de Janeiro</option>
									<option value="PR">Paraná</option>
									<option value="RS">Rio Grande do Sul</option>
									<option value="SC">Santa Catarina</option>
									<option value="MA">Maranhão</option>
									<option value="AC">Acre</option>
									
								</select>
								</div>

								<label>ou a distancia em km</label>
								<input type="number" value="0" style="background:#fff" class="form-control custom-select" id="selectRaio">
							</div>
							<div class="col-12 col-sm-4">

								<button type="button" id="btnRanking" class="btn btn-primary btn-block text-uppercase customizarRanking btRanking">
									Rankear
								</button>

								<button type="button" class="btn btn-info btn-block text-uppercase customizarRanking" data-toggle="modal" data-target="#modalCustomizarRanking">
									Customizar Ranking
								</button>

								<!-- modal -->
								<div class="modal fade" id="modalCustomizarRanking" tabindex="-1" role="dialog" aria-labelledby="customizarRanking" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title text-uppercase" id="customizarRanking">customizar ranking</h5>
											</div>
											<div class="modal-body" id="areaDeRange">

												<div class="row itemRange">
													<div class="col-12 col-sm-3">
														Escolaridade
													</div>
													<div class="col-12 col-sm-9">
														<input type="text" name="escolaridade" data-provide="slider" data-slider-min="1" data-slider-max="10" data-slider-step="1"
														  data-slider-value="3">
													</div>
												</div>

												<div class="row itemRange">
													<div class="col-12 col-sm-3">
														Idiomas
													</div>
													<div class="col-12 col-sm-9">
														<input type="text" name="idiomas" data-provide="slider" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="7">
													</div>
												</div>

												<div class="row itemRange">
													<div class="col-12 col-sm-3">
														Informática
													</div>
													<div class="col-12 col-sm-9">
														<input type="text" name="informatica" data-provide="slider" data-slider-min="1" data-slider-max="10" data-slider-step="1"
														  data-slider-value="9">
													</div>
												</div>

												<div class="row itemRange">
													<div class="col-12 col-sm-3">
														Trabalho no Exterior
													</div>
													<div class="col-12 col-sm-9">
														<input type="text" name="trabalhoExt" data-provide="slider" data-slider-min="1" data-slider-max="10" data-slider-step="1"
														  data-slider-value="1">
													</div>
												</div>

												<div class="row itemRange">
													<div class="col-12 col-sm-3">
														Experiência Profissional
													</div>
													<div class="col-12 col-sm-9">
														<input type="text" name="expProf" data-provide="slider" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5">
													</div>
												</div>

											</div>
											<div class="modal-body addVar">
												<div class="form-group row">
													<label for="inputNewVariavel" class="col-12 col-sm-2 col-form-label" style="line-height: 1.8;">Nova Variável</label>
													<div class="col-12 col-sm-8">
														<input type="text" class="form-control" id="inputNewVariavel">
													</div>
													<div class="col-12 col-sm-2">
														<button type="button" class="btn btn-secondary btn-block" data-target="#criar-variavel-modal" data-toggle="modal" onclick="goModal()">Adicionar</button>
													</div>
												</div>
											</div>
											<div class="modal-footer flex-column flex-sm-row">
												<button type="button" class="btn btn-warning btRanking mr-auto">Enviar aos Candidatos</button>

												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" class="btn btn-primary btRanking" data-dismiss="modal">Rankear Novamente</button>
											</div>
										</div>
									</div>
								</div>
								<!-- modal -->
							</div>
						</div>
					</form>

					<div id="resultadoRanking">
                        
                        <!-- \ -->
                        
                        <!-- <div class="d-flex flex-row item">
                            <div class="foto">
                                <img src="img/avatar-ranking2.png" alt="Avatar Ranking">
                            </div>
                            <div class="infor relative">
                                <a href="#verPerfil" class="btVerPerfil text-uppercase btn btn-sm caixaBordaVerde">Ver Perfil</a>
                                <h3 class="nome">Letícia Hansen</h3>
                                <small>Ingressou: 20 de Fevereiro de 2017</small>
                                <p>Vitae ex a leo ultrices porta. Mauris scelerisque imperdiet nisi non ultrices. In sit amet ornare dolor, at vehicula purus. Phasellus quis porta tellus. Sed dictum auctor lorem, ac gravida sem varius eu. Maecenas viverra dolor at nulla luctus, eu interdum eros sodales. In vitae sapien aliquam, imperdiet dui. </p>
                            </div>
                        </div> -->

                    </div>
					
				</div>
			</div>
		</div>
	</div>
</div>
<iframe name="hiddenFrame" style="position:absolute; top:-1px; left:-1px; width:1px; height:1px;"></iframe>
<div class="modal fade" id="criar-variavel-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form id="criarFormulario" action="<?=base_url()?>admin/formulario/criarFormulario2" method="post" target="hiddenFrame">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Adicionar Variável</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12" id="painel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h3 class="panel-title">
												<strong>Título</strong>
											</h3>
										</div>
										<div class="panel-body">
											<input type="text" class="form-control" id="titulo-variavel" name="titulo">
											<input id="meuIndice" name="meuIndice" type="hidden" value="0">
										</div>
									</div>
								</div>
							</div>
							<div style="display: none" id="meuCampoRaiz">
								<div class="row meuCampo" style="margin-top: 25px">
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">
													<strong class="campo_numero">Questão Nº$</strong>
												</h3>
											</div>
											<div class="panel-body">
												<div class="row form-group">
													<div class="col-md-2">
														<label for="campo_titulo_$">Título:</label>
													</div>
													<div class="col-md-10">
														<input type="text" class="form-control campo_titulo" id="campo_titulo_$" name="campo_titulo_$">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-2">
														<label for="campo_select_$">Tipo:</label>
													</div>
													<div class="col-md-4">
														<select class="form-control campo_select" name="campo_select_$" id="campo_select_$">
															<option value="selecionar">Selecionar</option>
															<option value="escolher">Escolher</option>
														</select>
													</div>
													<div class="col-md-2">
														<label for="campo_opcoes_$">Opções:</label>
													</div>
													<div class="col-md-4">
														<input type="text" class="form-control campo_opcoes" id="campo_opcoes_$" name="campo_opcoes_$">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-2">
														<label for="campo_analitico_$">Analítico:</label>
													</div>
													<div class="col-md-4">
														<input type="number" max="5" min="0" step="0.1" class="form-control campo_analitico" id="campo_analitico_$" name="campo_analitico_$">
													</div>
													<div class="col-md-2">
														<label for="campo_criativo_$">Criativo:</label>
													</div>
													<div class="col-md-4">
														<input type="number" max="5" min="0" step="0.1" class="form-control campo_criativo" id="campo_criativo_$" name="campo_criativo_$">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-2">
														<label for="campo_operacional_$">Operacional:</label>
													</div>
													<div class="col-md-4">
														<input type="number" max="5" min="0" step="0.1" class="form-control campo_operacional" id="campo_operacional_$" name="campo_operacional_$">
													</div>
													<div class="col-md-2">
														<label for="campo_relacional_$">Relacional:</label>
													</div>
													<div class="col-md-4">
														<input type="number" max="5" min="0" step="0.1" class="form-control campo_relacional" id="campo_relacional_$" name="campo_relacional_$">
													</div>
												</div>
												<input class="campo_indice" type="hidden" value="$">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 75px;">
						<div class="col-md-12 text-center">
							<a class="btn btn-success" onClick="adicionarCampo()">Adicionar Questão</a>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary" onclick="add()">Adicionar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>

									
  

	function carregarSubAreas(id_pai) {
        console.log("1");
        console.log(id_pai);
        $.ajax({
            url: '<?=base_url()?>formulario/getSubAreas',
            type: 'POST',
            dataType: 'json',
            data: {
                id_pai: id_pai
            },
            beforeSend: function() {
            },
            success: function(response){
                $("select[name=sub_div]").remove();
                $("#div_subarea").append("<select style='display: block; margin-top: 10px;' class='form-control custom-select' name='sub_div'></select>");
                console.log(response);
                $.each(response, function(index, value) {
                    $("select[name=sub_div]").append("<option value='"+value.id+"'>"+value.nome+"</option>");
                });
            },
            error: function(event){
                console.log(event);
            }
        });
    }
	function carregarMunicipios(id_pai) {
        console.log("1");
        console.log(id_pai);
        $.ajax({
            url: '<?=base_url()?>Empresa/carregarMunicipios',
            type: 'POST',
            dataType: 'json',
            data: {
                id_pai: id_pai
            },
            beforeSend: function() {
            },
            success: function(response){
                $("select[name=sub_div_muni]").remove();
                $("#externo").append("<select style='display: block; margin-top: 10px;' class='form-control custom-select' name='sub_div_muni'></select>");
                console.log(response);
                $.each(response, function(index, value) {
                    $("select[name=sub_div_muni]").append("<option value='"+value.city+"'>"+value.city+"</option>");
                });
            },
            error: function(event){
                console.log(event);
            }
        });
    }

	function adicionarCampo() {
		$(".meuCampo").eq(0).clone().appendTo("#painel-body");
		$("#meuIndice").val(parseInt($("#meuIndice").val(), 10) + 1);

		var indice = parseInt($("#meuIndice").val(), 10);

		var novoCampo = $("#painel-body").children().last();

		novoCampo.find("strong.campo_numero").html("Questão Nº" + indice);

		novoCampo.find("input.campo_titulo").attr("id", "campo_titulo_" + indice);
		novoCampo.find("input.campo_titulo").attr("name", "campo_titulo_" + indice);

		novoCampo.find("select.campo_select").attr("id", "campo_select_" + indice);
		novoCampo.find("select.campo_select").attr("name", "campo_select_" + indice);

		novoCampo.find("input.campo_opcoes").attr("id", "campo_opcoes_" + indice);
		novoCampo.find("input.campo_opcoes").attr("name", "campo_opcoes_" + indice);

		novoCampo.find("input.campo_analitico").attr("id", "campo_analitico_" + indice);
		novoCampo.find("input.campo_analitico").attr("name", "campo_analitico_" + indice);

		novoCampo.find("input.campo_criativo").attr("id", "campo_criativo_" + indice);
		novoCampo.find("input.campo_criativo").attr("name", "campo_criativo_" + indice);

		novoCampo.find("input.campo_operacional").attr("id", "campo_operacional_" + indice);
		novoCampo.find("input.campo_operacional").attr("name", "campo_operacional_" + indice);

		novoCampo.find("input.campo_relacional").attr("id", "campo_relacional_" + indice);
		novoCampo.find("input.campo_relacional").attr("name", "campo_relacional_" + indice);

		novoCampo.find("input.campo_indice").attr("name", "campo_indice_" + indice);
		novoCampo.find("input.campo_indice").val(indice);

		loadScript("<?=js_url()?>actions.js");
	}

	function add() {
		$("#criar-variavel-modal").modal("hide");
		var nome = $("#titulo-variavel").val();
		$("#areaDeRange").empty();
		/*1*/$("#areaDeRange").append("<div class='row itemRange'><div class='col-12 col-sm-3'>Escolaridade</div><div class='col-12 col-sm-9'><input type='text' name='escolaridade' data-provide='slider' data-slider-min='1' data-slider-max='10' data-slider-step='1' data-slider-value='5'></div></div>");
		/*2*/$("#areaDeRange").append("<div class='row itemRange'><div class='col-12 col-sm-3'>Idiomas</div><div class='col-12 col-sm-9'><input type='text' name='idiomas' data-provide='slider' data-slider-min='1' data-slider-max='10' data-slider-step='1' data-slider-value='5'></div></div>");
		/*3*/$("#areaDeRange").append("<div class='row itemRange'><div class='col-12 col-sm-3'>Informática</div><div class='col-12 col-sm-9'><input type='text' name='informatica' data-provide='slider' data-slider-min='1' data-slider-max='10' data-slider-step='1' data-slider-value='5'></div></div>");
		/*4*/$("#areaDeRange").append("<div class='row itemRange'><div class='col-12 col-sm-3'>Trabalho no Exterior</div><div class='col-12 col-sm-9'><input type='text' name='trabalhoExt' data-provide='slider' data-slider-min='1' data-slider-max='10' data-slider-step='1' data-slider-value='5'></div></div>");
		/*5*/$("#areaDeRange").append("<div class='row itemRange'><div class='col-12 col-sm-3'>Experiência Profissional</div><div class='col-12 col-sm-9'><input type='text' name='expProf' data-provide='slider' data-slider-min='1' data-slider-max='10' data-slider-step='1' data-slider-value='5'></div></div>");
		$("#areaDeRange").append("<div class='row itemRange'><div class='col-12 col-sm-3'>"+nome+"</div><div class='col-12 col-sm-9'><input type='text' name='"+nome+"' data-provide='slider' data-slider-min='1' data-slider-max='10' data-slider-step='1' data-slider-value='5'></div></div>");
		loadScript("<?=js_url()?>bootstrap-slider.min.js");
	}

	function goModal() {
		$("#titulo-variavel").val($("#inputNewVariavel").val());
	}

	function loadScript(url) {
		var script = document.createElement('script'),
			done = false,
			head = document.getElementsByTagName("head")[0];
		script.src = url;
		script.onload = script.onreadystatechange = function () {
			if (!done && (!this.readyState || this.readyState == "loaded" || this.readyState == "complete")) {
				done = true;
				completeCallback();
				script.onload = script.onreadystatechange = null;
				head.removeChild(script);
			}
		};
		head.appendChild(script);
	}

	
</script>