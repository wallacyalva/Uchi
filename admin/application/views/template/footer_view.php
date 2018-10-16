
            <!-- MESSAGE BOX-->
            <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span>  <strong>Sair</strong> ?</div>
                    <div class="mb-content">
                        <p>Você realmente deseja sair?</p>                    
                        <p>Pressione Não par acontinuar trabalhando. Pressione Sim para sair.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="<?=base_url(); ?>login/logout" class="btn btn-success btn-lg">Sim</a>
                            <button class="btn btn-default btn-lg mb-control-close">Não</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

    <!-- START PRELOADS -->
     <audio id="audio-alert" src="<?php echo base_url(); ?>audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="<?php echo base_url(); ?>audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                  
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/icheck/icheck.min.js'></script>        
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/scrolltotop/scrolltopcontrol.js"></script>
        
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/morris/morris.min.js"></script>       
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/bootstrap/bootstrap-datepicker.js'></script>                
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/owl/owl.carousel.min.js"></script>                 
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/bootstrap/bootstrap-file-input.js"></script>                 
        
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/noty/jquery.noty.js'></script>
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/noty/layouts/topCenter.js'></script>
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/noty/layouts/topLeft.js'></script>
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/noty/layouts/topRight.js'></script> 
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/noty/themes/default.js'></script>
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/jquery-validation/dist/jquery.validate.js'></script>
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/jquery-validation/dist/localization/messages_pt_BR.min.js'></script>
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/jquery-validation/dist/additional-methods.min.js'></script>
        <script type='text/javascript' src='<?php echo js_url(); ?>plugins/maskedinput/dist/jquery.maskedinput.min.js'></script>

        <!-- END THIS PAGE PLUGINS-->        

       
       <!-- UPLOUD PLUGINS-->   
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/cropper/cropper.min.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/form/jquery.form.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>demo_edit_profile.js"></script>
   
        <!-- START TEMPLATE -->
        <script type="text/javascript" src="<?php echo js_url(); ?>settings.js"></script>

        <script type="text/javascript" src="<?php echo js_url(); ?>plugins.js"></script>        
        <script type="text/javascript" src="<?php echo js_url(); ?>actions.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins/summernote/summernote.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>demo_dashboard.js"></script>
        <script type="text/javascript" src="<?php echo js_url(); ?>jquery.maskMoney.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
<!-- VALIDATION SCRIPTS -->
<?php
if($this->uri->segment(1)=="plano"){
?>
                <script type="text/javascript" src="<?php echo js_url(); ?>plano.js"></script>
<?php
}
?>
<?php
if($this->uri->segment(1)=="usuario"){
 echo '<script type="text/javascript" src="'.js_url().'usuario.js"></script>';
}
?>
<?php
if($this->uri->segment(1)=="promocao"){
?>
                <script type="text/javascript" src="<?php echo js_url(); ?>promocao.js"></script>
<?php
}
?>
<?php
if($this->uri->segment(1)=="cliente"){
?>
     <script type="text/javascript" src="<?php echo js_url(); ?>cropCapa.js"></script>
     <script type="text/javascript" src="<?php echo js_url(); ?>cliente.js"></script>
     <script type="text/javascript" src="<?php echo js_url(); ?>plugins/bootstrap/bootstrap-select.js"></script>

<?php
}
?>

<?php
if($this->uri->segment(1)=="banner"){
?>
 <script type="text/javascript" src="<?php echo js_url(); ?>plugins/bootstrap/bootstrap-select.js"></script>
 <script type="text/javascript" src="<?php echo js_url(); ?>cropBanner.js"></script>
<script type="text/javascript">
                $(function(){
    $('#estado').change(function(){
        if( $(this).val() ) {
        $('#cidades').hide();
        $('#carregando').show();
        $.post('<?=base_url(); ?>banner/cidades',{uf: $(this).val()}, function(j){
        var options = '';	
        for (var i = 0; i < j.length; i++) {
            options += '<option value="' + j[i].municipio + '">' + j[i].municipio + '</option>';
        }
        $('#cidades').html(options).show();
        $('#carregando').hide();
        }, 'json');
        } else {
        $('#cidades').html('<option value="">-- Escolha um estado --</option>');
        }
    });
});
                </script>
<?php
}
?>
<?php
if($this->uri->segment(1)=="relatorio"){
?>
 <script type="text/javascript" src="<?php echo js_url(); ?>plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript">
                $(function(){
    $('#estado').change(function(){
        if( $(this).val() ) {
        $('#cidades').hide();
        $('#carregando').show();
        $.post('<?=base_url(); ?>relatorio/cidades',{uf: $(this).val()}, function(j){
        var options = '';	
        for (var i = 0; i < j.length; i++) {
            options += '<option value="' + j[i].municipio + '">' + j[i].municipio + '</option>';
        }
        $('#cidades').html(options).show();
        $('#carregando').hide();
        }, 'json');
        } else {
        $('#cidades').html('<option value="">-- Escolha um estado --</option>');
        }
    });
});
                </script>
<?php
}
?>
<script type="text/javascript">
$('#cadFormCategoria :checkbox').change(function () {
    if ($(this).is(':checked')) {
        $('#categoriaid').fadeOut();
    } else {
        $('#categoriaid').fadeIn();
    }
});
</script>
<script type="text/javascript" >

function puxarSubCategorias() {

    var categorias = $("#categoria").val();
    
    $.ajax({
        url: '<?=base_url()?>' + 'cliente/getSubCategorias',
        type: 'POST',
        dataType: 'json',
        data: {
            categorias: categorias
        },
        beforeSend: function() {
           
        },
        success: function(response){
            $.each(response.subCategorias, function(index, value){
                $("#sub_categoria").append('<option value="' + value["id"] + '">' + value["descricao"] + '</option>');
                $("#sub_categoria").selectpicker("refresh");
            });
            $("#botao_sub").hide();
            $("#select_sub").show();
        },
        error: function(event){
            console.log(event);
        }
    });

}
$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#address").val("");
        $("#district").val("");
        $("#city").val("");
        $("#state").val("");
       // $("#ibge").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#zip_code").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#address").val("...");
                $("#district").val("...");
                $("#city").val("...");
                $("#state").val("...");
              //  $("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#address").val(dados.logradouro);
                        $("#district").val(dados.bairro);
                        $("#city").val(dados.localidade);
                        $("#state").val(dados.uf);
                      //  $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

</script>
<!-- END VALIDATION SCRIPTS -->        
    </body>
</html>


