<!DOCTYPE html>
<html lang="es">
    <head>
        <?php echo Header::getHeader(); ?>

        <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body> 
        <div class="container" style="margin-top:50px">
            <?php echo View::section('notice', array()); ?>
            <?php echo View::section('msgbox', array()); ?>
            <?php echo View::section('content', array()); ?>
        </div>
    </body>
</html>