<?php
class Fotos extends model
{
    public function getFotos()
    {
        $fotos = array();
        
        $sql = "SELECT * FROM fotos ORDER BY id DESC";
        $query = $this->db->query($sql);
        
        if ($query->rowCount() > 0) {
            $fotos = $query->fetchAll();
        }
        
        return $fotos;
    }
    
    public function saveFotos()
    {
        // Verifica se o arquivo de fato foi enviado
        if (isset($_FILES["arquivo"]) && !empty($_FILES["arquivo"]["tmp_name"])) {
            
            // Verifica se o tipo de arquivo realmente eh uma imagem
            $permitidos = array("image/jpeg", "image/jpg", "image/png");
            if (in_array($_FILES["arquivo"]["type"],$permitidos)) {
                
                // Gera novo nome para imagem.
                $nome = md5(time().rand(0,999)).".jpg";
                move_uploaded_file($_FILES["arquivo"]["tmp_name"], "assets/images/galeria/".$nome);
                
                $titulo =  ((isset($_POST["titulo"]) && !empty($_POST["titulo"])) ? addslashes($_POST["titulo"]) : "");
                
                $sql = "INSERT INTO fotos(titulo,url) VALUES ('".$titulo."','".$nome."') ";
                $this->db->query($sql);
            }
        }
    }
}
?>