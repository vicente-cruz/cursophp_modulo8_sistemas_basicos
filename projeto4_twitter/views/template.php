<!DOCTYPE html>
<html>
    <head>
        <title>Twitter</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/template.css" />
        <script type="text/javascript" src="<?php echo BASE_URL ?>assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL ?>assets/js/script.js"></script>
    </head>
    <body>
        <div class="topo">
            <div class="topoint">
                <div class="topoleft">TWITTER</div>
                <div class="toporight"><?php echo $viewData['nome']; ?> - <a href="<?php echo BASE_URL ?>login/logout">Sair</a></div>
                <div style="clear:both"></div>
            </div>
        </div>
        <div class="container">
            <?php $this->loadViewInTemplate($viewName, $viewData) ?>
        </div>
    </body>
</html>