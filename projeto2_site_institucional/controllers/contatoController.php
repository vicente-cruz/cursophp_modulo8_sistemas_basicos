<?php

class contatoController extends controller
{
    public function index()
    {
        $dados = array("aviso" => "");
        
        if (isset($_POST["nome"]) && !empty($_POST["nome"])) {
            $nome = mysql_real_escape_string($_POST["nome"]);
            $email = mysql_real_escape_string($_POST["email"]);
            $msg = mysql_real_escape_string($_POST["mensagem"]);
            
            $para = "pessoal@vicentecruz.com.br";
            $assunto = "Dúvida do site";
            $mensagem = "Nome: ".$nome."<br/>E-mail: ".$email."<br/>Mensagem: ".$msg;
            
            $cabecalho = "From: pessoal@vicentecruz.com.br".'\r\n'.
                "Reply-To: ".$email.'\r\n'.
                "X-Mailer: PHP/".phpversion();
            mail($para, $assunto, $mensagem, $cabecalho);
            
            $dados["aviso"] = "E-mail enviado com sucesso!";
        }
        
        $this->loadTemplate("contato",$dados);
    }
}