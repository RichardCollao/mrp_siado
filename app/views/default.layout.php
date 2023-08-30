<!DOCTYPE html>
<html lang="es">
    <head>
        <?php echo Header::getHeader(); ?>

        <!-- librerias opcionales que activan el soporte de HTML5 para IE8 -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            .margin-top-05 { margin-top: 05px; }
            .margin-top-10 { margin-top: 10px; }
            .margin-top-15 { margin-top: 15px; }
            .margin-top-20 { margin-top: 20px; }
            .margin-top-25 { margin-top: 25px; }
            .margin-top-30 { margin-top: 30px; }
            body{
                font-size: medium;
            }
        </style>
        <style>
            .background{
                background: url('<?php echo path::urlImages('resources_and_licenses/background/background.jpg'); ?>') no-repeat center center fixed; 
                background-size:cover;
            }

            .transparency{
                background: rgba(0, 0, 0, 0.5)!important;
                color:whitesmoke; 
            }

        </style>

    </head>
    <body class="background">
        <div class="container transparency">
            <?php echo View::section('content'); ?>
            <?php echo View::section('footer'); ?>
        </div>
    </body>
</html>