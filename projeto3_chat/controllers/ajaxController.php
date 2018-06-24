<?php
class ajaxController extends Controller
{   
    public function index()
    {
        $dados = array();
        
        // PARTE DO MODEL
    }
    
    public function getChamado()
    {
        $dados = array();
        
        $chamados = new Chamados();
        $dados['chamados'] = $chamados->getChamados();
        
        echo json_encode($dados);
    }
    
    public function sendMessage()
    {
        if (isset($_POST['msg']) && !empty($_POST['msg'])) {
            $msg = addslashes($_POST['msg']);
            $idChamado = $_SESSION['chatWindow'];
            $origem = ($_SESSION['area'] == "suporte" ? 0 : 1);
            
            $m = new Mensagens();
            $m->sendMessage($idChamado, $origem, $msg);
        }
    }
    
    public function getMessage()
    {
        $dados = array();
        
        $m = new Mensagens();
        $c = new Chamados();
        
        $idChamado = $_SESSION['chatWindow'];
        $area = $_SESSION['area'];
        $lastMsg = $c->getLastMsg($idChamado, $area);
        
        $dados['mensagens'] = $m->getMessage($idChamado, $lastMsg);
        
        echo json_encode($dados);
    }
}
?>