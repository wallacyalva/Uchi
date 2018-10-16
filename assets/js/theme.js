jQuery(document).ready(function($){

	// Menu Mobile
	$('header.menuMobile .notificacoes div.item').click(function(){
		var itemAtual = $(this);
		itemAtual.toggleClass( 'aberto' );
		if( $('header.menuMobile .notificacoes div.item.aberto').length > 1 ){
			$('header.menuMobile .notificacoes div.item').each(function(){
				$(this).removeClass('aberto');
			});
			itemAtual.addClass( 'aberto' );
		};
	});

	// PerfectScrollbar - Desktop
	var cxcNotificacoes = new PerfectScrollbar('.caixa.notificacoes .conteudo');
	var cxcAmizades = new PerfectScrollbar('.caixa.amizades .conteudo');
	var cxcMensagens = new PerfectScrollbar('.caixa.mensagens .conteudo');
	// PerfectScrollbar - Mobile
	var cxcMobileNotificacoes = new PerfectScrollbar('header.menuMobile .cxc-notificacoes .conteudo');
	var cxcMobileAmizades = new PerfectScrollbar('header.menuMobile .cxc-amizades .conteudo');
	var cxcMobileMensagens = new PerfectScrollbar('header.menuMobile .cxc-mensagens .conteudo');

	// Notificações Amizades - OK
	$('header .itens .conteudo .lista .icones a').click(function(){
		var item = $(this).parents( "li" );
		item.css('background-color','#f2f2f2');
		item.addClass('finalizado').html("Feito!");
		console.log("Amizade respondida!");
		window.setTimeout(function() {
			item.fadeOut('slow');
		}, 2000);
	});

	// Limitar texto | Notificações | Chat
	$("header .limitText").each(function (i) {
        var text = $(this).text();
        var len = text.length;

        if (len > 80) {
        	var query = text.split(" ", 12);
                query.push('...');
                res = query.join(' ');
            $(this).text(res);
        }
    });

    // Limitar texto | Oportunidades TXT
	$(".oportunidades .limitText").each(function (i) {
        var text = $(this).text();
        var len = text.length;

        if (len > 100) {
        	var query = text.split(" ", 20);
                query.push('...');
                res = query.join(' ');
            $(this).text(res);
        }
    });

    // Manter altura padrão - Image Post
	var alturaPadrao = 0;
	$(".conteudoMeio .post img").each(function(){
	    var altura = $(this).height();
	    if( altura >= alturaPadrao ){
	        alturaPadrao = $(this).height();
	    };
	});
	$(".conteudoMeio .post img").height(alturaPadrao);

	// Abrir Opções de Post
	$('.conteudoMeio .post .opt .button').click(function(){
		$(this).toggleClass('aberto');
	});

});