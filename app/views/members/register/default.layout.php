<!DOCTYPE html>
<html lang="es">
    <head>
        <?php echo Header::getHeader(); ?>

        <!-- librerias opcionales que activan el soporte de HTML5 para IE8 -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container">
            <div style="height:50px"></div>           
            <?php echo View::show('notice'); ?>
            <?php echo View::show('msgbox'); ?>
            <?php echo View::show('content'); ?>
            <?php echo View::show('footer'); ?>
        </div>
    </body>
</html>