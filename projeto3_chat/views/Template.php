<!DOCTYPE html>
<html>
    <head>
        <title>CHAT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo BASE_URL?>assets/css/template.css" />
        <script type="text/javascript" src ="<?php echo BASE_URL?>assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src ="<?php echo BASE_URL?>assets/js/script.js"></script>
    </head>
    <body>
        <div class="topo"></div>
        <div class="environment" style="background-color:<?php
        if (isset($_SESSION["area"]) && ($_SESSION["area"] == "suporte")) { 
            echo "#FF0000";
        } elseif (isset($_SESSION["area"]) && ($_SESSION["area"] == "cliente")) {
            echo "#00FF00";
        } else {
            echo "#000000";
        }
        ?>"></div>
        <div class="container">
            <?php $this->loadViewInTemplate($viewName,$viewData); ?>
        </div>
        <div class="rodape"></div>
    </body>
</html>