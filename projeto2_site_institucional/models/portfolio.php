<?php

class Portfolio extends model
{
    public function getTrabalhos($total = 0)
    {
        $trabalhos = array();
        
        $sql = "SELECT * FROM portfolio ";
        if ($total > 0) {
            $sql .= "LIMIT ".$total;
        }
        
        $query = $this->db->query($sql);
        if ($query->rowCount() > 0) {
            $trabalhos = $query->fetchAll();
        }
        
        return $trabalhos;
    }
}