
var ajaxUriCidades = '<?=base_url(); ?>banner/cidades';
$(function(){
    $('#estado').change(function(){
        if( $(this).val() ) {
        $('#cidades').hide();
        $('#carregando').show();
        $.post(ajaxUri,{uf: $(this).val()}, function(j){
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