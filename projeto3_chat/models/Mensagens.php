<?php

class Mensagens extends model
{
    public function sendMessage($idChamado, $origem, $msg)
    {
        if (!empty($idChamado) && !empty($msg)) {
            $sql = "INSERT INTO mensagens(id_chamado, mensagem, origem, data_enviado) VALUES ('".$idChamado."','".$msg."','".$origem."', NOW())";
            $this->db->query($sql);
        }

    }
    
    public function getMessage($idChamado, $lastMsg)
    {
        $mensagens = array();
        
        $sql = "SELECT * FROM mensagens WHERE id_chamado = '".$idChamado."' AND data_enviado > '".$lastMsg."'";
        $query = $this->db->query($sql);
        if ($query->rowCount() > 0) {
            $mensagens = $query->fetchAll();
            
            foreach ($mensagens as $chave => $valor) {
                $mensagens[$chave]['data_enviado'] = date('H:i', strtotime($valor['data_enviado']));
            }
        }
        
        $c = new Chamados();
        $area = $_SESSION['area'];
        $c->updateLastMsg($idChamado, $area);
        
        return $mensagens;
    }
}

?>