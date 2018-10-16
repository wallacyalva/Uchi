<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function root_url() {
//    $root = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $root = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
    $root.= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
    return $root;
}

function getDominio() {
    return $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
}

function getHostUrl($protocol = true) {
    if ($protocol) {
        return (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/";
    }
    return $_SERVER['HTTP_HOST'];
}

function uri_string_params() {
    $CI = & get_instance();
    if ($CI->input->get()) {
        return uri_string() . "?" . http_build_query($CI->input->get());
    }
    return uri_string();
}

//asset_url to css/ images/ and /js
function asset_url() {
    return site_url() . 'assets/';
}

function images_url($imageUrl = false) {
    return $imageUrl ? site_url() . 'assets/images/' . $imageUrl : site_url() . 'assets/images/';
}

function js_url() {
    return site_url() . 'assets/js/';
}

function css_url() {
    return site_url() . 'assets/css/';
}
function files_url($fileUrl = false) {
    return $fileUrl ? site_url() . 'assets/files/' . $fileUrl : site_url() . 'assets/files/';
}

function generateNewPassword() {
    $CaracteresAceitos = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $max = strlen($CaracteresAceitos) - 1;
    $password = null;
    for ($i = 0; $i < 8; $i++) {
        $password .= $CaracteresAceitos{mt_rand(0, $max)};
    }
    return $password;
}

function is_user_logged_in() {
    //get CI instance to get session
    $CI = & get_instance();
    if ($CI->session->userdata('is_logged_in')) {
        return true;
    } else {
        return false;
    }
}

function is_user_activated() {
    //get CI instance to get session
    $CI = & get_instance();
    if ($CI->session->userdata('is_user_activated')) {
        return true;
    } else {
        return false;
    }
}

function is_admin_logged_in() {
    //get CI instance to get session
    $CI = & get_instance();
    if ($CI->session->userdata('is_admin_logged_in')) {
        return true;
    } else {
        return false;
    }
}

function calculate_plan_price_difference($newPlan, $oldPlan) {
    return $newPlan->total_price - $oldPlan->total_price;
}

function getNumericValueOfString($valueString) {
    if (!is_numeric($valueString)) {
        if ($valueString[strlen($valueString) - 3] == "," || $valueString[strlen($valueString) - 2] == ",") {
            $source = array('.', ',');
            $replace = array('', '.');
            $valueString = (float) str_replace($source, $replace, $valueString);
        } else {
            if ((int) $valueString > 0) {
                if (strpos($valueString, ",") > 0 && strpos($valueString, ".") > 0) {
                    if (strpos($valueString, ",") > strpos($valueString, ".")) {
                        $source = array('.', ',');
                        $replace = array('', '.');
                        $valueString = (float) str_replace($source, $replace, $valueString);
                    } else {
                        $valueString = (float) str_replace(",", "", $valueString);
                    }
                } else {
                    $valueString = (float) str_replace(",", "", $valueString);
                }
            } else {
                if (strpos($valueString, ",") > 0 && strpos($valueString, ".") > 0) {
                    if (strpos($valueString, ",") > strpos($valueString, ".")) {
                        $source = array('.', ',');
                        $replace = array('', '.');
                        $valueString = (float) str_replace($source, $replace, $valueString);
                    } else {
                        $valueString = (float) str_replace(",", "", $valueString);
                    }
                } else {
                    $valueString = (float) str_replace(",", ".", $valueString);
                }
            }
        }
    } else {
        $valueString = (float) $valueString;
    }
    return number_format($valueString, 2, ".", "");
}

function getPageTitle() {
    $CI = & get_instance();
    $action = $CI->uri->segment(2);
    if (!$action || $action == "index") {
        $action = $CI->uri->segment(1);
        if (!$action) {
            $action = "Home";
        }
    }
    return ucwords(str_replace("_", " ", $action));
}

function getFileExtension($fileName) {
    return "." . pathinfo($fileName, PATHINFO_EXTENSION);
}

function format_url($url) {
//    //accepting specific chars
//    $str =preg_replace("![^a-z0-9)(]+!i", "-", $str);
//    //format url 
    $url = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $url));
    $url = str_replace(array("/", "\\", " ", ",", "#", "@", "!", "$", "%", "&", "+", "`", "'", "(", ")", "*", "[", "]", ">", "<", ",", ";"), "-", $url);
    $url = str_replace(array("=", ";", ":", "?"), "", $url);
    $url = str_replace(array("---", "--", "----"), "-", rawurlencode($url));
    return $url;
}

function formatMoney($valor) {
    $CI = & get_instance();
    $country = $CI->session->userdata("country");
    if (!$country) {
        $country = "BR";
    }
    if ($country == "BR") {
        return $valor = "R$ " . number_format(round($valor, 2), 2, ",", ".");
    } else {
        return $valor = "€ " . number_format(round($valor, 2), 2, ".", " ");
    }
}

function getSmallerSide($leftSide, $rightSide) {
    return $leftSide < $rightSide ? $leftSide : $rightSide;
}

function formatMysqlTime($mysql_time, $hms = false) {
    if ($hms) {
        return date("d/m/Y", strtotime($mysql_time));
    }
    return date("d/m/Y H:i:s", strtotime($mysql_time));
}

function removeAccents($string) {
    return preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $string));
}

function getMonths() {
    $CI = & get_instance();
    return array(
        "1" => $CI->lang->line("jan"),
        "2" => $CI->lang->line("feb"),
        "3" => $CI->lang->line("mar"),
        "4" => $CI->lang->line("apr"),
        "5" => $CI->lang->line("may"),
        "6" => $CI->lang->line("jun"),
        "7" => $CI->lang->line("jul"),
        "8" => $CI->lang->line("aug"),
        "9" => $CI->lang->line("sep"),
        "10" => $CI->lang->line("oct"),
        "11" => $CI->lang->line("nov"),
        "12" => $CI->lang->line("dec"),
    );
}

function shortString($string, $howshort) {

    if (strlen($string) > $howshort) {
        $string = substr($string, 0, $howshort - 3) . "...";
    }

    return $string;
}

function current_page_active($page) {
    $CI = & get_instance();
    $controller = $CI->uri->segment(1);
    $action = $CI->uri->segment(2);
    if (!$controller) {
        $controller = "login";
    }
    if (!$action) {
        $action = "index";
    }
    return ($page == "{$controller}/{$action}" ? 'class="current"' : "");
}

function is_current_page($page) {
    $CI = & get_instance();
    $controller = $CI->uri->segment(1);
    $action = $CI->uri->segment(2);
    if (!$controller) {
        $controller = "login";
    }
    if (!$action) {
        $action = "index";
    }
    return $page == "{$controller}/{$action}";
}

function getStatesArray() {
    return '<option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazônas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espirito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>';
}

function getBanksArray() {
    return '<option value="001">Banco do Brasil</option>
            <option value="003">Banco da Amazônia</option>
            <option value="004">Banco do Nordeste</option>
            <option value="021">Banestes</option>
            <option value="025">Banco Alfa</option>
            <option value="027">Besc</option>
            <option value="029">Banerj</option>
            <option value="031">Banco Beg</option>
            <option value="033">Banco Santander Banespa</option>
            <option value="036">Banco Bem</option>
            <option value="037">Banpará</option>
            <option value="038">Banestado</option>
            <option value="039">BEP</option>
            <option value="040">Banco Cargill</option>
            <option value="041">Banrisul</option>
            <option value="044">BVA</option>
            <option value="045">Banco Opportunity</option>
            <option value="047">Banese</option>
            <option value="062">Hipercard</option>
            <option value="063">Ibibank</option>
            <option value="065">Lemon Bank</option>
            <option value="066">Banco Morgan Stanley Dean Witter</option>
            <option value="069">BPN Brasil</option>
            <option value="070">Banco de Brasília – BRB</option>
            <option value="072">Banco Rural</option>
            <option value="073">Banco Popular</option>
            <option value="074">Banco J. Safra</option>
            <option value="075">Banco CR2</option>
            <option value="076">Banco KDB</option>
            <option value="096">Banco BMF</option>
            <option value="104">Caixa Econômica Federal</option>
            <option value="107">Banco BBM</option>
            <option value="116">Banco Único</option>
            <option value="151">Nossa Caixa</option>
            <option value="175">Banco Finasa</option>
            <option value="184">Banco Itaú BBA</option>
            <option value="204">American Express Bank</option>
            <option value="208">Banco Pactual</option>
            <option value="212">Banco Original</option>
            <option value="213">Banco Arbi</option>
            <option value="214">Banco Dibens</option>
            <option value="217">Banco Joh Deere</option>
            <option value="218">Banco Bonsucesso</option>
            <option value="222">Banco Calyon Brasil</option>
            <option value="224">Banco Fibra</option>
            <option value="225">Banco Brascan</option>
            <option value="229">Banco Cruzeiro</option>
            <option value="230">Unicard</option>
            <option value="233">Banco GE Capital</option>
            <option value="237">Bradesco</option>
            <option value="241">Banco Clássico</option>
            <option value="243">Banco Stock Máxima</option>
            <option value="246">Banco ABC Brasil</option>
            <option value="248">Banco Boavista Interatlântico</option>
            <option value="249">Investcred Unibanco</option>
            <option value="250">Banco Schahin</option>
            <option value="252">Fininvest</option>
            <option value="254">Paraná Banco</option>
            <option value="263">Banco Cacique</option>
            <option value="265">Banco Fator</option>
            <option value="266">Banco Cédula</option>
            <option value="300">Banco de la Nación Argentina</option>
            <option value="318">Banco BMG</option>
            <option value="320">Banco Industrial e Comercial</option>
            <option value="356">ABN Amro Real</option>
            <option value="341">Itau</option>
            <option value="347">Sudameris</option>
            <option value="351">Banco Santander</option>
            <option value="353">Banco Santander Brasil</option>
            <option value="366">Banco Societe Generale Brasil</option>
            <option value="370">Banco WestLB</option>
            <option value="376">JP Morgan</option>
            <option value="389">Banco Mercantil do Brasil</option>
            <option value="394">Banco Mercantil de Crédito</option>
            <option value="399">HSBC</option>
            <option value="409">Unibanco</option>
            <option value="412">Banco Capital</option>
            <option value="422">Banco Safra</option>
            <option value="453">Banco Rural</option>
            <option value="456">Banco Tokyo Mitsubishi UFJ</option>
            <option value="464">Banco Sumitomo Mitsui Brasileiro</option>
            <option value="477">Citibank</option>
            <option value="479">Itaubank (antigo Bank Boston)</option>
            <option value="487">Deutsche Bank</option>
            <option value="488">Banco Morgan Guaranty</option>
            <option value="492">Banco NMB Postbank</option>
            <option value="494">Banco la República Oriental del Uruguay</option>
            <option value="495">Banco La Provincia de Buenos Aires</option>
            <option value="505">Banco Credit Suisse</option>
            <option value="600">Banco Luso Brasileiro</option>
            <option value="604">Banco Industrial</option>
            <option value="610">Banco VR</option>
            <option value="611">Banco Paulista</option>
            <option value="612">Banco Guanabara</option>
            <option value="613">Banco Pecunia</option>
            <option value="623">Banco Panamericano</option>
            <option value="626">Banco Ficsa</option>
            <option value="630">Banco Intercap</option>
            <option value="633">Banco Rendimento</option>
            <option value="634">Banco Triângulo</option>
            <option value="637">Banco Sofisa</option>
            <option value="638">Banco Prosper</option>
            <option value="643">Banco Pine</option>
            <option value="652">Itaú Holding Financeira</option>
            <option value="653">Banco Indusval</option>
            <option value="654">Banco A.J. Renner</option>
            <option value="655">Banco Votorantim</option>
            <option value="707">Banco Daycoval</option>
            <option value="719">Banif</option>
            <option value="721">Banco Credibel</option>
            <option value="734">Banco Gerdau</option>
            <option value="735">Banco Pottencial</option>
            <option value="738">Banco Morada</option>
            <option value="739">Banco Galvão de Negócios</option>
            <option value="740">Banco Barclays</option>
            <option value="741">BRP</option>
            <option value="743">Banco Semear</option>
            <option value="745">Banco Citibank</option>
            <option value="746">Banco Modal</option>
            <option value="747">Banco Rabobank International</option>
            <option value="748">Banco Cooperativo Sicredi</option>
            <option value="749">Banco Simples</option>
            <option value="751">Dresdner Bank</option>
            <option value="752">BNP Paribas</option>
            <option value="753">Banco Comercial Uruguai</option>
            <option value="755">Banco Merrill Lynch</option>
            <option value="756">Banco Cooperativo do Brasil</option>
            <option value="757">KEB</option>';
}

function getCountriesArray() {
    return '<option value="BR">Brasil</option>
            <option value="AF">Afeganistão</option>
            <option value="ZA">África do Sul</option>
            <option value="AL">Albânia</option>
            <option value="DE">Alemanha</option>
            <option value="AD">Andorra</option>
            <option value="AO">Angola</option>
            <option value="AI">Anguilla</option>
            <option value="AQ">Antártida</option>
            <option value="AG">Antígua e Barbuda</option>
            <option value="AN">Antilhas Holandesas</option>
            <option value="SA">Arábia Saudita</option>
            <option value="DZ">Argélia</option>
            <option value="AR">Argentina</option>
            <option value="AM">Armênia</option>
            <option value="AW">Aruba</option>
            <option value="AU">Austrália</option>
            <option value="AT">Áustria</option>
            <option value="AZ">Azerbaijão</option>
            <option value="BS">Bahamas</option>
            <option value="BD">Bangladesh</option>
            <option value="BB">Barbados</option>
            <option value="BH">Barein</option>
            <option value="BE">Bélgica</option>
            <option value="BZ">Belize</option>
            <option value="BJ">Benin</option>
            <option value="BM">Bermudas</option>
            <option value="BY">Bielo-Rússia</option>
            <option value="BO">Bolívia</option>
            <option value="BA">Bósnia-Herzegovina</option>
            <option value="BW">Botsuana</option>
            <option value="BN">Brunei Darussalam</option>
            <option value="BG">Bulgária</option>
            <option value="BF">Burkina Fasso</option>
            <option value="BI">Burundi</option>
            <option value="BT">Butão</option>
            <option value="CV">Cabo Verde</option>
            <option value="CM">Camarões</option>
            <option value="KH">Camboja</option>
            <option value="CA">Canadá</option>
            <option value="QA">Catar</option>
            <option value="KY">Cayman, Ilhas</option>
            <option value="KZ">Cazaquistão</option>
            <option value="TD">Chade</option>
            <option value="CL">Chile</option>
            <option value="CN">China</option>
            <option value="CY">Chipre</option>
            <option value="SG">Cingapura</option>
            <option value="CO">Colômbia</option>
            <option value="CG">Congo</option>
            <option value="KP">Coréia do Norte</option>
            <option value="KR">Coréia do Sul</option>
            <option value="CI">Costa do Marfim</option>
            <option value="CR">Costa Rica</option>
            <option value="HR">Croácia</option>
            <option value="CU">Cuba</option>
            <option value="DK">Dinamarca</option>
            <option value="DJ">Djibuti</option>
            <option value="DM">Dominica</option>
            <option value="EG">Egito</option>
            <option value="SV">El Salvador</option>
            <option value="AE">Emirados Árabes Unidos</option>
            <option value="EC">Equador</option>
            <option value="ER">Eritréia</option>
            <option value="SK">Eslováquia</option>
            <option value="SI">Eslovênia</option>
            <option value="ES">Espanha</option>
            <option value="EE">Estônia</option>
            <option value="ET">Etiópia</option>
            <option value="RU">Federação Russa</option>
            <option value="FJ">Fiji</option>
            <option value="PH">Filipinas</option>
            <option value="FI">Finlândia</option>
            <option value="FR">França</option>
            <option value="GA">Gabão</option>
            <option value="GM">Gâmbia</option>
            <option value="GH">Gana</option>
            <option value="GE">Geórgia</option>
            <option value="GS">Geórgia do Sul e Ilhas Sandwich do Sul</option>
            <option value="GI">Gibraltar</option>
            <option value="GD">Granada</option>
            <option value="GR">Grécia</option>
            <option value="GL">Groenlândia</option>
            <option value="GP">Guadalupe</option>
            <option value="GU">Guam</option>
            <option value="GT">Guatemala</option>
            <option value="GG">Guernsey</option>
            <option value="GY">Guiana</option>
            <option value="GF">Guiana Francesa</option>
            <option value="GN">Guiné</option>
            <option value="GQ">Guiné Equatorial</option>
            <option value="GW">Guiné-Bissau</option>
            <option value="HT">Haiti</option>
            <option value="NL">Holanda</option>
            <option value="HN">Honduras</option>
            <option value="HK">Hong Kong</option>
            <option value="HU">Hungria</option>
            <option value="YE">Iêmen</option>
            <option value="BV">Ilha Bouvet</option>
            <option value="CX">Ilha Christmas</option>
            <option value="IM">Ilha de Man</option>
            <option value="NF">Ilha Norfolk</option>
            <option value="AX">Ilhas Åland</option>
            <option value="CC">Ilhas Cocos (Keeling)</option>
            <option value="KM">Ilhas Comores</option>
            <option value="CK">Ilhas Cook</option>
            <option value="FO">Ilhas Feroé</option>
            <option value="HM">Ilhas Heard e McDonald</option>
            <option value="FK">Ilhas Malvinas (Falkland)</option>
            <option value="MP">Ilhas Marianas do Norte</option>
            <option value="MH">Ilhas Marshall</option>
            <option value="MU">Ilhas Maurício</option>
            <option value="SB">Ilhas Salomão</option>
            <option value="SC">Ilhas Seychelles</option>
            <option value="VI">Ilhas Virgens Americanas</option>
            <option value="VG">Ilhas Virgens Britânicas</option>
            <option value="WF">Ilhas Wallis e Futuna</option>
            <option value="IN">Índia</option>
            <option value="ID">Indonésia</option>
            <option value="IR">Irã</option>
            <option value="IQ">Iraque</option>
            <option value="IE">Irlanda</option>
            <option value="IS">Islândia</option>
            <option value="IL">Israel</option>
            <option value="IT">Itália</option>
            <option value="JM">Jamaica</option>
            <option value="JP">Japão</option>
            <option value="JE">Jersey</option>
            <option value="JO">Jordânia</option>
            <option value="KI">Kiribati</option>
            <option value="KW">Kuwait</option>
            <option value="LS">Lesoto</option>
            <option value="LV">Letônia</option>
            <option value="LB">Líbano</option>
            <option value="LR">Libéria</option>
            <option value="LY">Líbia</option>
            <option value="LI">Liechtenstein</option>
            <option value="LT">Lituânia</option>
            <option value="LU">Luxemburgo</option>
            <option value="MO">Macau</option>
            <option value="MK">Macedônia</option>
            <option value="MG">Madagascar</option>
            <option value="MW">Malásia</option>
            <option value="MV">Malauí</option>
            <option value="ML">Maldivas</option>
            <option value="MT">Mali</option>
            <option value="MY">Malta</option>
            <option value="MA">Marrocos</option>
            <option value="MQ">Martinica</option>
            <option value="MR">Mauritânia</option>
            <option value="YT">Mayotte</option>
            <option value="MX">México</option>
            <option value="FM">Micronésia</option>
            <option value="MZ">Moçambique</option>
            <option value="MD">Moldávia</option>
            <option value="MC">Mônaco</option>
            <option value="MN">Mongólia</option>
            <option value="ME">Montenegro</option>
            <option value="MS">Montserrat</option>
            <option value="MM">Myanmar (antiga Birmânia)</option>
            <option value="NA">Namíbia</option>
            <option value="NR">Nauru</option>
            <option value="NP">Nepal</option>
            <option value="NI">Nicarágua</option>
            <option value="NE">Níger</option>
            <option value="NG">Nigéria</option>
            <option value="NU">Niue</option>
            <option value="NO">Noruega</option>
            <option value="NC">Nova Caledônia</option>
            <option value="NZ">Nova Zelândia</option>
            <option value="OM">Omã</option>
            <option value="PW">Palau</option>
            <option value="PS">Palestina</option>
            <option value="PA">Panamá</option>
            <option value="PG">Papua-Nova Guiné</option>
            <option value="PK">Paquistão</option>
            <option value="PY">Paraguai</option>
            <option value="PE">Peru</option>
            <option value="PN">Pitcairn</option>
            <option value="PF">Polinésia Francesa</option>
            <option value="PL">Polônia</option>
            <option value="PR">Porto Rico</option>
            <option value="PT">Portugal</option>
            <option value="KE">Quênia</option>
            <option value="KG">Quirguistão</option>
            <option value="GB">Reino Unido</option>
            <option value="CF">República Centro-Africana</option>
            <option value="CD">República Democrática do Congo</option>
            <option value="LA">República Democrática Popular do Laos</option>
            <option value="DO">República Dominicana</option>
            <option value="CZ">República Tcheca</option>
            <option value="RE">Reunião</option>
            <option value="RO">Romênia</option>
            <option value="RW">Ruanda</option>
            <option value="EH">Saara Ocidental</option>
            <option value="WS">Samoa</option>
            <option value="AS">Samoa Americana</option>
            <option value="SM">San Marino</option>
            <option value="SH">Santa Helena</option>
            <option value="LC">Santa Lúcia</option>
            <option value="BL">São Bartolomeu</option>
            <option value="KN">São Cristóvão e Névis</option>
            <option value="MF">São Martinho</option>
            <option value="ST">São Tomé e Príncipe</option>
            <option value="VC">São Vincente e Granadinas</option>
            <option value="SN">Senegal</option>
            <option value="SL">Serra Leoa</option>
            <option value="RS">Sérvia</option>
            <option value="SY">Síria</option>
            <option value="SO">Somália</option>
            <option value="LK">Sri Lanka</option>
            <option value="PM">St. Pierre e Miquelon</option>
            <option value="SZ">Suazilândia</option>
            <option value="SD">Sudão</option>
            <option value="SS">Sudão do Sul</option>
            <option value="SE">Suécia</option>
            <option value="CH">Suíça</option>
            <option value="SR">Suriname</option>
            <option value="SJ">Svalbard e Jan Mayen</option>
            <option value="TH">Tailândia</option>
            <option value="TW">Taiwan</option>
            <option value="TJ">Tajiquistão</option>
            <option value="TZ">Tanzânia</option>
            <option value="IO">Território Britânico do Oceano Índico</option>
            <option value="TF">Territórios Franceses do Sul</option>
            <option value="UM">Territórios Insulares dos Estados Unidos</option>
            <option value="TL">Timor Leste</option>
            <option value="TG">Togo</option>
            <option value="TO">Tonga</option>
            <option value="TK">Toquelau</option>
            <option value="TT">Trinidad e Tobago</option>
            <option value="TN">Tunísia</option>
            <option value="TM">Turcomenistão</option>
            <option value="TC">Turks e Caicos</option>
            <option value="TR">Turquia</option>
            <option value="TV">Tuvalu</option>
            <option value="UA">Ucrânia</option>
            <option value="UG">Uganda</option>
            <option value="UY">Uruguai</option>
            <option value="UZ">Uzbequistão</option>
            <option value="VU">Vanuatu</option>
            <option value="VA">Vaticano</option>
            <option value="VE">Venezuela</option>
            <option value="VN">Vietnã</option>
            <option value="ZM">Zâmbia</option>
            <option value="ZW">Zimbábue</option>';
}
