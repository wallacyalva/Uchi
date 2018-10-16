<div class="container">
    <div class="row">
        <?php $this->load->view("template/usuario_left_info_view"); ?>
        <div class="col-xs-12 col-lg-9 zeroPaddingRight">
            <div class="caixaPadrao conteudoMeio">

                <div class="caixaPost">
                    <form id="formPost" action="usuario/criarPost" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <textarea name="textoPost" id="textoPost" class="form-control" rows="3" placeholder="Fale alguma coisa.."></textarea>

                            <input type="file" name="photos[]" id="photos" multiple style="display: none;">
                            <button id="button_foto" type="button" class="video botao float-left">
                                <i class="fa fa-camera" aria-hidden="true"></i> Foto 
                            </button>
                            <button id="button_videos" type="button" class="foto botao float-left">
                                <i class="fa fa-film" aria-hidden="true"></i> Vídeo
                            </button>
                            <button type="submit" class="enviar botao float-right">Enviar</button>
                        </div>
                    </form>
                </div>

                <div class="conteudo">

                    <?php
                        foreach($posts as $post) {
                    ?>
                        <div class="post">
                            <div class="opt">
                                <div id="button_opts" class="button">
                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                </div>
                                <div class="caixa" style="z-index: 1000;">
                                    <ul>
                                        <li onclick="editarPostModal(<?=$post->id?>)"><i class="fa fa-pencil float-left" aria-hidden="true"></i> Editar</li>
                                        <li onclick="alterarFixacao(<?=$post->id?>,<?=$post->fixo?>)"><i class="fa fa-map-pin float-left" aria-hidden="true"></i> <?=$post->fixo ? "Desfixar" : "Fixar"?></li>
                                        <li onclick="excluirPost(<?=$post->id?>)"><i class="fa fa-times float-left" aria-hidden="true"></i> Excluir</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="data">
                                <div class="linha <?=$post->fixo == 1 ? "fixa" : ""?>"><?php $data = new DateTime($post->created); echo $data->format('d/m/Y'); ?></div>
                            </div>

                            <?php if(isset($post->photos)) { 
                                $images = explode(',', $post->photos);
                            ?>
                                <div class="post-img">
                                    <?php foreach($images as $img) { ?>
                                        
                                        <img src="<?=images_url()?>posts/<?=$img?>">
                                        
                                    <?php } ?>
                                </div>
                            <?php } else if(isset($post->video)) { ?>
                                <div class="post-video">

                                </div>
                            <?php } ?>

                            <div class="post-txt">
                                <p><?=$post->text?></p>
                            </div>
                        </div>
                    <?php
                        }
                    ?>

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

                    <div class="anuncio">
                        <img src="<?=images_url()?>propaganda1.png" class="img-fluid" alt="Anuncio">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editarPost" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelEditar">Editar Post</h5>
            </div>
            <form action="usuario/editarPost" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <textarea id="editarPostText" class="form-control" name="texto" rows="3"></textarea>
                    </div>

                    <input id="editarPostId" type="hidden" name="id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function editarPostModal(id) {
        $.ajax({
            url: "https://bluedropsproducts.com/uchi/usuario/getPost",
            type: 'POST',
            dataType: 'json',
            data: {
                idPost: id
            },
            beforeSend: function() {
                $("#button_opts").attr("class","button");
            },
            success: function(response){
                console.log(response);
                $("#editarPostText").html(response.text);
                $("#editarPostId").val(id);
                $("#editarPost").modal("show");
            },
            error: function(event){
                console.log(event);
            }
        });
    }


    function excluirPost(id) {
        $.ajax({
            url: "https://bluedropsproducts.com/uchi/usuario/excluirPost",
            type: 'POST',
            dataType: 'json',
            data: {
                idPost: id
            },
            beforeSend: function() {
                $(".caixa").hide();
            },
            success: function(response){
                location.reload();
            },
            error: function(event){
                console.log(event);
            }
        });
    }


    function alterarFixacao(id_post, isFixed) {
        if(isFixed){
            $.ajax({
                url: "https://bluedropsproducts.com/uchi/usuario/desfixarPost",
                type: 'POST',
                dataType: 'json',
                data: {
                    id_post: id_post
                },
                beforeSend: function() {
                    $(".caixa").hide();
                },
                success: function(response){
                    location.reload();
                },
                error: function(event){
                    console.log(event);
                }
            });
        } else {
            $.ajax({
                url: "https://bluedropsproducts.com/uchi/usuario/fixarPost",
                type: 'POST',
                dataType: 'json',
                data: {
                    id_post: id_post
                },
                beforeSend: function() {
                    $(".caixa").hide();
                },
                success: function(response){
                    location.reload();
                },
                error: function(event){
                    console.log(event);
                }
            });
        }
    }
</script>