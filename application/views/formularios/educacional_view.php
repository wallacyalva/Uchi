<div class="container">
    <div class="row">
        <?php $this->load->view("template/usuario_left_info_view"); ?>
        <div class="col-xs-12 col-lg-9 zeroPaddingRight">
            <div class="caixaPadrao conteudoMeio">
                <h3 class="text-center">Dimensão Educacional</h3>
                <form id="area_automacao" action="<?=base_url()?>formulario/geral" class="form-horizontal" method="post">
                    <ul>
                        <li>
                            <!-- 1 = FORMAÇÂO -->
                            <h4>Formação:</h4>
                            <div class="form-group" id="formacao_core">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <select class="form-control" id="select_formacao" onChange="formacaoChange()" style="margin-bottom: 1rem;">
                                                <?php foreach($formacoes as $formacao) { ?>
                                                <option value="<?=$formacao->id?>" class="<?=$formacao->sub == 1 ? " sub_true " : "sub_false " ?>">
                                                    <?=$formacao->nome?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button type="button" class="btn btn-success" onclick="formacaoConfirm()">Adicionar</button>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-9" style="display: none" id="formacao_sub_group">
                                    <h5>Instituição de Ensino:</h5>
                                    <select class="form-control" id="select_formacao_sub">
                                        <option value="1">Instiuição de Ensino 1</option>
                                        <option value="2">Instiuição de Ensino 2</option>
                                        <option value="3">Instiuição de Ensino 3</option>
                                        <option value="4">Instiuição de Ensino 4</option>
                                        <option value="5">Instiuição de Ensino 5</option>
                                    </select>
                                </div>

                                <div class="col-md-12 formacao_container" style="display: none;margin-bottom: 1rem;">
                                    <div class="row">
                                        <div class="col-md-9 form-control bg-light">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="formacao_main" style="margin: 0;">
                                                        <!--FORMAÇÃO-->
                                                    </p>
                                                    <input type="hidden" id="formacao_main">
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="formacao_sub" style="margin: 0;">
                                                        <!--INSTITUIÇÃO-->
                                                    </p>
                                                    <input type="hidden" id="formacao_sub">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button type="button" class="btn btn-danger btn-condensed" onClick="removeInfo(this)">
                                                <span class="fa fa-times"></span> Excluir</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <!-- 2 = IDIOMAS -->
                            <h4>Idiomas:</h4>
                            <div class="form-group" id="idioma_core">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <select class="form-control" id="select_idioma" onChange="idiomaChange()" style="margin-bottom: 1rem;">
                                                <?php foreach($idiomas as $idioma) { ?>
                                                <option value="<?=$idioma->id?>" class="<?=$idioma->sub == 1 ? " sub_true " : "sub_false " ?>">
                                                    <?=$idioma->nome?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button type="button" class="btn btn-success" onclick="idiomaConfirm()">Adicionar</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-9" style="display: none" id="idioma_sub_group">
                                    <h5>lê:</h5>
                                    <select class="form-control" id="select_idioma_le">
                                        <option value="1">Básico</option>
                                        <option value="2">Mediano</option>
                                        <option value="3">Fluente</option>
                                    </select>
                                    <h5>Fala:</h5>
                                    <select class="form-control" id="select_idioma_fala">
                                        <option value="1">Básico</option>
                                        <option value="2">Mediano</option>
                                        <option value="3">Fluente</option>
                                    </select>
                                    <h5>Escreve:</h5>
                                    <select class="form-control" id="select_idioma_escreve">
                                        <option value="1">Básico</option>
                                        <option value="2">Mediano</option>
                                        <option value="3">Fluente</option>
                                    </select>
                                </div>

                                <div class="col-md-12 idioma_container" style="display: none;margin-bottom: 1rem;">
                                    <div class="row">
                                        <div class="col-md-9 form-control bg-light">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p class="idioma_main" style="margin: 0;">
                                                        <!-- IDIOMA -->
                                                    </p>
                                                    <input type="hidden" id="idioma_main">
                                                </div>
                                                <div class="col-md-3">
                                                    <p class="idioma_le" style="margin: 0;">
                                                        <!-- LEITURA -->
                                                    </p>
                                                    <input type="hidden" id="idioma_le">
                                                </div>
                                                <div class="col-md-3">
                                                    <p class="idioma_fala" style="margin: 0;">
                                                        <!-- FALA -->
                                                    </p>
                                                    <input type="hidden" id="idioma_fala">
                                                </div>
                                                <div class="col-md-3">
                                                    <p class="idioma_escreve" style="margin: 0;">
                                                        <!-- ESCRITA -->
                                                    </p>
                                                    <input type="hidden" id="idioma_escreve">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button type="button" class="btn btn-danger btn-condensed" onClick="removeInfo(this)">
                                                <span class="fa fa-times"></span> Excluir</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <!-- 3 = INFORMÁTICA -->
                            <h4>Conhecimentos em Informática:</h4>
                            <div class="form-group" id="informatica_core">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <select class="form-control" id="select_informatica" onChange="informaticaChange()" style="margin-bottom: 1rem;">
                                                <?php foreach($informaticas as $informatica) { ?>
                                                <option value="<?=$informatica->id?>" class="<?=$informatica->sub == 1 ? " sub_true " : "sub_false " ?>">
                                                    <?=$informatica->nome?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button type="button" class="btn btn-success" onclick="informaticaConfirm()">Adicionar</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-9" style="display: none" id="informatica_sub_group">
                                    <h5>Qual:</h5>
                                    <select class="form-control" id="select_informatica_sub">
                                    </select>
                                </div>

                                <div class="col-md-12 informatica_container" style="display: none;margin-bottom: 1rem;">
                                    <div class="row">
                                        <div class="col-md-9 form-control bg-light">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="informatica_main" style="margin: 0;">
                                                        <!-- CATEGOIA -->
                                                    </p>
                                                    <input type="hidden" id="informatica_main">
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="informatica_sub" style="margin: 0;">
                                                        <!-- SUB-CATEGORIA -->
                                                    </p>
                                                    <input type="hidden" id="informatica_sub">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button type="button" class="btn btn-danger btn-condensed" onClick="removeInfo(this)">
                                                <span class="fa fa-times"></span> Excluir</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <!-- 4 = PRODUÇÕES BIBLIOGRAFICAS -->
                            <h4>Produções Bibliográficas:</h4>
                            <div class="form-group" id="producao_core">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <select class="form-control" id="select_producao" onChange="producaoChange()" style="margin-bottom: 1rem;">
                                                <?php foreach($producoes as $producao) { ?>
                                                <option value="<?=$producao->id?>" class="<?=$producao->sub == 1 ? " sub_true " : "sub_false " ?>">
                                                    <?=$producao->nome?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button type="button" class="btn btn-success" onclick="producaoConfirm()">Adicionar</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-9" style="display: none" id="producao_sub_group">
                                    <h5>Qual:</h5>
                                    <input type="text" class="form-control" id="input_producao_sub">
                                </div>

                                <div class="col-md-12 producao_container" style="display: none;margin-bottom: 1rem;">
                                    <div class="row">
                                        <div class="col-md-9 form-control bg-light">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="producao_main" style="margin: 0;">
                                                        <!-- PRODUÇÃO -->
                                                    </p>
                                                    <input type="hidden" id="producao_main">
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="producao_sub" style="margin: 0;">
                                                        <!-- EXTRA -->
                                                    </p>
                                                    <input type="hidden" id="producao_sub">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button type="button" class="btn btn-danger btn-condensed" onClick="removeInfo(this)">
                                                <span class="fa fa-times"></span> Excluir</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li>
                            <!-- 5 = PREMIACOES E DISTINCOES -->
                            <h4>Premiações e Distinções:</h4>
                            <div class="form-group" id="premiacao_core">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <select class="form-control" id="select_premiacao" onChange="premiacaoChange()" style="margin-bottom: 1rem;">
                                                <?php foreach($premiacoes as $premiacao) { ?>
                                                <option value="<?=$premiacao->id?>" class="<?=$premiacao->sub == 1 ? " sub_true " : "sub_true " ?>">
                                                    <?=$premiacao->nome?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button type="button" class="btn btn-success" onclick="premiacaoConfirm()">Adicionar</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-9" style="display: none" id="primiacao_sub_group">
                                    <h5>Qual:</h5>
                                    <select class="form-control" id="select_premiacao_sub"></select>
                                </div>

                                <div class="col-md-12 premiacao_container" style="display: none;margin-bottom: 1rem;">
                                    <div class="row">
                                        <div class="col-md-9 form-control bg-light">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="premiacao_main" style="margin: 0;">
                                                        <!-- PRODUÇÃO -->
                                                    </p>
                                                    <input type="hidden" id="premiacao_main">
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="premiacao_sub" style="margin: 0;">
                                                        <!-- EXTRA -->
                                                    </p>
                                                    <input type="hidden" id="premiacao_sub">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button type="button" class="btn btn-danger btn-condensed" onClick="removeInfo(this)">
                                                <span class="fa fa-times"></span> Excluir</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>
                    </ul>
                    <div class="col-md-12" style="height: 30px;">
                        <button type="reset" class="btn btn-secondary pull-left">Limpar</button>
                        <button type="submit" class="btn btn-success pull-right">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // FORMAÇÂO
    function formacaoConfirm() {
        var count = $(".formacao_container").length;
        $("#formacao_core").prepend($(".formacao_container").last().clone());

        $("#formacao_main").eq(0).attr("name", "formacao_main_" + count);
        $("input[name='formacao_main_" + count + "']").eq(0).val($("#select_formacao").val());
        $("p[class='formacao_main']").eq(0).html($("#select_formacao option[value=" + $("#select_formacao").val() + "]")
            .text());

        if ($("#select_formacao option[value=" + $('#select_formacao').val() + "]").eq(0).hasClass("sub_true")) {
            $("#formacao_sub").eq(0).attr("name", "formacao_sub_" + count);
            $("input[name='formacao_sub_" + count + "']").eq(0).val($("#select_formacao_sub").val());
            $("p[class='formacao_sub']").eq(0).html($("#select_formacao_sub option[value=" + $('#select_formacao_sub').val() +
                "]").text());
        }
        $("#select_formacao").val($("#select_formacao option:first").val());
        $("#formacao_sub_group").hide();
        $(".formacao_container").eq(0).css("display", "block");
    }

    function formacaoChange() {
        $("#formacao_sub_group").hide();
        if ($("#select_formacao option[value=" + $('#select_formacao').val() + "]").eq(0).hasClass("sub_true")) {
            $("#formacao_sub_group").show();
        }
    }

    // IDIOMAS
    function idiomaConfirm() {
        var count = $(".idioma_container").length;
        $("#idioma_core").prepend($(".idioma_container").last().clone());

        $("#idioma_main").eq(0).attr("name", "idioma_main_" + count);
        $("input[name='idioma_main_" + count + "']").eq(0).val($("#select_idioma").val());
        $("p[class='idioma_main']").eq(0).html($("#select_idioma option[value=" + $("#select_idioma").val() + "]").text());

        if ($("#select_idioma option[value=" + $('#select_idioma').val() + "]").eq(0).hasClass("sub_true")) {
            $("#idioma_le").eq(0).attr("name", "idioma_le_" + count);
            $("input[name='idioma_le_" + count + "']").eq(0).val($("#select_idioma_le").val());
            $("p[class='idioma_le']").eq(0).html($("#select_idioma_le option[value=" + $("#select_idioma_le").val() +
                "]").text());

            $("#idioma_fala").eq(0).attr("name", "idioma_fala_" + count);
            $("input[name='idioma_fala_" + count + "']").eq(0).val($("#select_idioma_fala").val());
            $("p[class='idioma_fala']").eq(0).html($("#select_idioma_fala option[value=" + $("#select_idioma_fala").val() +
                "]").text());

            $("#idioma_escreve").eq(0).attr("name", "idioma_escreve_" + count);
            $("input[name='idioma_escreve_" + count + "']").eq(0).val($("#select_idioma_escreve").val());
            $("p[class='idioma_escreve']").eq(0).html($("#select_idioma_escreve option[value=" + $(
                "#select_idioma_escreve").val() + "]").text());
        }
        $("#select_idioma").val($("#select_idioma option:first").val());
        $("#idioma_sub_group").hide();
        $(".idioma_container").eq(0).css("display", "block");
    }

    function idiomaChange() {
        $("#idioma_sub_group").hide();
        if ($("#select_idioma option[value=" + $('#select_idioma').val() + "]").eq(0).hasClass("sub_true")) {
            $("#idioma_sub_group").show();
        }
    }

    // INFORMATICA
    function informaticaConfirm() {
        var count = $(".informatica_container").length;
        $("#informatica_core").prepend($(".informatica_container").last().clone());

        $("#informatica_main").eq(0).attr("name", "informatica_main_" + count);
        $("input[name='informatica_main_" + count + "']").eq(0).val($("#select_informatica").val());
        $("p[class='informatica_main']").eq(0).html($("#select_informatica option[value=" + $('#select_informatica').val() +
            "]").text());

        if ($("#select_informatica option[value=" + $('#select_informatica').val() + "]").eq(0).hasClass("sub_true")) {
            $("#informatica_sub").eq(0).attr("name", "informatica_sub_" + count);
            $("input[name='informatica_sub_" + count + "']").eq(0).val($("#select_informatica_sub").val());
            $("p[class='informatica_sub']").eq(0).html($("#select_informatica_sub option[value=" + $(
                '#select_informatica_sub').val() + "]").text());
        }
        $("#select_informatica").val($("#select_informatica option:first").val());
        $("#informatica_sub_group").hide();
        $(".informatica_container").eq(0).css("display", "block");
    }

    function informaticaChange() {
        $("#informatica_sub_group").hide();
        if ($("#select_informatica option[value=" + $('#select_informatica').val() + "]").eq(0).hasClass("sub_true")) {
            var pai = $("#select_informatica").val();
            $.ajax({
                url: '<?=base_url()?>formulario/subInformatica',
                type: 'POST',
                dataType: 'json',
                data: {
                    id_pai: pai
                },
                beforeSend: function () {
                    $("#select_informatica_sub").empty();
                },
                success: function (response) {
                    console.log(response);
                    $.each(response, function (index, value) {
                        $("#select_informatica_sub").append('<option value="' + value["id"] + '">' +
                            value["nome"] + '</option>');
                    });
                    $("#informatica_sub_group").show();
                },
                error: function (event) {
                    console.log(event);
                }
            });
        }
    }

    // PRODUÇÕES BIBLIOGRAFICAS
    function producaoConfirm() {
        var count = $(".producao_container").length;
        $("#producao_core").prepend($(".producao_container").last().clone());

        $("#producao_main").eq(0).attr("name", "producao_main_" + count);
        $("input[name='producao_main_" + count + "']").eq(0).val($("#select_producao").val());
        $("p[class='producao_main']").eq(0).html($("#select_producao option[value=" + $('#select_producao').val() + "]")
            .text());

        if ($("#select_producao option[value=" + $('#select_producao').val() + "]").eq(0).hasClass("sub_true")) {
            $("#producao_sub").eq(0).attr("name", "producao_sub_" + count);
            $("input[name='producao_sub_" + count + "']").eq(0).val($("#input_producao_sub").val());
            $("p[class='producao_sub']").eq(0).html($("#input_producao_sub").val());
        }
        $("#select_producao").val($("#select_producao option:first").val());
        $("#producao_sub_group").hide();
        $(".producao_container").eq(0).css("display", "block");
    }

    function producaoChange() {
        $("#producao_sub_group").hide();
        if ($("#select_producao option[value=" + $('#select_producao').val() + "]").eq(0).hasClass("sub_true")) {
            $("#producao_sub_group").show();
        }
    }

    // PREMIAÇOES
    function premiacaoConfirm() {
        var count = $(".premiacao_container").length;
        $("#premiacao_core").prepend($(".premiacao_container").last().clone());

        $("#premiacao_main").eq(0).attr("name", "premiacao_main_" + count);
        $("input[name='premiacao_main_" + count + "']").eq(0).val($("#select_premiacao").val());
        $("p[class='premiacao_main']").eq(0).html($("#select_premiacao option[value=" + $('#select_premiacao').val() +
            "]").text());

        if ($("#select_premiacao option[value=" + $('#select_premiacao').val() + "]").eq(0).hasClass("sub_true")) {
            $("#premiacao_sub").eq(0).attr("name", "premiacao_sub_" + count);
            $("input[name='premiacao_sub_" + count + "']").eq(0).val($("#select_premiacao_sub").val());
            $("p[class='premiacao_sub']").eq(0).html($("#select_premiacao_sub option[value=" + $(
                '#select_premiacao_sub').val() + "]").text());
        }
        $("#select_premiacao").val($("#select_premiacao option:first").val());
        $("#primiacao_sub_group").hide();
        $(".premiacao_container").eq(0).css("display", "block")
    }

    function premiacaoChange() {
        $("#primiacao_sub_group").hide();
        if ($("#select_premiacao option[value=" + $('#select_premiacao').val() + "]").eq(0).hasClass("sub_true")) {
            var pai = $("#select_premiacao").val();
            $.ajax({
                url: '<?=base_url()?>formulario/subPremiacao',
                type: 'POST',
                dataType: 'json',
                data: {
                    id_pai: pai
                },
                beforeSend: function () {
                    $("#select_premiacao_sub").empty();
                },
                success: function (response) {
                    console.log(response);
                    $.each(response, function (index, value) {
                        $("#select_premiacao_sub").append('<option value="' + value["id"] + '">' +
                            value["nome"] + '</option>');
                    });
                    $("#primiacao_sub_group").show();
                },
                error: function (event) {
                    console.log(event);
                }
            });
        }
    }

    function removeInfo(obj) {
        $(obj).parent().parent().parent().eq(0).remove();
    }
</script>