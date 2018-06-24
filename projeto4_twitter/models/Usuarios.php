<?php

class Usuarios extends model
{
    private $uid;
    
    public function __construct($id = '')
    {
        parent::__construct();
        
        if (!empty($id)) {
            $this->uid = $id;
        }
    }
    
    public function fazerLogin($email,$senha)
    {
        $sql = "SELECT * FROM usuarios WHERE email='".$email."' AND senha='".$senha."'";
        $query = $this->db->query($sql);
        
        if ($query->rowCount() > 0) {
            $usuario = $query->fetch();
            
            $_SESSION['twlg'] = $usuario['id'];
            
            return true;
        } else {
            return false;
        }
    }
    
    public function isLogged()
    {
        return ((isset($_SESSION['twlg']) && !empty($_SESSION['twlg'])) ? true : false );
    }
    
    public function usuarioExiste($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email='".$email."'";
        $query = $this->db->query($sql);
        return ($query->rowCount() > 0 ? true : false);
    }
    
    public function inserirUsuario($nome,$email,$senha)
    {
        $sql = "INSERT INTO usuarios(nome,email,senha) VALUES ('".$nome."','".$email."','".$senha."')";
        $this->db->query($sql);
        
        $id = $this->db->lastInsertId();
        
        return $id;
    }
    
    public function getNome()
    {
        if (!empty($this->uid)) {
            $sql = "SELECT nome FROM usuarios WHERE id = '".$this->uid."'";
            $query = $this->db->query($sql);
            
            if ($query->rowCount() > 0) {
                $usuario = $query->fetch();
                
                return $usuario['nome'];
            }
        }
    }
    
    public function countSeguidos()
    {
        $sql = "SELECT * FROM relacionamentos WHERE id_seguidor='".$this->uid."'";
        $query = $this->db->query($sql);
        
        return $query->rowCount();
    }
    
    public function countSeguidores()
    {
        $sql = "SELECT * FROM relacionamentos WHERE id_seguido='".$this->uid."'";
        $query = $this->db->query($sql);
        
        return $query->rowCount();
    }
    
    public function getUsuarios($limite)
    {
        $usuarios = array();
        
        $sql = "SELECT"
                . " * "
                . ",(SELECT "
                . "     count(*)"
                . "  FROM"
                . "     relacionamentos"
                . "  WHERE"
                . "     relacionamentos.id_seguidor = '".$this->uid."'"
                . "  AND relacionamentos.id_seguido = usuarios.id)"
                . " AS seguido"
                . " FROM "
                . "     usuarios"
                . " WHERE "
                . "     id <> '".$this->uid."'"
                . " ORDER BY id DESC "
                . " LIMIT ".$limite;
        $query = $this->db->query($sql);
        
        if ($query->rowCount() > 0) {
            $usuarios = $query->fetchAll();
        }
        
        return $usuarios;
    }
    
    public function existeSeguido($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = '".$id."'";
        $query = $this->db->query($sql);
        return ($query->rowCount() > 0 ? true : false);
    }
    
    public function getSeguidos()
    {
        $seguidos = array();
        
        $sql = "SELECT id_seguido FROM relacionamentos WHERE id_seguidor='".$this->uid."'";
        $query = $this->db->query($sql);
        
        if ($query->rowCount() > 0) {
            foreach ($query->fetchAll() as $seguido) {
                $seguidos[] = $seguido['id_seguido'];
            }
        }
        
        return $seguidos;
    }
}

?>