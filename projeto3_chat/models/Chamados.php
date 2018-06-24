<?php
class Chamados extends model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getChamados()
    {
        $chamados = array();
        
        $sql = "SELECT * FROM chamados WHERE status IN (0,1)";
        $query = $this->db->query($sql);
        if ($query->rowCount() > 0) {
            $chamados = $query->fetchAll();
        }
        
        return $chamados;
    }
    
    public function getChamado($id)
    {
        $chamado = array();
        
        if (!empty($id)) {
            $sql = "SELECT * FROM chamados WHERE id =".$id;
            $query = $this->db->query($sql);
            if ($query->rowCount() > 0) {
                $chamado = $query->fetch();
            }
        }
        
        return $chamado;
    }
    
    public function getLastMsg($id, $area)
    {
        $dt = "";
        
        if (!empty($id) && !empty($area)) {
            $sql = "SELECT data_last_".$area." AS dt FROM chamados WHERE id = ".$id;
            $query = $this->db->query($sql);
            if ($query->rowCount() > 0) {
                $lastMsg = $query->fetch();
                $dt = $lastMsg['dt'];
            }
        }
        
        return $dt;
    }
    
    public function updateLastMsg($id,$area)
    {
        if (!empty($id) && !empty($area)) {
            $sql = "UPDATE chamados SET data_last_".$area." = NOW() WHERE id='".$id."'";
            $this->db->query($sql);
        }
    }
    
    public function addChamado($ip, $nome, $data_inicio)
    {
        $id = 0;
        
        $sql = "INSERT INTO chamados(ip,nome,data_inicio,status) VALUES ('".$ip."','".$nome."','".$data_inicio."','0')";
        $query = $this->db->query($sql);
        
        $id = $this->db->lastInsertId();
        
        return $id;
    }
    
    public function updateStatus($id, $status)
    {
        if (!empty($id) && !empty($status)) {
            $sql = "UPDATE chamados SET status=".$status." WHERE id=".$id;
            $this->db->query($sql);
        }
    }
}
?>