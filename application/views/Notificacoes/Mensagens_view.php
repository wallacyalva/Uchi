
    <div class="container">
    <div class="row">
    <?php $this->load->view("template/usuario_left_info_view"); ?>
    <div class="col-xs-12 col-lg-9 zeroPaddingRight">
    <div class="caixaPadrao conteudoMeio">

        <div class="caixaPost">
            <ul class="lista">
            
            <?php foreach ($mensagens_todos as $msn) {?>
                <li value="" >
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
                <i class="fa fa-"></i>
                </li>
            <?php } ?>
            </ul>
                    <!-- <button type="submit" class="enviar botao float-right">Enviar</button>
                <textarea name="textoPost" id="textoPost" class="form-control" rows="3" placeholder="Fale alguma coisa.."></textarea>
            -->
            
        </div>

        <div class="conteudo">

                    
                    <!-- <div class="post">
                        <div class="opt">
                            <div class="button">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                            <div class="caixa">
                                <ul>
                                    <li><i class="fa fa-pencil" aria-hidden="true"></i> Editar</li>
                                    <li><i class="fa fa-times" aria-hidden="true"></i> Excluir</li>
                                </ul>
                            </div>
                        </div>
                        <div class="data">
                            <div class="linha fixa">02 . FEV . 2017</div>
                        </div>
                        <div class="post-txt">
                            <p>Suspendisse dolor turpis, imperdiet sit amet congue sed, ultricies sed risus. Pellentesque fringilla sapien in pharetra gravida. Donec lobortis risus vel tellus eleifend blandit. Pellentesque varius, nisl in dignissim commodo, purus orci ullamcorper leo, imperdiet dictum leo ligula ac lectus. Suspendisse et felis vel quam rhoncus venenatis id at ipsum.</p>
                            <p>Integer pretium efficitur sem, nec luctus mi interdum eu. Cras suscipit, nisi ac elementum congue, nulla dui lobortis libero, eu elementum lacus urna eget risus. In eget tincidunt tellus. Proin egestas arcu eu leo euismod ornare. In a quam non ligula dapibus convallis. Maecenas venenatis eu odio et lobortis. Suspendisse.</p>
                        </div>
                    </div> -->

                    <!-- <div class="post">
                        <div class="opt">
                            <div class="button">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                            <div class="caixa">
                                <ul>
                                    <li><i class="fa fa-pencil" aria-hidden="true"></i> Editar</li>
                                    <li><i class="fa fa-times" aria-hidden="true"></i> Excluir</li>
                                </ul>
                            </div>
                        </div>
                        <div class="data">
                            <div class="linha fixa">02 . FEV . 2017</div>
                        </div>
                        <div class="post-img">
                            <img src="post1.png" alt="Imagem">
                            <img src="post2.png" alt="Imagem">
                            <img src="post3.png" alt="Imagem">
                            <img src="post2.png" alt="Imagem">
                            <img src="post2.png" alt="Imagem">
                            <img src="post1.png" alt="Imagem">
                        </div>
                        <div class="post-txt">
                            <p>Pellentesque varius, nisl in dignissim commodo, purus orci ullamcorper leo, imperdiet dictum leo ligula ac lectus. Suspendisse et felis vel quam rhoncus venenatis id at ipsum.</p>
                        </div>
                    </div> -->
        

        </div>
    </div>
    </div>
    </div>
    </div>
