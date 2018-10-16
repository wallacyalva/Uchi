<div class="page-container">
    <?php $this->load->view("template/left_menu_view", null); ?>
    <div class="page-content">    
        <?php $this->load->view("template/header_menu_view", null); ?>                       
        <ul class="breadcrumb">
            <li>
                <a href="<?=base_url()?>usuario">
                    Home
                </a>
            </li>                    
            <li class="active">
                <a href="<?=base_url()?>formulario/criarFormulario">
                    Criar Formulário
                </a>
            </li>
        </ul>     
        <div class="page-title">                    
            <h2>
                <span class="fa fa-user"></span> 
                Criar Formulário
            </h2>
        </div>
        <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    <form id="criarFormulario" action="<?=base_url()?>formulario/criarFormulario" method="post">
                        <div class="row">
                            <div class="col-md-12" id="painel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><strong>Título</strong></h3>
                                                <ul class="panel-controls">
                                                    <li>
                                                        <a class="panel-collapse">
                                                            <span href="#" class="fa fa-angle-down"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="panel-body">
                                                <input type="text" class="form-control" id="titulo" name="titulo">
                                                <input id="meuIndice" name="meuIndice" type="hidden" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: none;" id="meuCampoRaiz">
                                    <div class="row meuCampo">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><strong class="campo_numero">Questão Nº$</strong></h3>
                                                    <ul class="panel-controls">
                                                        <li>
                                                            <a class="panel-collapse">
                                                                <span href="#" class="fa fa-angle-down"></span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="panel-remove">
                                                                <span href="#" class="fa fa-times"></span>
                                                            </a>
                                                        </li>
                                                    </ul>
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
                            <div class="col-md-12" style="margin-bottom: 25px;">
                                <div class="col-md-4 text-center">
                                    <a class="btn btn-default">Limpar</a>
                                </div>   
                                <div class="col-md-4 text-center">
                                    <a class="btn btn-success" onClick="adicionarCampo()">Adicionar Questão</a>
                                </div>
                                <div class="cold-md-4 text-center">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>                                                   
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>                           
    </div>            
</div>
<script>
    function adicionarCampo() {
        $(".meuCampo").eq(0).clone().appendTo("#painel-body");
        $("#meuIndice").val(parseInt($("#meuIndice").val(), 10) + 1);
        
        var indice =  parseInt($("#meuIndice").val(), 10);

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

        loadScript("<?php echo js_url(); ?>actions.js");
    }

    function loadScript(url) {
        var script = document.createElement('script'), done = false, head = document.getElementsByTagName("head")[0];
        script.src = url;
        script.onload = script.onreadystatechange = function() {
            if ( !done && (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") ) {
                done = true;
                completeCallback();
                script.onload = script.onreadystatechange = null;
                head.removeChild( script );
            }
        };
        head.appendChild(script);
    }
</script>