<!DOCTYPE html>
<html>
    <head>
        <title>Site Institucional</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="<?php echo BASE_URL?>assets/js/script.js"></script>
        <link rel="stylesheet" href="<?php echo BASE_URL?>assets/css/template.css" />
    </head>
    <body>
        <div class="topo">
            <div class="topo1"></div>
            <div class="banner"></div>
        </div>
        
        <div class="menu">
            <ul>
                <a href="<?php echo BASE_URL?>"><li>HOME</li></a>
                <a href="<?php echo BASE_URL?>portfolio"><li>PORTFOLIO</li></a>
                <a href="<?php echo BASE_URL?>sobre"><li>SOBRE</li></a>
                <a href="<?php echo BASE_URL?>servicos"><li>SERVIÇOS</li></a>
                <a href="<?php echo BASE_URL?>contato"><li>CONTATO</li></a>
            </ul>
        </div>
        
        <div class="container">
            <?php $this->loadViewInTemplate($viewName,$viewData) ?>
        </div>
        
        <div class="rodape"></div>
    </body>
</html>