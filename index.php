<html>
    <head>
        <?php
             ob_start();
            header('Location: '.'/frontend/web/index.php');
            ob_end_flush();
            die();
        ?>
    </head>
    <body>
        
    </body>
</html>