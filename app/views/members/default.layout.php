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
            html{
                /*Cuando el scroll esta presente desde el inicio se evita que algunos componentes se redimensionen*/ 
                overflow-y: scroll;
            }
            body{
                font-size: small;
            }

            .margin-top-05 { margin-top: 05px; }
            .margin-top-10 { margin-top: 10px; }
            .margin-top-15 { margin-top: 15px; }
            .margin-top-20 { margin-top: 20px; }
            .margin-top-25 { margin-top: 25px; }
            .margin-top-30 { margin-top: 30px; }
            select>option { padding: 5px; }
            /*Evita que los enlaces muestren el subrayado*/
            a:link { text-decoration:none; }
            /*Evita que las tablas se expandan fuera de la pantalla*/
            .force-one-row{
                overflow:hidden;
                white-space: nowrap;
            }
            /*Oculta el desborde*/
            .truncate{
                overflow: hidden;
                text-overflow: ellipsis;
            }
            /*Fuerza todas las palabras que son muy largas al encontrarse con el límite del ancho 
            de su contenedor se corten y sigan en la línea de abajo*/
            .breakAll {word-break: break-all;}

            .container-full {
                margin: 0 auto;
                width: 100%;
                padding: 0 50px;
            }

            /* Estilo para la primera fila de las tablas*/
            .thead{
                background-color: #cfd8dc;
                /*font-weight: bold;*/
                color: #424242;
            }
            .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
                background-color: #98ccff;
            }
            /*Estilos para ajustar la tabla manteniendo la apariencia*/
            .resizable-table{
                table-layout: fixed;
                td, th{
                    overflow: hidden;
                    white-space: nowrap;
                    -moz-text-overflow: ellipsis;        
                    -ms-text-overflow: ellipsis;
                    -o-text-overflow: ellipsis;
                    text-overflow: ellipsis;
                }
            }

            .modal-dialog {
                margin: 13vh auto 0px auto
            }
        </style>

        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip({'delay': {show: 1000, hide: 0}});
            });

            $(document).ready(function () {
                $("input:text").first().focus();
                $(".active-focus").focus();
            });


        </script>
    </head>
    <body>

        <script>
            $(document).ready(function () {
                $('a[class="link-delete"]').click(function (e) {
                    //Cancela el evento, en este caso la acción de redireccionar
                    e.preventDefault();
                    // Muestra el modal
                    $('#modal-delete').modal('show');
                    // Posiciona el cursor en el primer boton
                    $('#modal-delete button.btn:first').focus();
                    // pasa el atributo href del link al evento click del boton borrar 
                    $('#modal-delete button.btn:last').click({"_link": $(this).attr("href")}, _delete);

                    function _delete(event) {
                        $(location).attr('href', event.data._link);
                    }
                });
            });
        </script>

        <div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Mensaje</h4>
                    </div>
                    <div class="modal-body">
                        <p>¿Esta seguro que desea borrar el elemento seleccionado?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button " class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger">Borrar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <?php echo View::section('navbar'); ?>
        <!--altura de barnav estatico-->
        <div style="margin-top: 30px">&nbsp;</div>
        <div class="container-full" style="min-height:500px;margin:0 auto">
            <?php echo View::section('notice'); ?>
            <?php echo View::section('msgbox'); ?>
            <?php echo View::section('content'); ?>
        </div>
        <div class="container">
            <?php echo View::section('footer'); ?>
        </div>
    </body>
</html>