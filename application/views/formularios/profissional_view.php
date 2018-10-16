<div class="container">
    <div class="row">
        <?php $this->load->view("template/usuario_left_info_view"); ?>
        <div class="col-xs-12 col-lg-9 zeroPaddingRight">
            <div class="caixaPadrao conteudoMeio">
                <h3 class="text-center">Experiência Profissional</h3>
                <form id="area_automacao" action="<?=base_url()?>formulario/profissional" class="form-horizontal" method="post">
                    <ul>
                        <li>
                            <div class="form-control">
                                <h4>Área de Atuação:</h4>
                                <br>
                                <div class="form-group" id="div_subarea">
                               
                                    <select onchange="carregarSubAreas(this.value); carregarQuestionario(this.value);" name="areas">
                                        <?php foreach($areas as $area) { ?>
                                            <option value="<?=$area->id?>"><?=$area->nome?></option>
                                        <?php } ?>
                                        
                                    </select>
                                        <div id="div_subarea" >
                                    </div>
                                </div>
                            </div>
                                    <div id="popup_questionario" style=" display:none;top: 0px; bottom: 0px; left: 0px; right: 0px;">
                                        <div id="questionario"></div>
                                    </div>
                        </li>
                        <li>
                            <div class="form-control">
                                <h4>Disponibilidade para Viajar:</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="viajar" value="1" id="viajar_sim">
                                    <label for="viajar_sim">Sim</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="viajar" value="0" id="viajar_nao">
                                    <label for="viajar_nao">Não</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form-control">
                                <h4>Disponibilidade para mudar de localidade de moradia:</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="moradia" value="1" id="moradia_sim">
                                    <label for="moradia_sim">Sim</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="moradia" value="0" id="moradia_nao">
                                    <label for="moradia_nao">Não</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form-control">
                                <h4>Vínculo Profissional:</h4>
                                <br>
                                <select name="vinculo" class="form-control">
                                    <option value="1">Estagiário</option>
                                    <option value="2">Autônomo</option>
                                    <option value="3">Empresário</option>
                                    <option value="4">Empregado</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div class="form-control">
                                <h4>Atuação Profissional:</h4>
                                <br>
                                <select name="atuacao" class="form-control">
                                    <option value="1">Não Aplicável</option>
                                    <option value="2">Iniciante</option>
                                    <option value="3">Associado</option>
                                    <option value="4">Pleno Sênior</option>
                                    <option value="5">Diretor</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div class="form-control">
                                <h4>Experiência Internacional:</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="internacional" onChange="abrir_internacional('sim')" value="sim" id="internacional_sim">
                                    <label for="internacional_sim">Sim</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="internacional" onChange="abrir_internacional('nao')" value="nao" id="internacional_nao">
                                    <label for="internacional_nao">Não</label>
                                </div>
                                <div class="form-group grupo-internacional" style="display: none;">
                                    <h5>Pais</h5>
                                    <select name="pais">
                                        <option value="1">BR</option>
                                        <option value="2">EUA</option>
                                    </select>
                                    <h5>Funcoes</h5>
                                    <select name="funcao">
                                        <option value="1">empregado</option>
                                        <option value="2">estagiario</option>
                                    </select>
                                    <h5>Periodo</h5>
                                    <div class="form-group">
                                        <label for="date_de">De: </label>
                                        <input type="date" name="date_de" id="date_de">
                                    </div>
                                    <div class="form-group">
                                        <label for="date_ate">Até: </label>
                                        <input type="date" name="date_ate" id="date_ate">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="col-md-12" style="height: 30px;">
                        <button type="reset" class="btn btn-secondary pull-left">Limpar</button>
                        <button id='test' type="submit" class="btn btn-success pull-right">Enviar</button>
                    </div>
                </form>
            </div>
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
                $("#div_subarea").append("<select onchange='carregarQuestionario(this.value);' style='display: block; margin-top: 10px;' name='sub_div'></select>");
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
    function abrir_internacional(value) {
        if (value == "sim") {
            $("div.grupo-internacional").show();
        } else if (value == "nao") {
            $("div.grupo-internacional").hide();
        }
    }

    function carregarQuestionario(id_pai){
        $.ajax({
            url: '<?=base_url()?>formulario/getQuestionario',
            type: 'POST',
            dataType: 'json',
            data: {
                id_pai: id_pai
            },
            beforeSend: function() {
            },
            success: function(response){
            
                console.log(response);
                // var content = $.parseJSON(response);
                
                if (typeof response.error === "undefined") {
                    $("#questionario").html(response.html).fadeIn();
                    $("#popup_questionario").show();
                }
                
                
                
            },
            error: function(event){
                // console.log(event);
            }
        });
    }
</script>
