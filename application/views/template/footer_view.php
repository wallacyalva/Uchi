<?php if($this->session->userdata("is_user")) {?>
    <div class="container oportunidades">
        <div class="row">
            <div class="col-12 zeroPadding">
                <div class="caixaPadrao conteudo">
                    <div class="row">

                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="caixa">
                                <div class="titulo">Contrução de casa</div>
                                <div class="txt limitText">Etiam laoreet consequat quam egestas ornare. Curabitur euismod fringilla nibh eu vehicula. Proin nec magna quis leo viverra condimentum. Aliquam.</div>
                                <div class="infor">
                                    <span class="cidade">São Paulo - SP</span> | <span class="valor">R$ 10.000,00</span>
                                </div>
                                <div class="button">
                                    Saber Mais
                                    <a href="#linkOportunidade"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="caixa">
                                <div class="titulo">Apartamento</div>
                                <div class="txt limitText">Vivamus ac nisi consectetur, ultricies dui ut, consectetur dui.  ivamus sit amet mauris gravida, porttitor erat ut, pharetra nibh. Cras urna ipsum...</div>
                                <div class="infor">
                                    <span class="cidade">Rio de Janeiro - RJ</span> | <span class="valor">R$ 120.000,00</span>
                                </div>
                                <div class="button">
                                    Saber Mais
                                    <a href="#linkOportunidade"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="caixa">
                                <div class="titulo"><?=$this->session->userdata("cidade")?> / <?=$this->session->userdata("estado")?></div>
                                <div class="txt limitText">Praesent ut velit consequat, aliquam sapien non, cursus justo. Etiam feugiat luctus elit id dictum. Phasellus dignissim semper nunc, eu pretium</div>
                                <div class="infor">
                                    <span class="cidade">Fortaleza - CE</span> | <span class="valor">R$ 2.000.000,00</span>
                                </div>
                                <div class="button">
                                    Saber Mais
                                    <a href="#linkOportunidade"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="caixa">
                                <div class="titulo">Triplex</div>
                                <div class="txt limitText">Donec risus urna, consequat maximus quam sit amet, tempor maximus nisl. Morbi et dui lorem.</div>
                                <div class="infor">
                                    <span class="cidade">Olinda - PE</span> | <span class="valor">R$ 510.000,00</span>
                                </div>
                                <div class="button">
                                    Saber Mais
                                    <a href="#linkOportunidade"></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>        
            </div>
        </div>
    </div>
<?php } ?>

<footer>
    Rede UCHI - Todos os direitos reservados - 2017
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="<?=js_url()?>jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?=js_url()?>bootstrap.min.js"></script>

<script src="<?=js_url()?>perfect-scrollbar.js"></script>

<script src="<?=js_url()?>bootstrap-slider.min.js"></script>

<!-- JS Theme -->
<script src="<?=js_url()?>theme.js"></script>

<!-- UPLOUD PLUGINS-->   
<script type="text/javascript" src="<?php echo js_url(); ?>plugins/cropper/cropper.min.js"></script>
<script type="text/javascript" src="<?php echo js_url(); ?>plugins/form/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo js_url(); ?>demo_edit_profile.js"></script>

<script>
    <?php if(!$this->session->userdata("cidade") && !$this->session->userdata("estado")) {?>
        $(document).ready(function () {
            console.log("ready!");
            getLocation();
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            }
        }

        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + lng + "", function (json) {

                var cityName = json.results[0].address_components[3].long_name;
                var stateName = json.results[0].address_components[5].short_name;

                $("#here").html(cityName+" / "+stateName);
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>login/setLocation",
                    data: {
                        cidade: cityName,
                        estado: stateName
                    },
                    cache: false,
                    beforeSend: function (xhr) {

                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (response) {

                    }
                });
            });
        }
    <?php } ?>

    $("#user_image").on("click", function() {

        $("#cp_photo").click();

    });

    $("#button_foto").on("click", function() {

        $("#photos").click();

    });

   $("#btnRanking").on("click", function() {
        console.log('1');
        $.ajax({
            url: '<?=base_url()?>Empresa/getRankedUsers',
            type: 'POST',
            dataType: 'json',
            data: {
                    escolaridade: $("input[name='escolaridade']").val(),
                    idiomas: $("input[name='idiomas']").val(),
                    informatica: $("input[name='informatica']").val(),
                    exterior: $("input[name='trabalhoExt']").val(),
                    experiencia: $("input[name='expProf']").val(),
                sub_div: $("#sub_div").val(),
                selectEstado: $("#selectEstado").val(),
                selectPerfil : $("#selectPerfil").val(),
                selectQtd : $("#selectQtd").val(),
                sub_div_muni : $("select[name=sub_div_muni]").val()
            },
            beforeSend: function() {
            },
            success: function(response){
                console.log(response);
                $("#resultadoRanking").empty();
                $.each(response, function(index,element){
                $("#resultadoRanking").append("<div class='d-flex flex-row item'><div class='foto'><img src='https://bluedropsproducts.com/uchi/assets/images/" + element.avatar + "' alt='Avatar Ranking'></div><div class='infor relative' style='min-width: 75%;'><a href='https://bluedropsproducts.com/uchi/usuario/perfil/" + element.id + "' class='btVerPerfil text-uppercase btn btn-sm caixaBordaVerde'>Ver Perfil</a><h3 class='nome'>" + element.name + " " + element.surname + "</h3><small>Ingressou: " + element.created + "</small><p>" + element.aboutme + "</p></div></div>");
                });
                $("#resultadoRanking").show();
            },
            error: function(event){
                console.log(event);
            }
        });
        $("#resultadoRanking").show();
    });
</script>
</body>
</html>