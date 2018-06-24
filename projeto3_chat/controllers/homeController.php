<?php
class homeController extends Controller
{
    public function index()
    {
        $dados = array();
        
        // PARTE DO MODEL
        
        $this->loadTemplate("home",$dados);
    }
}
?>