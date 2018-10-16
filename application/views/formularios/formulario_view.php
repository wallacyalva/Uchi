<div class="container">
    <div class="row" >
        <div class="col-md-12 zeroPadding">
            <div class="caixaPadrao conteudoMeio">

                <div class="registration-title">
                    <strong>Uchi</strong>
                </div>

                <div class="registration-subtitle"><?=$formulario->nome?></div>
                <p>
    
                <!-- <form id="area_automacao" action="<?=base_url();?>formulario/setRespostaFormularioGeral" class="form-horizontal" method="post"> -->
                    <div class="form-control">

                        <?php foreach($questoes as $questao) { ?>
                            
                            <?php if($questao->tipo == "escolher") { ?>
                                <?php $opts = explode(",", $questao->opcoes); ?>
                                <div class="form-group">
                                    <h4><?=$questao->titulo?></h4>
                                    <div class="btn-group">
                                        <input onclick="toggleButton(this,1,<?=$questao->id?>)" class="btn btn-success disabled" type="button" value="<?=$opts[0]?>">
                                        <input onclick="toggleButton(this,2,<?=$questao->id?>)" class="btn btn-danger disabled" type="button" value="<?=$opts[1]?>">
                                        <input type="hidden" name="resposta_<?=$questao->id?>" id="questao_indice_<?=$questao->indice?>" value="0">
                                        <!-- <input type="hidden" name="questao_indice_<?=$questao->indice?>" id="questao_indice_<?=$questao->indice?>" value="0"> -->
                                        <!-- <input style="display:none;" ="none" name="questao_id<?=$questao->id?>" id="<?=$questao->id?>" value="<?=$questao->id?>"> -->
                                    </div>
                                </div>

                            <?php } else if($questao->tipo == "selecionar") {?>
                                <?php $opts = explode(",", $questao->opcoes); ?>

                                <div class="form-group">
                                    <h4><?=$questao->titulo?></h4>
                                    <select name="resposta_<?=$questao->id?>" id="resposta_<?=$questao->id?>">
                                        <?php $cont = 1; ?>
                                        <?php foreach($opts as $opt) { ?>
                                            <option value="<?=$cont?>_<?=$questao->id?>"><?=$opt?></option>
                                            <?php $cont++; ?>
                                        <?php }?>
                                    </select>
                                </div>

                            <?php }?>
                        <?php } ?>
                
                    </div>
                    
                <!-- </form> -->
            </div>
        </div>                                                  
    </div>
</div>
<script>
    function toggleButton(button, which,id) {
        var btn_sim = $(button).parent().find('input[value=Sim]');
        var btn_nao = $(button).parent().find('input[value=Não]');
        var btn_hide = $(button).parent().find('input[type=hidden]');

        if(which == 1) {

            btn_sim.removeClass('disabled').addClass('active');
            btn_nao.removeClass('disabled').removeClass('active').addClass('disabled');
            btn_hide.val("1_"+id);

        } else if(which = 2){

            btn_sim.removeClass('disabled').removeClass('active').addClass('disabled');
            btn_nao.removeClass('disabled').addClass('active');
            btn_hide.val("2_"+id);

        }  
    }

    function toggleSelect(select, index, n) {

        for(var i = 1; i <= n; i++) {
            $(select).parent().find('#select_'+index+"_"+i).hide();
        }

        var which = $(select).val();
        $(select).parent().find('#select_'+index+"_"+which).show();

    }

    function toggleDiv(div, which) {
        if(which == 1) {
            $("#"+div).show();
        } else if(which == 2) {
            $("#"+div).hide();
        }
    }
</script>