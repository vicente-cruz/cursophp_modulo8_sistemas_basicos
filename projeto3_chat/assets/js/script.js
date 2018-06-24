function abrirChat()
{
    window.open("/modulo8_1_sistemas_basico/projeto3_chat/chat", "chatWindow", "width=400,height=400");
}

function iniciarSuporte()
{
    setTimeout(getChamado,2000);
}

function resetChamados()
{
    $(".chamado").remove();
}

function abrirChamado(chamado)
{
    var id = $(chamado).closest(".chamado").attr("data-id");
//    var id = $(chamado).closest(".chamado").data("id");
    
    window.open("/modulo8_1_sistemas_basico/projeto3_chat/chat?id="+id,"chatWindow","width=400,height=400");
}

function keyUpChat(chat,evento)
{
    if (evento.keyCode === 13) { // Tecla enter
        var msg = chat.value;
        chat.value = "";
        
        var dt = new Date();
        var hr = dt.getHours()+":"+dt.getMinutes();
        var nome = $(".inputArea").attr("data-nome");
        
        // Mostra msg na tela somente apos ter sido enviada ao servidor
        //$(".chatArea").append("<div class='msgItem'>"+hr+" <strong>"+nome+"</strong>: "+msg+"</div>");
        
        // Envia msg para o servidor
        $.ajax({
            url:"/modulo8_1_sistemas_basico/projeto3_chat/ajax/sendMessage",
            type:"POST",
            data:{msg:msg}
        });
    }
}

function updateChat()
{
    $.ajax({
        url:"/modulo8_1_sistemas_basico/projeto3_chat/ajax/getMessage",
        dataType:"json",
        success:function(jsonReturn) {
            if (jsonReturn.mensagens.length > 0) {
                for (var i in jsonReturn.mensagens) {
                    var hr = jsonReturn.mensagens[i].data_enviado;
                    var nome = (jsonReturn.mensagens[i].origem === '0' ? "Suporte" : $(".inputArea").attr("data-nome"));
                    var msg = jsonReturn.mensagens[i].mensagem;
                    $(".chatArea").append("<div class='msgItem'>"+hr+" <strong>"+nome+"</strong>: "+msg+"</div>");
                }
                
                // Mostra sempre a mensagem nova
                $('.chatArea').scrollTop($('.chatArea')[0].scrollHeight);
            }
            setTimeout(updateChat,2000);
        },
        error:function() {
            setTimeout(updateChat,2000);
        }
    });
}

function getChamado()
{
    $.ajax({
        url:"/modulo8_1_sistemas_basico/projeto3_chat/ajax/getChamado",
        dataType:"json",
        success:function(dataReturn){
            resetChamados();
            if (dataReturn.chamados.length > 0) {
                for (var i in dataReturn.chamados) {
                    var texto_status = (dataReturn.chamados[i].status === '1' ? "Em atendimento" : "<button onclick='abrirChamado(this)'>Abrir Chamado</button>");
                    $("#areaChamados").append("<tr class='chamado' data-id='"+dataReturn.chamados[i].id+"'><td>"+
                            dataReturn.chamados[i].data_inicio+"</td><td>"+
                            dataReturn.chamados[i].nome+"</td><td>"+
                            texto_status+"</td></tr>");
                }
            }
            setTimeout(getChamado,2000);
        },
        error:function(){
            setTimeout(getChamado,2000);
        }
    });
}

$(document).ready(function(){
    
});