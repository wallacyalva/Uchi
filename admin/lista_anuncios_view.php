<?php if($this->session->userdata("cidade") && $this->session->userdata("estado")){ if(isset($anuncios)){ ?>
<div class="panel-body" id="tab1">
    <div class="tab-content" style="padding-top: 50px;">
<?php foreach ($anuncios as $anuncio): ?>
        <div class="tab-pane active animated fadeInUp">
            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="listing-post" <?=$anuncio->plano_id == 1 ? "style='background-color: #fff5d7;'" : ""?>>
                    <div class="col-md-3 col-sm-12 col-xs-12 nopadding">
                        <div class="listing-image" style="overflow: hidden;">
                            <img src="<?= $anuncio->plano_id == 1 ?  base_url('uploads/images_profile') . "/" . $anuncio->picture : base_url('negocio/uploads/images/users') . "/no-image.jpg"; ?>"  class="img-responsive" alt="" style="max-width: none;height: 224px;width: auto;" /> </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="listing-desc">
                            <h3 class="listing-desc-title">
                                <a href="<?php echo base_url("anuncios/detalhes") . "/" . $anuncio->id . "/" . format_url($anuncio->name_company) ?>"><?php echo $anuncio->name_company; ?></a>
                            </h3>
                            <div class="listing-desc-category">
                                <ul>
                                    <li>
                                        <a href="#"><?php echo isset($anuncio->nome_cat) ? $anuncio->nome_cat : "teste"?></a>
                                    </li>
                                </ul>
                            </div>
                            <p><?php echo (strlen($anuncio->descricao) > 200) ? substr($anuncio->descricao, 0, 85)."..." : $anuncio->descricao;?></p>
                            <!-- <span class="listing-price">Price:
                                <span>$1800</span>
                            </span> -->
                            <span class="listing-desc-date">
                                <i class="fa fa-calendar"></i> <?php echo date("d/m/Y H:i:s", strtotime($anuncio->data)); ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 nopadding">
                        <div class="listing-info">
                            <span class="listing-address" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                <i class="fa fa-location-arrow"></i>
                                <?php echo $anuncio->city?> / <?php echo $anuncio->state?>
                            </span>
                            <span class="listing-phone" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                <i class="fa fa-phone"></i>
                                <?php echo $anuncio->phone?>
                            </span>
                            <span class="listing-email" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                <i class="fa fa-envelope"></i>
                                <?php echo $anuncio->email?>
                            </span>
                            <a href="<?= $anuncio->plano_id == 1 ? base_url('anuncios/detalhes') . "/" . $anuncio->id . "/" . format_url($anuncio->name_company) : "" ?>" data-toggle="<?= $anuncio->plano_id == 1 ? "" : "modal"?>" data-target="<?= $anuncio->plano_id == 1 ? "" : "#modalGratis"?>" class="btn btn-default btn-block"> Ver detalhes
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>    
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <div class="cleafix"></div>
        <?php } if((!isset($tem_empreendedor) OR !$tem_empreendedor) && $this->uri->segment(2) != "pesquisa" && (!isset($this->session->userdata("modal_view")) OR !$this->session->userdata("modal_view"))){?>
        <?php $this->session->userdata("modal_view", true);?>
            <p class="no-items text-center">Não há anuncios disponíveis para esta seleção.</p>
                <script>
                    $(document).ready(function(){
                        $("#myModal").modal("show");
                    });
                </script>
        <?php }}?>

<!-- Modal content-->
<div id="modalGratis" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Aviso</h4>
      </div>
      <div class="modal-body">
        <p>Esta empresa ainda não é um anunciante Premium, por isso apenas alguns dados estão disponiveis</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal" class="modal fade in" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Alerta</h4>
            </div>
            <div class="modal-body">
	            <div class="row">
                    <form class="fm1x" id="frmx" method="post" action="anuncios/pedidoParceria">
                        <div class="col-md-12 col-sm-12">
                            <p>Olá! Ainda não temos um parceiro na sua cidade. Temos uma ótima oportunidade de negócio pra você. Informe alguns dados sem compromisso e entraremos em contato, ou nos contate via Whatsapp (31) 99734-0404.</p>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="mdxnome">Seu nome </label>
                                <input type="text" class="form-control" name="nome" maxlength="200" id="mdxnome" placeholder="Seu nome">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="mdxtelefone">Seu telefone </label>
                                <input type="tel" class="form-control" name="telefone" maxlength="200" id="mdxtelefone" placeholder="Seu telefone">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="mdxcelular">Seu celular </label>
                                <input type="tel" class="form-control" name="celular" maxlength="200" id="mdxcelular" placeholder="Seu celular">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="mdxemail">Seu email </label>
                                <input type="text" class="form-control" name="email" maxlength="200" id="mdxemail" placeholder="Seu email">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="sbfrmx" type="submit" class="btn btn-default pull-right">Continuar</button>
                        </div>
                    </form>	
                </div>
            </div>
        </div>
    </div>
</div>