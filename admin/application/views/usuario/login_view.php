<div class="aviso-widget popup-fazer-login" style="display: none;">
    <button class="mfp-close" type="button" title="Fechar">×</button>
    <header class="section-header">
        <h1 class="section-header--title">Acessar minha conta</h1>
    </header>
    <div class="aviso-content">
        <div style="max-width: 600px; margin: 0 auto;"  id="login-form">
            <div class="form-group">
                <input type="email" placeholder="Email"  placeholder="Informe seu e-email" class="form-control input required-field" id="usuario_login" name="usuario_login" >
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" class="form-control input required-field" id="usuario_senha" name="usuario_senha">
            </div>
        </div>
    </div>
    <div class="aviso-footer">
        <div class="ajax-loader login-ajax-loader text-center" style="display: none;"><img src="<?php echo images_url() ?>ajax-loader.gif"></div>
        <div class="login-result error"></div>
        <input type="submit" value="Entrar" class="btn botao-fazer-login">
    </div>
</div>