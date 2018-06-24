<?php
class chatController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function index()
    {
        $dados = array('nome'=>"");
        
        $c = new Chamados();
        
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = addslashes($_GET['id']);
            $c->updateStatus($id,'1');
            
            // Cria Sessao para o Suporte.
            $_SESSION['chatWindow'] = $id;
            
        }
        elseif (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $ip = $_SERVER['REMOTE_ADDR'];
            $data_inicio = date('H:i:s');
            
            $_SESSION['chatWindow'] = $c->addChamado($ip, $nome, $data_inicio);
            
        }
        
        if (!isset($_SESSION['chatWindow']) || empty($_SESSION['chatWindow'])) {
            $this->loadTemplate('newChamado',$dados);
            exit;
        }  
        
        $idChamado = $_SESSION['chatWindow'];
        $chamado = $c->getChamado($idChamado);
        $dados['nome'] = $chamado['nome'];
        
        $this->loadTemplate("chat",$dados);
    }
}
?>