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
    <body style="background-color: whitesmoke">
        <div class="container">
            <div style="height:50px"></div>           
            <?php echo View::section('notice'); ?>
            <?php echo View::section('msgbox'); ?>

            <?php echo View::section('content'); ?>
            <?php echo View::section('footer'); ?>
        </div>
    </body>
</html>