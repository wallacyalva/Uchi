<div class="container">
    <div class="row">
        <?php $this->load->view("template/usuario_left_info_view"); ?>
        <div class="col-xs-12 col-lg-9 zeroPaddingRight">
            <div class="caixaPadrao conteudoMeio">
                <h3 class="text-center">Dimensão Comportamental</h3>
                <form id="area_automacao" action="<?=base_url()?>formulario/comportamental" class="form-horizontal" method="post">
                    <ul>
                        <li>
                            <!-- 1 -->
                            <div class="form-control">
                                <h4>Eu sou...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="1" id="1_1" value="I">
                                    <label for="1_1"> Idealista, Criativo e Visionário.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="1" id="1_2" value="C">
                                    <label for="1_2"> Divertido, Espirituoso e Benéfico.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="1" id="1_3" value="O">
                                    <label for="1_3"> Confiável, Meticuloso e Previsível.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="1" id="1_4" value="A">
                                    <label for="1_4"> Focado, Determinado e Persistente.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 2 -->
                            <div class="form-control">
                                <h4>Eu gosto de...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="2" id="2_1" value="A">
                                    <label for="2_1"> Ser piloto.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="2" id="2_2" value="C">
                                    <label for="2_2"> Conversar com os passageiros.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="2" id="2_3" value="O">
                                    <label for="2_3"> Planejar a viagem.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="2" id="2_4" value="I">
                                    <label for="2_4"> Explorar novas rotas.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 3 -->
                            <div class="form-control">
                                <h4>Se você quiser se dar bem comigo...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="3" id="3_1" value="I">
                                    <label for="3_1"> Me dê liberdade.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="3" id="3_2" value="O">
                                    <label for="3_2"> Me deixe saber sua expectativa.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="3" id="3_3" value="A">
                                    <label for="3_3"> Lidere, siga ou saia do caminho.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="3" id="3_4" value="C">
                                    <label for="3_4"> Seja amigável, carinhoso e coompreensivo.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 4 -->
                            <div class="form-control">
                                <h4>Para se conseguir bons resultados é preciso...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="4" id="4_1" value="I">
                                    <label for="4_1"> Ter incertezas.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="4" id="4_2" value="O">
                                    <label for="4_2"> Controlar o essencial.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="4" id="4_3" value="C">
                                    <label for="4_3"> Diversão e celebração.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="4" id="4_4" value="A">
                                    <label for="4_4"> Planejar e receber recursos.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 5 -->
                            <div class="form-control">
                                <h4>Eu me divirto quando...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="5" id="5_1" value="A">
                                    <label for="5_1"> Estou me exercitando.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="5" id="5_2" value="I">
                                    <label for="5_2"> Tenho novidades.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="5" id="5_3" value="C">
                                    <label for="5_3"> Estou com os outros.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="5" id="5_4" value="O">
                                    <label for="5_4"> Determino as regras.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 6 -->
                            <div class="form-control">
                                <h4>Eu penso que...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="6" id="6_1" value="C">
                                    <label for="6_1"> Unidos venceremos, divididos perderemos.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="6" id="6_2" value="A">
                                    <label for="6_2"> O ataque é melhor que a defesa.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="6" id="6_3" value="I">
                                    <label for="6_3"> É bom ser manso, mas andar com um porrete.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="6" id="6_4" value="O">
                                    <label for="6_4"> Um homem prevenido vale por dois.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 7 -->
                            <div class="form-control">
                                <h4>Minha preocupação é...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="7" id="7_1" value="I">
                                    <label for="7_1"> Geral, a idéia global.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="7" id="7_2" value="C">
                                    <label for="7_2"> Fazer com que as pessoas gostem.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="7" id="7_3" value="O">
                                    <label for="7_3"> Fazer com que funcione.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="7" id="7_4" value="A">
                                    <label for="7_4"> Fazer a tarefa.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 8 -->
                            <div class="form-control">
                                <h4>Eu prefiro...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="8" id="8_1" value="I">
                                    <label for="8_1"> Perguntas e respostas.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="8" id="8_2" value="O">
                                    <label for="8_2"> Ter todos os detalhes.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="8" id="8_3" value="A">
                                    <label for="8_3"> Vantagens a meu favor.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="8" id="8_4" value="C">
                                    <label for="8_4"> Que todos tenham a chance de serem ouvidos.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 9 -->
                            <div class="form-control">
                                <h4>Eu gosto de...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="9" id="9_1" value="A">
                                    <label for="9_1"> Fazer progresso.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="9" id="9_2" value="C">
                                    <label for="9_2"> Construir memórias.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="9" id="9_3" value="O">
                                    <label for="9_3"> Fazer sentido.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="9" id="9_4" value="I">
                                    <label for="9_4"> Tornar as pessoas confortáveis.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 10 -->
                            <div class="form-control">
                                <h4>Eu gosto de chegar...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="10" id="10_1" value="A">
                                    <label for="10_1"> Na frente.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="10" id="10_2" value="C">
                                    <label for="10_2"> Junto.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="10" id="10_3" value="O">
                                    <label for="10_3"> Na hora.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="10" id="10_4" value="I">
                                    <label for="10_4"> Em outro lugar.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 11 -->
                            <div class="form-control">
                                <h4>Um ótimo dia pra min é quando...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="11" id="11_1" value="A">
                                    <label for="11_1"> Consigo fazer muitas coisas.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="11" id="11_2" value="C">
                                    <label for="11_2"> Me divirto com os amigos.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="11" id="11_3" value="O">
                                    <label for="11_3"> Tudo segue conforme planejado.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="11" id="11_4" value="I">
                                    <label for="11_4"> Desfruto de coisas novas e estimulantes.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 12 -->
                            <div class="form-control">
                                <h4>Eu vejo a morte como...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="12" id="12_1" value="I">
                                    <label for="12_1"> Uma grande aventura misteriosa.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="12" id="12_2" value="C">
                                    <label for="12_2"> Oportunidade para rever os falecidos.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="12" id="12_3" value="O">
                                    <label for="12_3"> Um modo de receber recompensas.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="12" id="12_4" value="A">
                                    <label for="12_4"> Algo que sempre chega muito cedo.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 13 -->
                            <div class="form-control">
                                <h4>A minha filosofia de vida é...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="13" id="13_1" value="A">
                                    <label for="13_1"> Há ganhadores e perdedores,e eu acredito ser um ganhador.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="13" id="13_2" value="C">
                                    <label for="13_2"> Para eu ganhar, ninguém precisa perder.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="13" id="13_3" value="O">
                                    <label for="13_3"> Para ganhar é preciso seguir as regras.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="13" id="13_4" value="I">
                                    <label for="13_4"> Para ganhar, é preciso inventar novas regras.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 14 -->
                            <div class="form-control">
                                <h4>Eu sempre gostei de...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="14" id="14_1" value="I">
                                    <label for="14_1"> Explorar.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="14" id="14_2" value="O">
                                    <label for="14_2"> Evitar surpresas.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="14" id="14_3" value="A">
                                    <label for="14_3"> Focalizar a meta.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="14" id="14_4" value="C">
                                    <label for="14_4"> Realizar uma abordagem natural.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 15 -->
                            <div class="form-control">
                                <h4>Eu gosto de mudança se...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="15" id="15_1" value="A">
                                    <label for="15_1"> Me der uma vantagem competitiva.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="15" id="15_2" value="C">
                                    <label for="15_2"> For divertido e puder ser compartilhado.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="15" id="15_3" value="I">
                                    <label for="15_3"> Me der mais liberdade e variedade.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="15" id="15_4" value="O">
                                    <label for="15_4"> Melhorar ou me der mais controle.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 16 -->
                            <div class="form-control">
                                <h4>Não existe nada de errado em...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="16" id="16_1" value="A">
                                    <label for="16_1"> Se colocar na frente.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="16" id="16_2" value="C">
                                    <label for="16_2"> Colocar os outros na frente.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="16" id="16_3" value="I">
                                    <label for="16_3"> Mudar de idéia.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="16" id="16_4" value="O">
                                    <label for="16_4"> Ser consistente.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 17 -->
                            <div class="form-control">
                                <h4>Eu gosto de buscar conselhos de...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="17" id="17_1" value="A">
                                    <label for="17_1"> Pessoas bem sucedidas.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="17" id="17_2" value="C">
                                    <label for="17_2"> Anciões e conselheiros.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="17" id="17_3" value="O">
                                    <label for="17_3"> Autoridades no assunto.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="17" id="17_4" value="I">
                                    <label for="17_4"> Lugares, os mais estranhos.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 18 -->
                            <div class="form-control">
                                <h4>Meu lema é...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="18" id="18_1" value="I">
                                    <label for="18_1"> Fazer o que precisa ser feito.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="18" id="18_2" value="O">
                                    <label for="18_2"> Fazer bem feito.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="18" id="18_3" value="C">
                                    <label for="18_3"> Fazer junto com o grupo.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="18" id="18_4" value="A">
                                    <label for="18_4"> Simplesmente fazer.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 19 -->
                            <div class="form-control">
                                <h4>Eu gosto de...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="19" id="19_1" value="I">
                                    <label for="19_1"> Complexidade, mesmo se confuso.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="19" id="19_2" value="O">
                                    <label for="19_2"> Ordem e sistematização.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="19" id="19_3" value="C">
                                    <label for="19_3"> Calor humano e animação.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="19" id="19_4" value="A">
                                    <label for="19_4"> Coisas claras e simples.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 20 -->
                            <div class="form-control">
                                <h4>Tempo pra min é...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="20" id="20_1" value="A">
                                    <label for="20_1"> Algo que detesto disperdiçar.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="20" id="20_2" value="C">
                                    <label for="20_2"> Um grande ciclo.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="20" id="20_3" value="O">
                                    <label for="20_3"> Uma flexa que leva ao inaceitável.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="20" id="20_4" value="I">
                                    <label for="20_4"> Irrelevante.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 21 -->
                            <div class="form-control">
                                <h4>Se eu fosse bilionário...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="21" id="21_1" value="C">
                                    <label for="21_1"> Faria doações para muitas entidades.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="21" id="21_2" value="O">
                                    <label for="21_2"> Criaria uma poupança avantajada.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="21" id="21_3" value="I">
                                    <label for="21_3"> Faria o que desse na cabeça.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="21" id="21_4" value="A">
                                    <label for="21_4"> Exibiria bastante com algumas pessoas.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 22 -->
                            <div class="form-control">
                                <h4>Eu acredito que...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="22" id="22_1" value="A">
                                    <label for="22_1"> O destino é mais importante que a jornada.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="22" id="22_2" value="C">
                                    <label for="22_2"> A jornada é mais importante que o destino.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="22" id="22_3" value="O">
                                    <label for="22_3"> Um centavo economizado é um centavo ganho.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="22" id="22_4" value="I">
                                    <label for="22_4"> Basta um navio e uma estrela para navegar.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 23 -->
                            <div class="form-control">
                                <h4>Eu acredito também que...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="23" id="23_1" value="A">
                                    <label for="23_1"> Aquele que hesita está perdido.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="23" id="23_2" value="O">
                                    <label for="23_2"> De grão em grão a galinha enche o papo.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="23" id="23_3" value="C">
                                    <label for="23_3"> O que vai, volta.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="23" id="23_4" value="I">
                                    <label for="23_4"> Um sorriso ou uma careta é o mesmo pra quem é cego.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 24 -->
                            <div class="form-control">
                                <h4>Eu acredito ainda que...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="24" id="24_1" value="O">
                                    <label for="24_1"> é melhor prudência do que arrependimento.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="24" id="24_2" value="I">
                                    <label for="24_2"> A autoridade deve ser desafiada.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="24" id="24_3" value="A">
                                    <label for="24_3"> Ganhar é fundamental.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="24" id="24_4" value="C">
                                    <label for="24_4"> O coletivo é mais importante do que o individual.</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <!-- 25 -->
                            <div class="form-control">
                                <h4>Eu penso que...</h4>
                                <br>
                                <div class="form-group">
                                    <input type="radio" name="25" id="25_1" value="I">
                                    <label for="25_1"> Não é facil ficar encurralado.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="25" id="25_2" value="O">
                                    <label for="25_2"> É preciso olhar, antes de pular.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="25" id="25_3" value="C">
                                    <label for="25_3"> Duas cabeças pensam melhor do que uma.</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="25" id="25_4" value="A">
                                    <label for="25_4"> Se você não tem condições de competir, não compita.</label>
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