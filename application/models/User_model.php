<?php

class User_model extends CI_Model {

    function registerUser($data) {
        //inicia transacao
        $this->db->trans_start();

        //INSERE O USUARIO
        $this->db->set("name", $data["name"]);
        $this->db->set("surname", $data["surname"]);
        $this->db->set("email", $data["email"]);
        $this->db->set("password", md5($data["password"]));
        $this->db->set("avatar", "no-image.jpg");
        $this->db->set("active", 1); //Quando setado pra 1 o user já sai ativado
        $this->db->set("Is_user", 1); //Quando setado pra 1 é usuario
        $this->db->insert("usuario");
        $isLastInsert = $this->db->insert_id();

        //INSERE O ENDERECO
        $this->db->set("postalcode", $data["postalcode"]);
        $this->db->set("street", $data["street"]);
        $this->db->set("district", $data["district"]);
        $this->db->set("city", $data["city"]);
        $this->db->set("state", $data["state"]);
        $this->db->set("id_usuario", $isLastInsert);
        $this->db->insert("usuario_address");

        //INSERE A DATA
        $this->db->set("aboutme", "");
        $this->db->set("birthdate", "");
        $this->db->set("id_usuario", $isLastInsert);
        $this->db->insert("usuario_personal_data");

        //complete transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            //algum erro ocorreu! 
            return false;
        }
    }

    function updateStats($iduser, $analitico, $criativo, $operacional, $relacional) {
        $this->db->set("analitico", $analitico);
        $this->db->set("criativo", $criativo);
        $this->db->set("operacional", $operacional);
        $this->db->set("relacional", $relacional);
        $this->db->where("id", $iduser);
        return $this->db->update("usuario");

    }

    function getDadosByUserEmail($usuarioEmail, $fields) {
        if ($fields) {
            if (is_array($fields)) {
                $fieldsStr = implode(",", $fields);
            } else {
                $fieldsStr = $fields;
            }
            return $this->db->select($fieldsStr)->where("email", $usuarioEmail)->get("usuario")->row(0);
        } else {
            return $this->db->where("id", $usuarioEmail)->get("usuario")->row(0);
        }
    }

    function getUserCompleteData($userId) {
        $this->db->select("*, usuario.id, usuario_address.id as id_address, usuario_personal_data.id as id_personal_data, ramos.id as ramo_id, ramos.nome as ramo_nome, ramos.pai as ramo_pai");            
        $this->db->join("ramos", "usuario.ramo = ramos.id", "left");
        $this->db->join("usuario_address", "usuario.id = usuario_address.id_usuario", "left");
        $this->db->join("usuario_personal_data", "usuario.id = usuario_personal_data.id_usuario", "left");
        return $this->db->where("usuario.id", $userId)->get("usuario")->row(0);
    }

    function getAllUsuarios(){
        $this->db->select("*, usuario_address.id_usuario as id_address, usuario_personal_data.id_usuario as id_personal_data");            
        $this->db->join("usuario_address", "usuario.id = usuario_address.id_usuario", "left");
        $this->db->join("usuario_personal_data", "usuario.id = usuario_personal_data.id_usuario", "left");
        return $this->db->get("usuario")->result();
    }

    function updateUserData($sobre, $Idade, $Civil,$Eletronico, $Nasciolidade, $Telefone, $Rua, $Bairro, $Cidade, $Estado, $Postal, $userId){
        $this->db->trans_start();
        
        $this->db->set("aboutme", $sobre);
        $this->db->set("Idade", $Idade);
        $this->db->set("Civil", $Civil);
        $this->db->set("Eletronico", $Eletronico);
        $this->db->set("Nasciolidade", $Nasciolidade);
        $this->db->set("Telefone", $Telefone);
        $this->db->where("id_usuario", $userId);
        $this->db->update('usuario_personal_data');
        
        $this->db->set("street", $Rua);
        $this->db->set("district", $Bairro);
        $this->db->set("city", $Cidade);
        $this->db->set("state", $Estado);
        $this->db->set("postalcode", $Postal);
        $this->db->where("id_usuario", $userId);
        $this->db->update('usuario_address');
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    function getUserImage($usuarioId) {
        $this->db->select("avatar");
        $this->db->where('id', $usuarioId);
        $picture = $this->db->get("usuario")->row(0);
        return $picture;
    }
    function getUserImagePic($usuarioId){
        $this->db->select("notificacoes.*, usuario.avatar");
        $this->db->join("usuario", "notificacoes.id_notificando = usuario.id", "left");
        $this->db->where("tipo","amizade");
        $this->db->where("id_notificando",$usuarioId);
        return $this->db->get("notificacoes")->result();
    }
    public function tempo_corrido($time) {

        $now = strtotime(date('m/d/Y H:i:s'));
         $time = strtotime($time);
         $diff = $now - $time;
        
        $seconds = $diff;
         $minutes = round($diff / 60);
         $hours = round($diff / 3600);
         $days = round($diff / 86400);
         $weeks = round($diff / 604800);
         $months = round($diff / 2419200);
         $years = round($diff / 29030400);
        
        if ($seconds <= 60) return"1 min atrás";
         else if ($minutes <= 60) return $minutes==1 ?'1 min atrás':$minutes.' min atrás';
         else if ($hours <= 24) return $hours==1 ?'1 hrs atrás':$hours.' hrs atrás';
         else if ($days <= 7) return $days==1 ?'1 dia atras':$days.' dias atrás';
         else if ($weeks <= 4) return $weeks==1 ?'1 semana atrás':$weeks.' semanas atrás';
         else if ($months <= 12) return $months == 1 ?'1 mês atrás':$months.' meses atrás';
         else return $years == 1 ? 'um ano atrás':$years.' anos atrás';
    }
    function fazerNotificacao($id_1,$id_2){
        $this->db->set("vizualizada", "0" );
        $this->db->set("tipo", "amizade");
        $this->db->set("id_notificado", $id_2);
        $this->db->set("id_notificando", $id_1);
        $this->db->insert("notificacoes");  
        return true;
    }
    function fazerPedido($id_1,$id_2){
        $this->db->set("aceito", "0" );
        $this->db->set("amigo", $id_1);
        $this->db->set("amigo2", $id_2);
        $this->db->insert("amigos");  
        return true;
    }

    function vizualizar($id){
        $this->db->set("vizualizada","1");
        $this->db->where("id",$id);
        $this->db->update("notificacoes");
    }
    function vizualizarTodas($id,$tipo){
        $this->db->set("vizualizada","1");
        $this->db->where("id_notificado",$id);
        $this->db->where("tipo",$tipo);
        $this->db->update("notificacoes");
    }
    
    function ResponderPedido($iduser,$usuarioId,$resposta,$notificacao){
        $this->db->set("aceito",$resposta);
        $this->db->where("amigo",$usuarioId);
        $this->db->where("amigo2",$iduser);
        $this->db->update("amigos");
        $this->db->where("id",$notificacao);
        $this->db->delete("notificacoes");

    }

    function mandarNorificacaoDeAmizade($iduser,$usuarioId){
        $this->db->set("vizualizada", "0" );
        $this->db->set("tipo", "notificacoes");
        $this->db->set("id_notificado", $iduser);
        $this->db->set("id_notificando", $usuarioId);
        $this->db->set("txt_before", 'você e ');
        $this->db->set("txt_after", ' sâo amigos agora.');
        $this->db->insert("notificacoes");
    }

    function enviarSms($de,$para,$mensagem){
        $this->db->set("vizualizada", "0" );
        $this->db->set("tipo", "mensagem");
        $this->db->set("id_notificado", $para);
        $this->db->set("id_notificando", $de);
        $this->db->set("texto", $mensagem);
        $this->db->insert("notificacoes");
    }

    function getUserNotificacoes($usuarioId,$visu = true) {
        $this->db->select("notificacoes.*,usuario.avatar,usuario.name");
        $this->db->join("usuario", "notificacoes.id_notificando = usuario.id", "left");
        $this->db->where("tipo", "notificacoes");
        if($visu){
            $this->db->where("vizualizada", "0");
        }
        $this->db->where("id_notificado", $usuarioId);
        $parada = $this->db->get("notificacoes")->result();
        $coisa ='ta';
        foreach ($parada as $parad) {
            $parad->data_pedido = $this->tempo_corrido($parad->data_pedido);
        }
        return ($parada);
    }
    function getUserMensagens($usuarioId,$visu = true) {
        $this->db->select("notificacoes.*,usuario.avatar,usuario.name");
        $this->db->join("usuario", "notificacoes.id_notificando = usuario.id", "left");
        $this->db->where("tipo", "mensagem");
        if($visu){
            $this->db->where("vizualizada", "0");
        }
        $this->db->where("id_notificado", $usuarioId);
        $parada = $this->db->get("notificacoes")->result();
        foreach ($parada as $parad) {
            $parad->data_pedido = $this->tempo_corrido($parad->data_pedido);
        }
        return ($parada);
    }
    function getUserPedidos($usuarioId,$visu = true) {
        $this->db->select("notificacoes.*,usuario.avatar,usuario.name");
        $this->db->join("usuario", "notificacoes.id_notificando = usuario.id", "left");
        $this->db->where("tipo", "amizade");
        if($visu){
            $this->db->where("vizualizada", "0");
        }
        $this->db->where("id_notificado", $usuarioId);
        $coisa = $this->db->get("notificacoes")->result();
        foreach ($coisa as $c) {
            $c->texto = $this->getAmigosComun($c->id_notificado,$c->id_notificando);
        }
        return $coisa;
    }
    function getUserEstadoAmizade($id_1,$id_2){
        $this->db->select("amigos.*");
        $this->db->where("amigo", $id_1);
        $this->db->or_where("amigo2", $id_1);
        $amigos = $this->db->get("amigos")->result();
        $status = '3'; //0 = solicitado 1 = aceito 2 = negado 3 = n solicitado
        foreach ($amigos as $amg) {
            if($amg->amigo == $id_2 || $amg->amigo2 == $id_2 ){
                $status = $amg->aceito;
            }
        }
        return $status;
    }
    function getAmizades($id){
        $this->db->select("amigos.*");
        $this->db->where("amigo", $id);
        $this->db->or_where("amigo2", $id);
        // $this->db->join("usuario", "notificacoes. = usuario.id", "left");
        $result = $this->db->get("amigos")->result();
        foreach ($result as $res) {
            if($res->amigo2 == $id ){
                $c=$res->amigo;
                $res->amigo = $res->amigo2;
                $res->amigo2 = $c;
            }
            $res->data = $this->getUserImage($res->amigo2);
        }
        for ($i= 0 ; $i < count($result); $i++) { 
            if($result[$i]->aceito != "1"){
                unset($result[$i]);
            }
        }
        return $result;
    }
    function getRecomendacoes($id){
        $this->db->select("recomendacoes.*,usuario.avatar,usuario.id");
        $this->db->where("id_recomendado",$id);
        $this->db->join("usuario", "recomendacoes.id_recomendando = usuario.id", "left");
        return $this->db->get("recomendacoes")->result();
    }

    function recomendar($recomendando,$recomendado,$estrelas,$texto){
        $this->db->set("id_recomendando	", $recomendando);
        $this->db->set("id_recomendado", $recomendado);
        $this->db->set("estrelas", $estrelas);
        $this->db->set("texto", $texto);
        $this->db->insert("recomendacoes");
    }

    function Pesquisar($vaga){
        // $this->db->select("vagas.*,empresa.avatar,empresa.id,empresa.ramo,empresa.name, empresa.email");
        $this->db->select("vagas.*");
        $this->db->like("titulo",$vaga);
        $this->db->or_like("descricao",$vaga);
        // $this->db->join("vagas", "empresa.id = vagas.id_empresa", "left");
        $result = $this->db->get("vagas")->result();
        foreach($result as $res){
            $res->updated = $this->tempo_corrido($res->updated);
        }
        return $result;
    }
    
    function getAmigosComun($id_1,$id_2){
        $this->db->select("amigos.*");
        $this->db->where("aceito","2");
        $todos = $this->db->get("amigos")->result();
        $am1[] = array();
        $am1[0] = 'first';
        $am2[] = array();
        $am2[0] = 'first';
        foreach ($todos as $t) {
            if($t->amigo == $id_1){
                array_push($am1,$t->amigo2);
            }
            if($t->amigo2 == $id_1){
                array_push($am1,$t->amigo);
            }
            if($t->amigo == $id_2){
                array_push($am2,$t->amigo2);
            }
            if($t->amigo2 == $id_2){
                array_push($am2,$t->amigo);
            }
        }
        $conter = 0;
        for ($i=1; $i < count($am1) ; $i++) { 
            for ($j=1; $j <count($am2) ; $j++) { 
                if($am1[$i] == $am2[$j]){
                    $conter++;
                }
            }
        }
        return $conter;
    }
    function updateUserImage($usuarioId,$imagem) {
        $this->db->trans_start();
        $this->db->set('avatar', $imagem);
        $this->db->where('id', $usuarioId);
        $this->db->update('usuario');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    // INSERT POST
    function setUserPost($userId, $data, $imgs = null) {
        $this->db->set("text", $data["textoPost"]);
        $this->db->set("fixo", 0);
        $this->db->set("id_usuario", $userId);
        $this->db->insert("usuario_post");
        $postId = $this->db->insert_id();

        if($imgs) {
            foreach($imgs as $img) {
                $this->db->set("foto", $img);
                $this->db->set("id_post", $postId);
                $this->db->insert("usuario_post_fotos");
            }
        }
        return true;
    }
    // GET POSTS
    function getUserPosts($id_usuario) {
        // $this->db->select("user_post.text, user_post.fixo, user_post.data, GROUP_CONCAT(post_photos.photo) as photos");
        // $this->db->join("post_photos", "user_post.iduser_post = post_photos.post_id", "left");
        // $this->db->where("user_post.user_iduser", $userId);
        // $this->db->group_by("user_post.iduser_post");
        // $this->db->order_by("user_post.fixo", "desc");
        // $this->db->order_by("user_post.data", "desc");
        // return $this->db->query("user_post")->result();

        return $this->db->query("SELECT usuario_post.id as id, usuario_post_fotos.id as id_post_fotos, usuario_post.id_usuario, usuario_post.text, usuario_post.fixo, usuario_post.created, GROUP_CONCAT(usuario_post_fotos.foto) as photos FROM usuario_post LEFT JOIN usuario_post_fotos ON usuario_post.id = usuario_post_fotos.id_post WHERE usuario_post.id_usuario = $id_usuario GROUP BY usuario_post.id ORDER BY usuario_post.fixo DESC, usuario_post.created DESC")->result();
    }
    function getPost($postId) {
        $this->db->select("*");
        $this->db->where("id", $postId);
        return $this->db->get("usuario_post")->row(0);
    }
    // UPDATE POST
    function updateUserPost($data) {
        //$this->db->set("photo", $data["foto"]);
        $this->db->set("text", $data["texto"]);
        $this->db->where("id", $data["id"]);
        return $this->db->update("usuario_post");
    }
    function fixarUserPost() {
        $id_post = $this->input->post("id_post");
        $this->db->set("fixo", 1);
        $this->db->where("id", $id_post);
        return $this->db->update("usuario_post");
    }
    function desfixarUserPost() {
        $id_post = $this->input->post("id_post");
        $this->db->set("fixo", 0);
        $this->db->where("id", $id_post);
        return $this->db->update("usuario_post");
    }
    // DELETE POST
    function deleteUserPost($postId) {
        $this->db->where("id", $postId);
        return $this->db->delete("usuario_post");
    }


}