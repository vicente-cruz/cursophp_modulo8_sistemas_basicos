<?php
class suporteController extends Controller
{
    public function __construct()
    {
        $_SESSION["area"] = "suporte";
    }
    
    public function index()
    {
        $dados = array();
        
        // PARTE DO MODEL
        
        $this->loadTemplate("suporte",$dados);
    }
}
?>