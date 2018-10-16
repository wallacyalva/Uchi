<div class="col-xs-12 col-lg-3 zeroPadding">
    <div class="cxRanking">
        <div class="imgBackground" style="background: url(<?=images_url()?>backgroundProfissao.jpg);"></div>
        <div class="rankInfor">
            <div class="trofeu"><img src="<?=images_url()?>trofeu.png"></div>
            <p class="text-center posicao">Ranking: #20024</p>
            <p class="text-center categoria"><?=$usuario->ramo_nome?></p>
            <div class="barras">
                <div class="grupo">
                    <?php $max = max($usuario->analitico*4, $usuario->criativo*4, $usuario->operacional*4, $usuario->relacional*4); $diff = 90 - $max;?>
                    <div class="barra">
                        <div class="analitico" style="width: <?=($usuario->analitico*4)+$diff?>%;"><?php if(($usuario->analitico > $usuario->relacional) && ($usuario->analitico > $usuario->operacional) && ($usuario->analitico > $usuario->criativo)) { echo "<img src='".images_url()."destaque.png' class='destaque'>"; }?></div>
                    </div>
                    <div class="porcent"><?=$usuario->analitico*4?>%</div>
                </div>
                <div class="grupo">
                    <div class="barra">
                        <div class="criativo" style="width: <?=($usuario->criativo*4)+$diff?>%;"><?php if(($usuario->criativo > $usuario->relacional) && ($usuario->criativo > $usuario->operacional) && ($usuario->criativo > $usuario->analitico)) { echo "<img src='".images_url()."destaque.png' class='destaque'>"; }?></div>
                    </div>
                    <div class="porcent"><?=$usuario->criativo*4?>%</div>
                </div>
                <div class="grupo">
                    <div class="barra">
                        <div class="operacional" style="width: <?=($usuario->operacional*4)+$diff?>%;"><?php if(($usuario->operacional > $usuario->relacional) && ($usuario->operacional > $usuario->criativo) && ($usuario->operacional > $usuario->analitico)) { echo "<img src='".images_url()."destaque.png' class='destaque'>"; }?></div>
                    </div>
                    <div class="porcent"><?=$usuario->operacional*4?>%</div>
                </div>
                <div class="grupo">
                    <div class="barra">
                        <div class="relacional" style="width: <?=($usuario->relacional*4)+$diff?>%;"><?php if(($usuario->relacional > $usuario->operacional) && ($usuario->relacional > $usuario->criativo) && ($usuario->relacional > $usuario->analitico)) { echo "<img src='".images_url()."destaque.png' class='destaque'>"; }?></div>
                    </div>
                    <div class="porcent"><?=$usuario->relacional*4?>%</div>
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
            <a href="<?=base_url()?>formulario/educacional"></a>
        </div>
        <div class="profissional">
            Dimensão profissional
            <a href="<?=base_url()?>formulario/profissional"></a>
        </div>
        <div class="comportamental">
            Dimensão comportamental
            <a href="<?=base_url()?>formulario/comportamental"></a>
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