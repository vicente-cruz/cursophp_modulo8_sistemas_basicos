<?php
class Posts extends model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function inserirPost($msg)
    {
        $id_usuario = $_SESSION['twlg'];
        
        $sql = "INSERT INTO posts(id_usuario,data_post,mensagem) VALUES ('".$id_usuario."', NOW(), '".$msg."')";
        $this->db->query($sql);
    }
    
    public function getFeed($lista, $limit)
    {
        $feeds = array();
        
        if (count($lista) > 0) {
            $sql = "SELECT"
                    . " *,"
                    . " (SELECT nome FROM usuarios WHERE usuarios.id = posts.id_usuario) AS nome "
                    . " FROM"
                    . "     posts"
                    . " WHERE"
                    . "     id_usuario IN (".implode(',',$lista).")"
                    . " ORDER BY data_post"
                    . " LIMIT ".$limit;
            $query = $this->db->query($sql);
            
            if ($query->rowCount() > 0) {
                $feeds = $query->fetchAll();
            }
        }
        
        return $feeds;
    }
}
?>