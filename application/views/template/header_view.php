<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rede UCHI</title>
    <!-- Fontes -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800');
    </style>

    <!-- Bootstrap -->
    <link href="<?=css_url()?>bootstrap.css" rel="stylesheet">
    
    <link href="<?=css_url()?>style.css" rel="stylesheet">

    <link rel="stylesheet" href="<?=css_url()?>font-awesome.min.css" >
    <link rel="stylesheet" href="<?=css_url()?>bootstrap-slider.min.css">
    <link rel="stylesheet" href="<?=css_url()?>cropper.css"/>
    
</head>
<body>

    <header class="d-none d-md-block menuNormal">
        <div class="container">
            <div class="row">
                <div class="col-2 logo">
                    <a href="<?=$this->session->userdata("is_user") ? base_url("usuario") : base_url("empresa")?>">
                        <img src="<?=images_url()?>logo.png" alt="Rede UCHI" class="d-none d-md-inline-block">
                    </a>
                </div>
                <div class="col-5">
                    <form action="<?= base_url () ?>usuario\Pesquisar" method="post">
                        <input type="text" name="pesquisaPrinc" class="pesquisaPrinc" placeholder="O que deseja pesquisar?">
                        <button type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
                <div class="col-5 d-flex justify-content-end itens">
                    <div class="notificacoes d-flex align-items-stretch justify-content-center">

                        <div class="item">
                            <img src="<?=images_url()?>GONG.png" alt="Notificações">
                            <div class="valor azul" <?php if(count($notificacoes)=='0'){ ?>style="display:none;"<?php  } ?> ><?php if(count($notificacoes)>'9'){print('+9');}else{print(count($notificacoes));}?></div>
                            <div class="caixa notificacoes" <?php if(count($notificacoes)=='0'){ ?>style="display:none;"<?php  } ?> >
                                <div class="title text-uppercase">
                                    <h6>Notificações</h6>
                                    <a href="<?=base_url()?>usuario/vizualizarNotificacaoTodas/<?= $user->id ?>/notificacoes">Marcar tudo como lido</a>
                                </div>
                                <div class="conteudo d-flex">
                                    <ul class="lista">
                                    <?php foreach($notificacoes as $not){ ?>

                                        <li>
                                            <!-- LINK PRINCIPAL -->
                                            <a href="<?=base_url()?>usuario/vizualizarNotificacao/<?=$not->id?>/<?= $not->id_notificando ?>"></a>
                                            <!-- ############## -->
                                            <div class="foto">
                                                <img src="<?=images_url()?><?= $not->avatar?>" style="height: 34px; width: 34px;" alt="avatar" >
                                            </div>
                                            <div class="evento">
                                                <p>
                                                <?= $not->txt_before?><span class="nome"><?= $not->name?></span><?= $not->txt_after?>
                                                </p>
                                                <small><?= $not->data_pedido?></small>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="btFim azul text-uppercase">
                                    Ver todos as notificações
                                    <a href="<?=base_url()?>usuario/todasNotificacoes/notificacoes"></a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <div class="valor vermelho" <?php if(count($pedidos)=='0'){ ?>style="display:none;"<?php  } ?> ><?php if(count($pedidos)>'9'){print('+9');}else{print(count($pedidos));}?></div>
                            
                            <div class="caixa amizades" <?php if(count($pedidos)=='0'){ ?>style="display:none;"<?php  } ?> >
                                <div class="title text-uppercase">
                                    <h6>Pedidos de Amizade</h6>
                                    <a href="#">Procurar Alguem</a>
                                </div>
                                <div class="conteudo d-flex">
                                    <ul class="lista">
                                       <?php foreach($pedidos as $ped){ ?>
                                        <li>
                                            <div class="foto">
                                                <img src="<?=images_url()?><?=$ped->avatar?>" style="height: 34px; width: 34px;"alt="avatar">
                                            </div>
                                            <div class="evento amizade">
                                                <a href="<?=base_url()?>usuario/perfil/<?=$ped->id_notificando?>"><span class="nome"> <?= $ped->name ?></span></a>
                                                <br>
                                                <span><?php if($ped->texto<'1'){print("Sem amigos em comum");}else{print($ped->texto); print(" amigos em comun");}?></span>
                                            </div>
                                            <div class="icones">
                                                <div>
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    <a href="<?=base_url()?>usuario/newAmigo/<?=$ped->id_notificando?>/1/<?=$ped->id?>" title="Sim"></a>
                                                </div>
                                                <div class="no">
                                                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                    <a href="<?=base_url()?>usuario/newAmigo/<?=$ped->id_notificando?>/2/<?=$ped->id?>" title="Não"></a>
                                                </div>
                                            </div>
                                        </li>
                                       <?php } ?>
                                      
                                    </ul>
                                </div>
                                <div class="btFim vermelho text-uppercase">
                                    Ver todos os eventos
                                    <a href="<?=base_url()?>usuario/todasNotificacoes/pedidos"></a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <div class="valor verde" <?php if(count($mensagens)=='0'){ ?>style="display:none;"<?php  } ?> ><?php if(count($mensagens)>'9'){print('+9');}else{print(count($mensagens));}?></div>
                            
                            <div class="caixa mensagens" <?php if(count($mensagens)=='0'){ ?>style="display:none;"<?php  } ?> >
                                <div class="title text-uppercase">
                                    <h6>Chat / Mensagens</h6>
                                    <a href="<?=base_url()?>usuario/vizualizarNotificacaoTodas/<?= $user->id ?>/mensagem">Marcar tudo como lido</a>
                                </div>
                                <div class="conteudo d-flex">
                                    <ul class="lista">

                                        <?php foreach($mensagens as $msn){ ?>
                                        <li value="" >
                                            <!-- LINK PRINCIPAL -->
                                            <a data-toggle="modal" data-target="#linkChat_<?=$msn->id?>"></a>
                                            <!-- ############## -->
                                            <div class="foto">
                                                <img src="<?=images_url()?><?=$msn->avatar?>" style="height: 34px; width: 34px;" alt="avatar">
                                            </div>
                                            <div class="evento">
                                                <p>
                                                    <span class="nome"><?= $msn->name ?></span>
                                                    <br>
                                                    <p class="mensagem limitText"><?=$msn->texto?></p>
                                                </p>
                                                <small><?=$msn->data_pedido ?></small>
                                            </div>
                                            <i class="fa fa-comments" aria-hidden="true"></i>
                                        </li>


                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="btFim verde text-uppercase">
                                    Ver todas as mensagens
                                    <a href="<?=base_url()?>usuario/todasNotificacoes/mensagem"></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="perfil">
                        <strong><?=$this->session->userdata("is_user") ? $user->name." ".$user->surname : $emp->name?></strong>
                        <br>
                        
                        <div class="icon">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </div>
                        <a href="<?=base_url("login/logout")?>"></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- mobile -->
    <header class="d-block d-md-none menuMobile">
        <div class="container">
            <div class="row">
                <div class="col-3 logo">
                    <img src="<?=images_url()?>logop.png" alt="Rede UCHI">
                </div>
                <div class="col-9 itens">
                    <div class="notificacoes d-flex align-items-stretch justify-content-end">

                        <div class="item item-notificacoes">
                            <img src="<?=images_url()?>GONG.png" alt="Notificações">
                            <div class="valor azul" <?php if(count($notificacoes)=='0'){ ?>style="display:none;"<?php  } ?> ><?php if(count($notificacoes)>'9'){print('+9');}else{print(count($notificacoes));}?></div>
                        </div>
                        <div class="item item-amizades">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <div class="valor vermelho" <?php if(count($pedidos)=='0'){ ?>style="display:none;"<?php  } ?> ><?php if(count($pedidos)>'9'){print('+9');}else{print(count($pedidos));}?></div>
                        </div>
                        <div class="item item-mensagens">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <div class="valor verde" <?php if(count($mensagens)=='0'){ ?>style="display:none;"<?php  } ?> ><?php if(count($mensagens)>'9'){print('+9');}else{print(count($mensagens));}?></div>
                        </div>
                        <div class="item item-procurar">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>

                        <div class="caixa cxc-notificacoes">
                            <div class="title text-uppercase">
                                <h6>Notificações</h6>
                                <a href="#">Marcar tudo como lido</a>
                                <a href="#">Opções</a>
                            </div>
                            <div class="conteudo d-flex">
                                <ul class="lista">

                                <?php foreach($notificacoes as $not){ ?>
                                    <li>
                                        <!-- LINK PRINCIPAL -->
                                        <a href="<?=base_url()?>usuario/vizualizarNotificacao/<?=$not->id?>"></a>
                                        <!-- ############## -->
                                        <div class="foto">
                                            <img src="<?=images_url()?><?= $not->avatar?>" style="height: 34px; width: 34px;" alt="avatar" >
                                        </div>
                                        <div class="evento">
                                            <p>
                                            <?= $not->txt_before?><span class="nome"><?= $not->name?></span><?= $not->txt_after?>
                                            </p>
                                            <small><?= $not->data_pedido?></small>
                                        </div>
                                    </li>
                                    <?php } ?>
                                
                                </ul>
                            </div>
                            <div class="btFim azul text-uppercase">
                                Ver todos as notificações
                                <a href="#notificacoes"></a>
                            </div>
                        </div>

                        <div class="caixa cxc-amizades">
                            <div class="title text-uppercase">
                                <h6>Pedidos de Amizade</h6>
                                <a href="#">Procurar Alguem</a>
                                <a href="#">Opções</a>
                            </div>
                            <div class="conteudo d-flex">
                                <ul class="lista">
                                <?php foreach($pedidos as $ped){ ?>
                                        <li>
                                            <div class="foto">
                                                <img src="<?=images_url()?><?=$ped->avatar?>" style="height: 34px; width: 34px;"alt="avatar">
                                            </div>
                                            <div class="evento amizade">
                                                <a href="<?=base_url()?>usuario/perfil/<?=$ped->id_notificando?>"><span class="nome"> <?= $ped->name ?></span></a>
                                                <br>
                                                <span><?php if($ped->texto<'1'){print("Sem amigos em comum");}else{print($ped->texto); print(" amigos em comun");}?></span>
                                            </div>
                                            <div class="icones">
                                                <div>
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    <a href="<?=base_url()?>usuario/newAmigo/<?=$ped->id_notificando?>/1/<?=$ped->id?>" title="Sim"></a>
                                                </div>
                                                <div class="no">
                                                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                    <a href="<?=base_url()?>usuario/newAmigo/<?=$ped->id_notificando?>/2/<?=$ped->id?>" title="Não"></a>
                                                </div>
                                            </div>
                                        </li>
                                       <?php } ?>
                                </ul>
                            </div>
                            <div class="btFim vermelho text-uppercase">
                                Ver todos os eventos
                                <a href="#amizades"></a>
                            </div>
                        </div>

                        <div class="caixa cxc-mensagens">
                            <div class="title text-uppercase">
                                <h6>Chat / Mensagens</h6>
                                <a href="#">Marcar tudo como lido</a>
                                <a href="#">Opções</a>
                            </div>
                            <div class="conteudo d-flex">
                                <ul class="lista">
                                <?php foreach($mensagens as $msn){ ?>
                                        <li>
                                            <!-- LINK PRINCIPAL -->
                                            <a href="#linkChat"></a>
                                            <!-- ############## -->
                                            <div class="foto">
                                                <img src="<?=images_url()?><?=$msn->avatar?>" style="height: 34px; width: 34px;" alt="avatar">
                                            </div>
                                            <div class="evento">
                                                <p>
                                                    <span class="nome"><?=$msn->name?></span>
                                                    <br>
                                                    <p class="mensagem limitText"><?=$msn->texto?></p>
                                                </p>
                                                <small><?=$msn->data_pedido ?></small>
                                            </div>
                                            <i class="fa fa-comments" aria-hidden="true"></i>
                                        </li>
                                        <?php } ?>
                                </ul>
                            </div>
                            <div class="btFim verde text-uppercase">
                                Ver todas as mensagens
                                <a href="#mensagens"></a>
                            </div>
                        </div>
                        <div class="caixa cxc-procurar">
                            <form action="#" method="post">
                                <input type="text" name="pesquisaPrinc" class="pesquisaPrinc" placeholder="O que deseja pesquisar?">
                                <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>

<!-- Responder mensagem -->
<?php foreach($mensagens as $msn){ ?>
  <div class="modal fade" id="linkChat_<?=$msn->id?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
              <h5 class="modal-title" id="ModalLabelMensagem">Responder Mensagem de <strong><?php print_r($msn->name) ?></strong>:</h5>
         </div>
            <form action="<?= base_url()?>usuario/enviarMensagem/<?= $msn->id_notificado?>/<?= $msn->id_notificando?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mensagem:</label>
                        <p class="form-control" rows="3"><?=$msn->texto?></p>
                    </div>
                    <div class="form-group">
                        <label>Resposta:</label>
                        <textarea class="form-control" name="mensagem" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="<?= base_url()?>usuario/"><button type="button" class="btn btn-secondary"><i class="fa fa-trash-o" ></i> Excluir</button></a>
                    <a href="<?= base_url()?>usuario/vizualizarNotificacao/<?=$msn->id?>/<?= $msn->id_notificado?>"><button type="button" class="btn btn-secondary"><i class="fa fa-eye" ></i> Vizualizar</button></a>
                    <a href="<?= base_url()?>usuario/vizualizarNotificacao/<?=$msn->id?>/<?= $msn->id_notificado?>"><button type="submit" class="btn btn-primary">Responder</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>
